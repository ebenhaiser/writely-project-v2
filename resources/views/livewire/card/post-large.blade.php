<div>
    <style>
        .card-post-big .profile img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
    <div class="card-post-big">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ $thumbnailUrl }}" class="card-img-top" alt="Thumbnail"
                            style="object-fit: cover; height:220px; border-radius: 0.5em">
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between mb-2 mt-2 gap-4">
                            <span class="">
                                <h2 class="card-title">{{ $title }}</h2>
                            </span>
                            <span class="" align="right">
                                <a href="{{ route('explore', ['category' => $categorySlug]) }}"
                                    class="badge text-bg-info" style="color: white">
                                    {{ $categoryName }}
                                </a>
                            </span>
                        </div>
                        <p class="card-text">
                            {{ Str::limit(strip_tags($content), 250, '...') }}
                        </p>
                        {{-- <a href="#" class="card-link">Card link</a> --}}
                        <div class="d-flex gap-2">
                            <span>
                                <i align="right">{{ $created_at->diffForHumans() }}</i>
                            </span>
                            <span>
                                &#8226;
                            </span>
                            <span>
                                <i class='ti ti-thumb-up'></i>{{ ' ' . count($likes) }}
                            </span>
                            <span>
                                <i class='ti ti-message-circle'></i>{{ ' ' . count($comments) }}
                            </span>
                            <span>
                                <i class='ti ti-eye'></i>{{ ' ' . count($views) }}
                            </span>
                        </div>
                        {{-- <button class="btn btn-outline-primary mt-2 like-btn" data-post-id="{{ $post->id }}">
                        <span class="like-text mt-0">
                            {{ $post->isLikedByUser() ? 'Unlike' : 'Like' }}
                            Liked
                        </span>
                    </button> --}}
                    </div>
                </div>
            </div>
            <div class="card-footer row">
                <div class="col-sm-10">
                    <a href="{{ route('profile.show', ['username' => $authorUsername]) }}" class="d-flex">
                        <span>
                            <div
                                class="profile me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                                <img src="{{ $authorProfilePictureUrl }}" alt=""
                                    class="rounded-circle border-4 border-white-color-40">
                            </div>
                        </span>
                        <span class="my-auto ms-1">
                            <h5 class="mt-0 mb-0">{{ $authorName }}</h5>
                            <p class="mb-0 mt-0 text-body" style="text-decoration: none">
                                {{ '@' . $authorUsername }}
                            </p>
                        </span>
                    </a>
                </div>
                <div class="col-sm-2 my-auto" align="right">
                    <a href="{{ route('post.show', ['slug' => $postSlug]) }}" class="btn btn-outline-secondary">
                        Read more &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
