<div>
    <style>
        .card-post-mini .card img {
            /* width: 100%; */
            height: 250px;
            object-fit: cover;
        }

        .card-post-mini .content-limit {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Maksimal 3 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-post-mini .title-limit {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            /* Maksimal 3 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-post-mini .card .post-profile img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>

    <div class="card-post-mini link-dark">
        <div class="card shadow">
            <a href="{{ route('post.show', ['slug' => $postSlug]) }}" style="color: inherit; text-decoration: none;">
                <img src="https://placehold.co/600x400" class="card-img-top" alt="Thumbnail">
                <div class="card-body">
                    <h2 class="card-title title-limit">{{ $title }}</h2>
                    <a href="{{ route('category', ['category_slug' => $categorySlug]) }}"
                        class="card-subtitle mb-2 badge text-bg-info" style="color: white">
                        {{ $categoryName }}
                    </a>
                    <p class="card-text content-limit">
                        {{ Str::limit($content, 250, '...') }}
                    </p>
                    {{-- <a href="#" class="card-link">Card link</a> --}}
                    <div class="d-flex gap-2" style="color: gray">
                        <span>
                            <i align="right">{{ $created_at->diffForHumans() }}</i>
                        </span>
                        <span>
                            &#8226;
                        </span>
                        <span>
                            <i class='ti ti-thumb-up'></i> {{ ' ' . count($likes) }}</span>
                        </span>
                        <span>
                            <i class='ti ti-message-circle'></i>{{ ' ' . count($comments) }}</span>
                        </span>
                    </div>
                </div>
            </a>
            <div class="card-footer">
                <a href="{{ route('profile.show', ['username' => $authorUsername]) }}" class="d-flex">
                    <span>
                        <div class="post-profile me-2">
                            <img src="{{ $authorProfilePictureUrl }}" alt=""
                                class="rounded-circle border-4 border-white-color-40">
                        </div>
                    </span>
                    <span class="my-auto">
                        <h4 class="mt-0 mb-0">{{ $authorName }}</h4>
                        <p class="mb-0 mt-0 text-body" style="text-decoration: none">
                            {{ '@' . $authorUsername }}
                        </p>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
