<div>
    <div class="card">
        <div class="card-header">
            <h1>Your History</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" aria-describedby="" maxlength="50" placeholder="Search..."
                        wire:model.live='keyword'>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" wire:model.live='category_id'>
                        <option value="">-- choose category --</option>
                        @forelse($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" wire:model.live="sortBy">
                        <option value="">-- Sort By --</option>
                        <option value="latest">Latest View</option>
                        <option value="newest">Newest View</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @forelse ($posts as $post)
            <x-cards.post-small :post="$post" wire:key="post-{{ $post->id }}" />
        @empty
            <div class="col-md-12" align="center">
                <i>No post yet.</i>
            </div>
        @endforelse
    </div>
    @if ($posts)
        {{ $posts->links() }}
    @endif
</div>
