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
                <a href="{{ route('profile.show', $username) }}" style="color: inherit; text-decoration: none;">
                    <span class="d-flex">
                        <div class="me-2">
                            <img src="{{ $AvatarUrl }}" alt=""
                                class="rounded-circle border-4 border-white-color-40">
                        </div>
                        <div class="my-auto">
                            <h6 class="mt-0 mb-0">{{ $name }}</h6>
                            <p class="mb-0 mt-0 text-body" style="text-decoration: none">
                                {{ '@' . $username }}</p>
                        </div>
                    </span>
                </a>
                <span class="my-auto">
                    <div align="right">
                        @if (Auth::check() && Auth::id() !== $userId)
                            <button wire:click="toggleFollow" wire:loading.attr="disabled"
                                class="btn {{ $isFollowing ? 'btn-outline-primary' : 'btn-primary' }}"
                                style="cursor:pointer;">
                                <span>
                                    {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                                    {{ !$isFollowing && $following->contains(Auth::id()) ? 'Back' : '' }}
                                </span>
                            </button>
                        @elseif (Auth::check() && Auth::id() === $userId)
                            <p class="my-auto text-muted">You</p>
                        @endif
                    </div>
                    <div class="mt-1" align="right">
                        <i><span class="follower-count">{{ count($followers) }}</span>
                            follower</i>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>
