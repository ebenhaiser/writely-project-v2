<div>
    <style>
        .ckeditor-container img {
            max-height: 400px;
            /* min-height: 350px; */
            width: auto;
            object-fit: contain;
        }

        .ckeditor-container textarea {
            min-height: 2000px;
        }

        .preview-thumbnail img {
            max-width: 400px;
        }
    </style>
    <div class="card">
        <div class="card-header">
            <h3>{{ $isEdit == true ? 'Edit' : 'Create' }} Post</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" required wire:model='title'>
            </div>

            {{-- thumbnail --}}
            <div class="mb-3">
                <label for="title" class="form-label">Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control mb-1" accept=".jpg, .jpeg, .png, .webp"
                    wire:model="thumbnail">
                <div align=center class="preview-thumbnail">
                    @if ($errors->has('thumbnail'))
                        <div id="defaultFormControlHelp" class="form-text text-danger mb-1">
                            {{ $errors->first('thumbnail') }}
                        </div>
                    @endif
                    @if ($isEdit || $preview_thumbnail)
                        <div wire:loading.remove wire:target="thumbnail" class="profile-spinner-container">
                            <img src="{{ $preview_thumbnail }}" alt="Preview"
                                class="img-fluid mt-3 mb-2 rounded border border-2 border-gray shadow-sm">
                            <div class="d-flex justify-content-center">
                                <span>
                                    <button class="btn btn-outline-danger" wire:click='cancelThumbnail'>Cancel</button>
                                </span>
                            </div>
                        </div>
                    @endif
                    <div wire:loading wire:target="thumbnail" class="profile-spinner-container mt-3">
                        <span class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </span>
                    </div>
                </div>
            </div>
            {{-- end thumbnail --}}

            <div class="mb-3">
                <label for="" class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="20" required wire:model='content'></textarea>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Category</label>
                <select class="form-select" name="category_id" required wire:model='category_id'>
                    <option value="">-- Choose the category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $isEdit && $category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div align="right">
                <button class="btn btn-primary" wire:click='submit' wire:loading.attr='disabled'>
                    <span wire:loading.remove wire:target="submit">Post</span>
                    <span wire:loading wire:target="submit" class="spinner-border text-primary" role="status"></span>
                </button>
            </div>
        </div>
    </div>

    {{-- delete post --}}
    {{-- @if (request()->routeIs('post.edit'))
        <style>
            .card-delete-post .card {
                border: solid 1px red;
            }

            .card-delete-post .card .card-header {
                background-color: #f8d7da;
                border-bottom: solid 1px red;
            }
        </style>
        <div class="card-delete-post">
            <div class="card">
                <div class="card-header">
                    <div class="h3">Danger Zone</div>
                </div>
                <div class="card-body">
                    <div>
                        <a href="{{ route('post.delete', $post->slug) }}" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this post?')">
                            Delete Post
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif --}}
</div>
