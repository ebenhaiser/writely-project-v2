<div>
    <style>
        .history-wrapper {
            position: relative;
        }

        .delete-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 32px;
            height: 32px;
            opacity: 0;
            z-index: 20;
            transition: all 0.2s ease;
        }

        /* hover card → munculin button */
        .history-wrapper:hover .delete-btn {
            opacity: 1;
        }

        .history-wrapper {
            position: relative;
        }

        .delete-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 32px;
            height: 32px;
            opacity: 0;
            z-index: 20;
            transition: all 0.2s ease;
        }

        /* hover card → munculin button */
        .history-wrapper:hover .delete-btn {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .delete-btn {
                opacity: 1;
            }
        }
    </style>

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
            <div class="col-md-4">
                <div class="history-wrapper position-relative d-inline-block">
                    <x-cards.post-small :post="$post" wire:key="post-{{ $post->id }}" />
                    {{-- Floating delete button (di luar card) --}}
                    <button class="btn btn-danger btn-sm delete-btn rounded-circle" wire:click="deleteHistory({{ $post->id }})" wire:confirm="Are you sure you want to DELETE HISTORY?\n\n'{{ $post->title }}'"
                        title="Hapus dari history">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
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
