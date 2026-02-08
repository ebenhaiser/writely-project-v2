<div>
    <div class="card">
        <div class="card-header">
            <h1>Your History</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" aria-describedby="" maxlength="50" placeholder="Search...">
                </div>
                <div class="col-sm-3">
                    <select class="form-control">
                        <option value="">-- choose category --</option>
                        @forelse($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" wire:model.live="sortBy">
                        <option value="">-- Sort By --</option>
                        <option value="latest">Latest</option>
                        <option value="newest">Newest</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
