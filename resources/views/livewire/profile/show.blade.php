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
                {{-- <div class="pt-20 rounded-top"
                style="background: url(https://placehold.co/400) 0% 0% / cover no-repeat;">
            </div> --}}
                <div class="bg-white rounded-bottom smooth-shadow-sm ">
                    <div class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
                        <div class="d-flex align-items-center">
                            <div
                                class="avatar-profile avatar-xxl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                                @php
                                    $avatarPath = public_path('img/profilePicture/' . $profile->profile_picture);
                                    $avatarlUrl =
                                        $profile->profile_picture && file_exists($avatarPath)
                                            ? asset('img/profilePicture/' . $profile->profile_picture)
                                            : 'https://placehold.co/400';
                                @endphp
                                <img src="{{ $avatarlUrl }}" alt=""
                                    class="avatar-xxl rounded-circle  border-4 border-white-color-40">
                                {{-- <a class="position-absolute top-0 right-0 me-2" data-bs-toggle="tooltip"
                            data-placement="top" title="" data-original-title="Verified"
                            href="/pages/profile#!"><img src="https://placehold.co/400" alt=""
                            height="30" width="30" class="">
                        </a> --}}
                            </div>
                            <div class="lh-1 profile-name me-4">
                                <h2 class="mb-0">{{ $profile->name }}</h2>
                                <p class="mb-2 d-block"><i>{{ '@' . $profile->username }}</i></p>
                                {{-- @if ($profile->bio) --}}
                                <p>{{ $profile->bio }}</p>
                                {{-- @endif --}}
                            </div>
                        </div>
                        @if (Auth::check() && Auth::user()->username == $profile->username)
                            <div class="btn-edit-profile">
                                <a class="btn btn-outline-primary" href="#">Edit Profile</a>
                            </div>
                        @elseif (Auth::check() && Auth::user()->username != $profile->username)
                            <button class="btn btn-primary follow-btn" data-user-id="{{ $profile->id }}">
                                <span class="follow-text">Follow</span>
                            </button>
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
                            <a href="" style="color: inherit; text-decoration: none;" data-bs-toggle="modal"
                                data-bs-target="#followModal" wire:click="followModal('following')">
                                <h6>Following</h6>
                                <p align="center">{{ count($profile->following) }}</p>
                            </a>
                        </span>
                        <span>
                            <a href="#" style="color: inherit; text-decoration: none;" data-bs-toggle="modal"
                                data-bs-target="#followModal" wire:click="followModal('follower')">
                                <h6>Followers</h6>
                                <p align="center">{{ count($profile->followers) }}</p>
                            </a>
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
    <div class="row">
        @forelse ($posts as $post)
            <x-cards.post-small :post="$post" />
        @empty
            <div class="col-md-12" align="center">
                <i>No post yet.</i>
            </div>
        @endforelse
        {{ $posts->links() }}
    </div>

    <!-- Modal -->
    <div class="modal fade" id="followModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">{{ $followModalTitle }}</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="clearFollowModal()"></button>
                </div>
                <div class="modal-body">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="clearFollowModal()">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
