<div>
    <style>
        .show-post .card img {
            border-radius: 20px
        }

        .author-section img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }

        @media (min-width:768px) {
            .author-and-comments-section {
                position: sticky;
                top: 83px;
            }

            .author-section {
                margin-bottom: 10px
            }

            .comments-section .card-body {
                max-height: 450px;
                /* Sesuaikan tinggi maksimal */
                overflow-y: auto;
                /* Aktifkan scroll vertikal */
            }

            .show-post .card {
                margin-bottom: 0
            }
        }
    </style>
    <div class="row">
        <div class="col-lg-8">
            <div class="show-post">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span class="">
                                <h1 class="">{{ $post->title }}</h1>
                                <h3 class="badge text-bg-info" style="color: white">
                                    {{ $post->category->name }}
                                </h3>
                            </span>
                            <span class="" align="right">
                                @if (Auth::check())
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-outline-primary mb-1">
                                            <i class="ti ti-star"></i>
                                        </button>
                                        <button class="btn btn-outline-primary mb-1">
                                            <i class="ti ti-thumb-up"></i>
                                        </button>
                                    </div>
                                @endif
                                @if (Auth::check() && Auth::user()->id == $post->user_id)
                                    <a href="#" class="btn btn-outline-primary">Edit</a>
                                @endif
                                <div align="right" class="mt-3">
                                    <div class="d-flex justify-content-end gap-3">
                                        <span class=""><i class="ti ti-thumb-up"></i>
                                            {{ $post->likes->count() }}</span>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- @if ($post->thumbnail && file_exists(public_path('img/postThumbnail/' . $post->thumbnail)))
                        <img src="{{ asset('img/postThumbnail/' . $post->thumbnail) }}" class="w-100 mb-4"
                        alt="...">
                        @endif --}}
                        <div class="ckeditor-container">{!! str_replace("\n", '<br>', e($post->content)) !!}
                        </div>
                    </div>
                    <div class="card-footer" align="center">
                        <p>Created at: {{ $post->created_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="author-and-comments-section">
                <div class="card author-section shadow">
                    <div class="card-header">
                        <h5>Author</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $user = $post->user;
                        @endphp
                        <div class="d-flex justify-content-between">
                            <a href="#" style="color: inherit; text-decoration: none;">
                                <span class="d-flex">
                                    <span>
                                        <div class="me-2">
                                            <img src="" alt=""
                                                class="rounded-circle  border-4 border-white-color-40">
                                        </div>
                                    </span>
                                    <span class="my-auto">
                                        <h6 class="mt-0 mb-0">{{ $user->name }}</h6>
                                        <p class="mb-0 mt-0 text-body" style="text-decoration: none">
                                            {{ '@' . $user->username }}
                                        </p>
                                    </span>
                                </span>
                            </a>
                            <span class="my-auto">
                                <div align="right">
                                    @if (Auth::check() && Auth::id() !== $user->id)
                                        <button class="btn btn-outline-primary follow-btn"
                                            data-user-id="{{ $user->id }}">
                                            <span
                                                class="">{{ $user->isFollowedByUser() ? 'Unfollow' : 'Follow' }}</span>
                                        </button>
                                    @elseif (Auth::check() && Auth::id() === $user->id)
                                        <p class="my-auto text-muted">You</p>
                                    @endif
                                </div>
                                <div class="mt-1" align="right">
                                    <i>
                                        <span class="follower-count">{{ count($user->followers) }}</span>
                                        follower
                                    </i>
                                </div>
                            </span>
                        </div>
                    </div>

                    {{-- <x-cards.user :user="$user" /> --}}
                </div>
                {{-- comment --}}
                <!-- Input Komentar -->
                <div class="card comments-section shadow">
                    <div class="card-header">
                        <h5>Comments</h5>
                    </div>
                    <div class="card-body">
                        {{-- <x-comments :post="$post" /> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
