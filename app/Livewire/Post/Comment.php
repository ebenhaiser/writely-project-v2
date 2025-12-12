<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Comment as CommentModel;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Comment extends Component
{
    public $post;
    public $content = '';
    public $replyingTo = null;
    public $replyContent = '';

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $comments = CommentModel::with(['user', 'replies.user'])
            ->where('post_id', $this->post->id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('livewire.post.comment', [
            'comments' => $comments,
        ]);
    }

    public function storeComment()
    {
        $this->validate([
            'content' => 'required|min:1|max:1000',
        ]);

        if (!Auth::check()) return;

        CommentModel::create([
            'user_id' => Auth::id(),
            'post_id' => $this->post->id,
            'content' => $this->content,
            'parent_id' => null,
        ]);

        $this->content = '';
        $this->dispatch('comment-added');
    }

    public function storeReply($commentId)
    {
        $this->validate([
            'replyContent' => 'required|min:1|max:1000',
        ]);

        if (!Auth::check()) return;

        CommentModel::create([
            'user_id' => Auth::id(),
            'post_id' => $this->post->id,
            'content' => $this->replyContent,
            'parent_id' => $commentId,
        ]);

        $this->replyContent = '';
        $this->replyingTo = null;
        $this->dispatch('reply-added');
    }

    public function deleteComment($commentId)
    {
        $comment = CommentModel::findOrFail($commentId);

        if (!Auth::check()) return;

        // Check authorization
        $canDelete = Auth::id() == $comment->user_id ||
            Auth::id() == $this->post->user_id;

        if ($canDelete) {
            $comment->delete();
            $this->dispatch('comment-deleted');
        }
    }

    public function startReply($commentId)
    {
        $this->replyingTo = $commentId;
    }

    public function cancelReply()
    {
        $this->replyingTo = null;
        $this->replyContent = '';
    }

    #[On('comment-added')]
    #[On('reply-added')]
    #[On('comment-deleted')]
    public function refreshComments()
    {
        // Livewire will auto-refresh
    }
}
