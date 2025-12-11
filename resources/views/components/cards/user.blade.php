<div>
    <style>
        .user-card img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
    <div class="card user-card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <a href="{{ route('profile.show', $user->username) }}" style="color: inherit; text-decoration: none;">
                    <span class="d-flex">
                        <div class="me-2">
                            @php
                                $AvatarPath = public_path('img/profilePicture/' . $user->profile_picture);
                                $AvatarlUrl =
                                    $user->profile_picture && file_exists($AvatarPath)
                                        ? asset('img/profilePicture/' . $user->profile_picture)
                                        : 'https://placehold.co/400';
                            @endphp
                            <img src="{{ $AvatarlUrl }}" alt=""
                                class="rounded-circle border-4 border-white-color-40">
                        </div>
                        <div class="my-auto">
                            <h6 class="mt-0 mb-0">{{ $user->name }}</h6>
                            <p class="mb-0 mt-0 text-body" style="text-decoration: none">
                                {{ '@' . $user->username }}</p>
                        </div>
                    </span>
                </a>
                <span class="my-auto">
                    <div align="right">
                        @if (Auth::check() && Auth::id() !== $user->id)
                            <div wire:click="toggleFollow()" style="cursor: pointer;">
                            @if ($followStatus)
                                <div class="btn btn-outline-primary">
                                    Unfollow
                                </div>
                            @else
                                <div class="btn btn-primary">
                                    Follow
                                </div>
                            @endif
                        </div>
                        @elseif (Auth::check() && Auth::id() === $user->id)
                            <p class="my-auto text-muted">You</p>
                        @endif
                    </div>
                    <div class="mt-1" align="right">
                        <i><span class="follower-count">{{ count($user->followers) }}</span>
                            follower</i>
                    </div>
                </span>
            </div>
        </div>
        {{-- <div class="card-footer d-flex justify-content-between">
        <span>
            <h7>Post</h7>
            <p>{{ count($user->posts) }}</p>
        </span>
        <span>
            <h7>Following</h7>
            <p>{{ count($profile->following) }}</p>
        </span>
        <span>
            <h6>Followers</h6>
            <p class="follower-count">{{ count($user->followers) }}</p>
        </span>
    </div> --}}
    </div>
</div>
