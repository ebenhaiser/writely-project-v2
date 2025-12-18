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
                        {{-- <div class="d-flex justify-content-between"> --}}
                        <div class="row">
                            <div class="col-md-10">
                                <h1 class="">{{ $post->title }}</h1>
                                <a href="{{ route('category', ['category_slug' => $post->category->slug]) }}" class="badge text-bg-info" style="color: white">
                                    {{ $post->category->name }}
                                </a>
                            </div>
                            <div class="col-md-2" align="right">
                                @if (Auth::check())
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-outline-primary mb-1"
                                            wire:click="likeToggle({{ $post->id }})" wire:loading.attr="disabled">
                                            <span wire:loading.remove wire:target="likeToggle({{ $post->id }})">
                                                @if (!$post->likes->contains('user_id', Auth::id()))
                                                    <i class="bi bi-hand-thumbs-up"></i>
                                                @else
                                                    <i class="bi bi-hand-thumbs-up-fill"></i>
                                                @endif
                                            </span>
                                            <span wire:loading wire:target="likeToggle({{ $post->id }})">
                                                <span class="spinner-border spinner-border-sm" role="status"></span>
                                            </span>
                                        </button>
                                        <button class="btn btn-outline-primary mb-1"
                                            wire:click="bookmarkToggle({{ $post->id }})"
                                            wire:loading.attr="disabled">
                                            <span wire:loading.remove wire:target="bookmarkToggle({{ $post->id }})">
                                                @if (!$post->bookmarks->contains('user_id', Auth::id()))
                                                    <i class="bi bi-bookmark"></i>
                                                @else
                                                    <i class="bi bi-bookmark-fill"></i>
                                                @endif
                                            </span>
                                            <span wire:loading wire:target="bookmarkToggle({{ $post->id }})">
                                                <span class="spinner-border spinner-border-sm" role="status"></span>
                                            </span>
                                        </button>
                                    </div>
                                @endif
                                @if (Auth::check() && Auth::user()->id == $post->user_id)
                                    <a href="#" class="btn btn-outline-primary">Edit</a>
                                @endif
                                <div align="right" class="mt-1">
                                    <div class="d-flex justify-content-end gap-3">
                                        <span><i class="ti ti-thumb-up"></i>{{ ' ' . $post->likes->count() }}</span>
                                        <span><i class="ti ti-bookmark"></i>{{ ' ' . $post->bookmarks->count() }}</span>
                                    </div>
                                </div>
                            </div>
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
                        <h3>Author</h3>
                    </div>
                    <div class="card-body">
                        @php
                            $user = $post->user;
                        @endphp
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('profile.show', ['username' => $user->username]) }}"
                                style="color: inherit; text-decoration: none;">
                                <span class="d-flex">
                                    <span>
                                        <div class="me-2">
                                            @php
                                                $author_avatarPath = public_path(
                                                    'img/profilePicture/' . $user->profile_picture,
                                                );
                                                $author_avatarUrl =
                                                    $user->profile_picture && file_exists($author_avatarPath)
                                                        ? asset('img/profilePicture/' . $user->profile_picture)
                                                        : 'https://placehold.co/400';
                                            @endphp
                                            <img src="{{ $author_avatarUrl }}" alt=""
                                                class="rounded-circle  border-4 border-white-color-40">
                                        </div>
                                    </span>
                                    <span class="my-auto">
                                        <h5 class="mt-0 mb-0">{{ $user->name }}</h5>
                                        <p class="mb-0 mt-0 text-body" style="text-decoration: none">
                                            {{ '@' . $user->username }}
                                        </p>
                                    </span>
                                </span>
                            </a>
                            <span class="my-auto">
                                <div align="right">
                                    <div wire:click="toggleFollow({{ $user->id }})" style="cursor: pointer;">
                                        @if (Auth::check())
                                            @if (Auth::id() !== $user->id)
                                                @php
                                                    $isFollowing = Auth::user()->following->contains($user->id);
                                                    $isFollowedBack = $user->following->contains(Auth::id());
                                                @endphp

                                                <button
                                                    class="btn {{ $isFollowing ? 'btn-outline-primary' : 'btn-primary' }}"
                                                    wire:loading.attr="disabled"
                                                    wire:target="toggleFollow({{ $user->id }})">
                                                    <span wire:loading.remove
                                                        wire:target="toggleFollow({{ $user->id }})">
                                                        @if ($isFollowing)
                                                            Unfollow
                                                        @else
                                                            Follow{{ $isFollowedBack ? ' Back' : '' }}
                                                        @endif
                                                    </span>
                                                    <span wire:loading wire:target="toggleFollow({{ $user->id }})">
                                                        <span class="spinner-border spinner-border-sm"
                                                            role="status"></span>
                                                    </span>
                                                </button>
                                            @else
                                                <p class="my-auto text-muted">You</p>
                                            @endif
                                        @endif
                                    </div>
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
                </div>

                {{-- comment --}}
                <!-- Input Komentar -->
                {{-- <div class="card comments-section shadow">
                    <div class="card-header">
                        <h3>Comments</h3>
                    </div>
                    <div class="card-body"> --}}
                <livewire:post.comment :post="$post" />
                {{-- </div>
                </div> --}}
            </div>
        </div>
    </div>


</div>
