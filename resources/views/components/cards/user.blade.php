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
                                if (
                                    $user->profile_picture &&
                                    Storage::disk('public')->exists($user->profile_picture)
                                ) {
                                    $AvatarUrl = Storage::url($user->profile_picture);
                                } else {
                                    $AvatarUrl = asset('img/default_profile_picture.jpg');
                                }
                            @endphp
                            <img src="{{ $AvatarUrl }}" alt=""
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
                            <div wire:click="toggleFollow({{ $user->id }})" style="cursor: pointer;">
                                @if (Auth::user()->following->contains($user->id))
                                    <div class="btn btn-outline-primary">
                                        Unfollow
                                    </div>
                                @else
                                    <div class="btn btn-primary">
                                        Follow
                                        {{ !Auth::user()->following->contains($user->id) && $user->following->contains(Auth::id()) ? 'Back' : '' }}
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
    </div>
</div>
