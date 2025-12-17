<div>
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <select name="" id="" class="form-control" wire:model.live="category_id">
                <option value="">-- choose category --</option>
                @forelse($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
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
