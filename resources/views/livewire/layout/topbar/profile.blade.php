<div>
    <li class="dropdown pc-h-item header-user-profile">
        <a class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
            role="button" aria-haspopup="false" aria-expanded="false">
            <img src="{{ $profilePictureUrl }}" alt="user-image" class="user-avtar" />
            <span>
                <i class="ti ti-settings"></i>
            </span>
        </a>
        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
            <div class="dropdown-header">
                <h4>
                    Good Morning,
                </h4>
                <p class="text-muted">{{ $name }}</p>
                <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 280px)">
                    <hr />
                    <a href="{{ route('profile.show', ['username' => $username]) }}" class="dropdown-item">
                        <i class="ti ti-user"></i>
                        <span>Social Profile</span>
                    </a>
                    <a href="{{ route('profile.setting') }}" class="dropdown-item">
                        <i class="ti ti-settings"></i>
                        <span>Account Settings</span>
                    </a>
                    <a href="{{ route('profile.bookmark') }}" class="dropdown-item">
                        <i class="ti ti-bookmarks"></i>
                        <span>Bookmark</span>
                    </a>
                    <a href="{{ route('profile.history') }}" class="dropdown-item">
                        <i class="ti ti-clock"></i>
                        <span>History</span>
                    </a>
                    <a href="{{ route('logout') }}" class="dropdown-item text-danger">
                        <i class="ti ti-logout"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </li>
</div>
