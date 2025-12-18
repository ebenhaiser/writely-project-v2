<div>
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <select class="form-control" wire:model.live="category_slug">
                <option value="">-- choose category --</option>
                @forelse($categories as $category)
                    <option value="{{ $category->slug }}">{{ $category->name }}</option>
                @endforeach
            </select>
                </div>
                <div class="col-sm-6">
                    <select class="form-control" wire:model.live="sortBy">
                        <option value="">-- Sort By --</option>
                        <option value="latest">Latest</option>
                        <option value="newest">Newest</option>
                        <option value="most_liked">Most Liked</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div wire:loading.remove>
        <div class="row">
            @forelse ($posts as $post)
                <x-cards.post-small :post="$post" />
            @empty
                <div class="col-md-12" align="center">
                    <i>No post yet.</i>
                </div>
            @endforelse
        </div>
        {{ $posts->links() }}
    </div>
</div>
