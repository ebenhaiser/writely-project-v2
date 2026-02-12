<div>
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <input type="text" class="form-control" placeholder="Search..." wire:model.live="keyword" />
                </div>
                <div class="col-sm-3">
                    <select class="form-control" wire:model.live="category_slug" wire:loading.attr="disabled">
                        <option value="">-- choose category --</option>
                        @forelse($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" wire:model.live="sortBy" wire:loading.attr="disabled">
                        <option value="">-- Sort By --</option>
                        <option value="latest">Latest</option>
                        <option value="newest">Newest</option>
                        <option value="most_liked">Most Liked</option>
                        <option value="most_commented">Most commented</option>
                        <option value="most_viewed">Most Viewed</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-secondary w-100" wire:click="resetFilters" wire:loading.attr="disabled">Reset</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:loading.remove>
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-4">
                    <x-cards.post-small :post="$post" />
                </div>
            @empty
                <div class="col-md-12" align="center">
                    <i>No post yet.</i>
                </div>
            @endforelse
        </div>
        {{ $posts->links() }}
    </div>
</div>
