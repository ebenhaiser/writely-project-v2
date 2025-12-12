<div>
    <div class="card comments-section shadow" wire:key="comments-section-{{ $post->id }}">
        <div class="card-header">
            <h3 class="mb-0">Comments</h3>
        </div>

        <div class="card-body">
            {{-- Form Comment Baru --}}
            @auth
                <div class="d-flex gap-2 mb-4">
                    <input type="text" wire:model="content" class="form-control" placeholder="Write a comment..."
                        wire:keydown.enter="storeComment" />
                    <button class="btn btn-primary px-3" wire:click="storeComment" wire:loading.attr="disabled">
                        <span wire:loading.remove>Post</span>
                        <span wire:loading>
                            <span class="spinner-border spinner-border-sm" role="status"></span>
                        </span>
                    </button>
                </div>
            @endauth

            {{-- Daftar Komentar --}}
            <div class="comments-container">
                @if ($comments->isEmpty())
                    <p class="text-muted text-center py-3">No comments yet. Be the first to comment!</p>
                @else
                    <ul class="timeline">
                        @foreach ($comments as $comment)
                            {{-- Comment Utama --}}
                            <li class="comment-item" wire:key="comment-{{ $comment->id }}">
                                <img src="{{ $comment->user->profile_picture ? asset('img/profilePicture/' . $comment->user->profile_picture) : asset('img/profilePicture/default.jpg') }}"
                                    class="profile-img" alt="{{ $comment->user->name }}">
                                <div class="comment-box">
                                    <a href="{{ route('profile.show', $comment->user->username) }}"
                                        class="text-decoration-none">
                                        @if ($comment->user->name)
                                            <b>{{ $comment->user->name }}</b><br />
                                        @endif
                                        <i>&#64;{{ $comment->user->username }}</i>
                                    </a>
                                    <p class="mt-2 mb-1">{{ $comment->content }}</p>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>

                                    <div class="comment-actions mt-1">
                                        @auth
                                            <button class="btn btn-sm btn-link p-0 me-2 text-decoration-none"
                                                wire:click="startReply({{ $comment->id }})">
                                                Reply
                                            </button>

                                            @if (Auth::id() == $comment->user_id || Auth::id() == $post->user_id)
                                                <button class="btn btn-sm btn-link p-0 text-danger text-decoration-none"
                                                    wire:click="deleteComment({{ $comment->id }})"
                                                    onclick="return confirm('Are you sure you want to delete this comment?')">
                                                    Delete
                                                </button>
                                            @endif
                                        @endauth
                                    </div>
                                </div>

                                {{-- Form Reply untuk comment ini --}}
                                @if ($replyingTo == $comment->id)
                                    <div class="reply-input mt-3 ms-5">
                                        <input type="text" wire:model="replyContent"
                                            class="form-control form-control-sm" placeholder="Write a reply..."
                                            wire:keydown.enter="storeReply({{ $comment->id }})" autofocus />
                                        <div class="mt-2">
                                            <button class="btn btn-sm btn-primary"
                                                wire:click="storeReply({{ $comment->id }})"
                                                wire:loading.attr="disabled">
                                                <span wire:loading.remove>Reply</span>
                                                <span wire:loading>
                                                    <span class="spinner-border spinner-border-sm"
                                                        role="status"></span>
                                                </span>
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary ms-1"
                                                wire:click="cancelReply">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                {{-- Replies --}}
                                @if ($comment->replies->isNotEmpty())
                                    <ul class="timeline replies">
                                        @foreach ($comment->replies as $reply)
                                            <li class="reply" wire:key="reply-{{ $reply->id }}">
                                                <img src="{{ $reply->user->profile_picture ? asset('img/profilePicture/' . $reply->user->profile_picture) : asset('img/profilePicture/default.jpg') }}"
                                                    class="profile-img" alt="{{ $reply->user->name }}">
                                                <div class="comment-box">
                                                    <a href="{{ route('profile.show', $reply->user->username) }}"
                                                        class="text-decoration-none">
                                                        @if ($reply->user->name)
                                                            <b>{{ $reply->user->name }}</b><br />
                                                        @endif
                                                        <i>&#64;{{ $reply->user->username }}</i>
                                                    </a>
                                                    <p class="mt-2 mb-1">{{ $reply->content }}</p>
                                                    <small
                                                        class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>

                                                    <div class="comment-actions mt-1">
                                                        @auth
                                                            <button
                                                                class="btn btn-sm btn-link p-0 me-2 text-decoration-none"
                                                                wire:click="startReply({{ $comment->id }})">
                                                                Reply
                                                            </button>

                                                            @if (Auth::id() == $reply->user_id || Auth::id() == $post->user_id)
                                                                <button
                                                                    class="btn btn-sm btn-link p-0 text-danger text-decoration-none"
                                                                    wire:click="deleteComment({{ $reply->id }})"
                                                                    onclick="return confirm('Are you sure you want to delete this comment?')">
                                                                    Delete
                                                                </button>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <style>
        ul.timeline {
            list-style-type: none;
            position: relative;
            margin: 0;
            padding: 0;
        }

        ul.timeline:before {
            display: none;
        }

        ul.timeline>li {
            margin: 20px 0;
            position: relative;
            padding-left: 20px;
            min-height: 60px;
        }

        ul.timeline>li .comment-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 12px 15px;
            display: inline-block;
            max-width: calc(100% - 70px);
            position: relative;
            margin-left: 60px;
            width: 100%;
        }

        ul.timeline>li .profile-img {
            position: absolute;
            left: 10px;
            top: 0;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            z-index: 3;
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        ul.timeline>li:after {
            content: '';
            position: absolute;
            left: 30px;
            top: 55px;
            width: 2px;
            height: calc(100% - 55px);
            background: #d4d9df;
            z-index: 1;
        }

        ul.timeline .reply {
            margin-left: 50px;
            position: relative;
        }

        ul.timeline .reply .profile-img {
            width: 35px;
            height: 35px;
            left: 12px;
            top: 5px;
        }

        ul.timeline .replies {
            margin-left: 40px;
        }

        .comment-box a,
        .comment-box b,
        .comment-box i,
        .comment-box button {
            color: #333 !important;
            text-decoration: none !important;
        }

        .comment-box a:hover {
            text-decoration: underline !important;
        }

        .comment-actions button {
            padding: 2px 8px;
            font-size: 0.85rem;
        }

        .reply-input {
            margin-left: 60px;
            margin-top: 10px;
            margin-bottom: 10px;
            max-width: calc(100% - 70px);
        }

        @media (min-width: 768px) {
            .comments-section .card-body {
                max-height: 450px;
                overflow-y: auto;
            }

            ul.timeline>li .comment-box {
                max-width: 85%;
            }
        }

        @media (max-width: 767px) {
            ul.timeline>li {
                margin: 15px 0;
                padding-left: 15px;
            }

            ul.timeline>li .comment-box {
                margin-left: 50px;
                max-width: calc(100% - 60px);
            }

            ul.timeline>li .profile-img {
                width: 35px;
                height: 35px;
                left: 8px;
            }

            ul.timeline>li:after {
                left: 25px;
            }

            .reply-input {
                margin-left: 50px;
                max-width: calc(100% - 60px);
            }
        }
    </style>

    @script
        <script>
            // Auto focus pada input reply
            $wire.on('start-reply', (commentId) => {
                setTimeout(() => {
                    const replyInput = document.querySelector(`[wire\\:model="replyContent"]`);
                    if (replyInput) {
                        replyInput.focus();
                    }
                }, 100);
            });

            // Auto focus pada comment input setelah posting
            $wire.on('comment-added', () => {
                const commentInput = document.querySelector(`[wire\\:model="content"]`);
                if (commentInput) {
                    commentInput.focus();
                }
            });
        </script>
    @endscript
</div>
