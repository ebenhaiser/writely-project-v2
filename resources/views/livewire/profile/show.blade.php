<div>
    <style>
        .avatar-profile img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .profile-name h2 {
            font-size: 18px;
        }

        .profile-name p {
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .avatar-profile img {
                width: 60px;
                height: 60px;
            }

            .profile-name h2 {
                font-size: 16px;
            }

            .profile-name p {
                font-size: 12px;
            }

            .btn-edit-profile a {
                font-size: 12px;
                width: 60px;
                padding: 4px 8px;
            }

            .profile-post-follow span h5,
            .profile-post-follow span p {
                font-size: 14px
            }
        }
    </style>

    <div class="card shadow">
        <div class="align-items-center row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                <div class="bg-white rounded-bottom smooth-shadow-sm ">
                    <div class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
                        <div class="d-flex align-items-center">
                            <div
                                class="avatar-profile avatar-xxl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                                @php
                                    $avatarPath = public_path('img/profilePicture/' . $profile->profile_picture);
                                    $avatarUrl =
                                        $profile->profile_picture && file_exists($avatarPath)
                                            ? asset('img/profilePicture/' . $profile->profile_picture)
                                            : 'https://placehold.co/400';
                                @endphp
                                <img src="{{ $avatarUrl }}" alt=""
                                    class="avatar-xxl rounded-circle  border-4 border-white-color-40">
                            </div>
                            <div class="lh-1 profile-name me-4">
                                <h2 class="mb-0">{{ $profile->name }}</h2>
                                <p class="mb-2 d-block"><i>{{ '@' . $profile->username }}</i></p>
                                @if ($profile->bio)
                                    <p>{{ $profile->bio }}</p>
                                @endif
                            </div>
                        </div>
                        @if (Auth::check())
                            @if (Auth::id() !== $profile->id)
                                @php
                                    $isFollowing = Auth::user()->following->contains($profile->id);
                                    $isFollowedBack = $profile->following->contains(Auth::id());
                                    $buttonText = $isFollowing
                                        ? 'Unfollow'
                                        : 'Follow' . ($isFollowedBack ? ' Back' : '');
                                @endphp

                                <button wire:click="toggleFollow({{ $profile->id }})"
                                    class="btn {{ $isFollowing ? 'btn-outline-primary' : 'btn-primary' }} px-4"
                                    wire:loading.attr="disabled" wire:loading.class="opacity-50"
                                    wire:target="toggleFollow({{ $profile->id }})">

                                    <span wire:loading.remove wire:target="toggleFollow({{ $profile->id }})">
                                        {{ $buttonText }}
                                    </span>

                                    <span wire:loading wire:target="toggleFollow({{ $profile->id }})">
                                        <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                    </span>
                                </button>
                            @else
                                <button wire:click="editProfile()" class="btn btn-outline-primary">
                                    Edit
                                </button>
                            @endif
                        @endif
                    </div>
                    <div class="mt-3 mb-3 px-4 d-flex gap-5 profile-post-follow">
                        <span>
                            <div style="color: inherit; text-decoration: none;">
                                <h6>Post</h6>
                                <p align="center">{{ count($profile->posts) }}</p>
                            </div>
                        </span>
                        <span>
                            <button style="color: inherit; text-decoration: none;" data-bs-toggle="modal"
                                data-bs-target="#followModal" wire:click="followModal('following')">
                                <h6>Following</h6>
                                <p align="center">{{ count($profile->following) }}</p>
                            </button>
                        </span>
                        <span>
                            <button style="color: inherit; text-decoration: none;" data-bs-toggle="modal"
                                data-bs-target="#followModal" wire:click="followModal('follower')">
                                <h6>Followers</h6>
                                <p align="center">{{ count($profile->followers) }}</p>
                            </button>
                        </span>
                    </div>
                    <div class="profile-nav">
                        <ul class="nav nav-underline nav-fill">
                            <li class="nav-item">
                                <button class="nav-link text-black {{ $profileNavbar == 'post' ? 'active' : '' }}"
                                    aria-current="page" wire:click="setProfileNavbar('post')">Posts
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link text-black {{ $profileNavbar == 'like' ? 'active' : '' }}"
                                    aria-current="page" wire:click="setProfileNavbar('like')">Likes
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link text-black {{ $profileNavbar == 'comment' ? 'active' : '' }}"
                                    aria-current="page" wire:click="setProfileNavbar('comment')">Comments
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:loading.remove
        wire:target="setProfileNavbar('post'), setProfileNavbar('like'), setProfileNavbar('comment')">
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

    <!-- Modal -->
    <div class="modal fade" id="followModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel" wire:loading.remove
                        wire:target="followModal('following'), followModal('follower')">{{ $followModalTitle }}</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:loading.attr="disabled"
                        wire:target="followModal('following'), followModal('follower')"></button>
                </div>
                <div class="modal-body">
                    <div wire:loading.remove wire:target="followModal('following'), followModal('follower')">
                        @if (count($followModalData) > 0)
                            @foreach ($followModalData as $user)
                                <x-cards.user :user="$user" />
                            @endforeach
                        @else
                            <div align="center">
                                <i>No data found.</i>
                            </div>
                        @endif
                    </div>
                    <div wire:loading wire:target="followModal('following'), followModal('follower')"
                        class="d-flex justify-content-center align-items-center gap-3" style="min-height: 200px;">
                        <span class="spinner-border text-primary" role="status">
                        </span>
                        <span class="">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:loading.attr="disabled"
                        wire:target="followModal('following'), followModal('follower')">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
