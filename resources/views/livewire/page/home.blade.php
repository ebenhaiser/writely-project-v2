<div>
    @forelse ($posts as $post)
        <x-cards.post-large :post="$post" wire:key="post-{{ $post->id }}" />
    @empty
        <div class="col-md-12" align="center">
            <i>No post yet.</i>
        </div>
    @endforelse
    @if ($posts)
        {{ $posts->links() }}
    @endif
</div>
