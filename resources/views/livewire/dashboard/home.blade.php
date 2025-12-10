<div>
    @forelse ($posts as $post)
    <x-cards.post-large :post="$post" />
    @empty
    <div class="col-md-12" align="center">
        <i>No post yet.</i>
    </div>
    @endforelse
    {{ $posts->links() }}
</div>
