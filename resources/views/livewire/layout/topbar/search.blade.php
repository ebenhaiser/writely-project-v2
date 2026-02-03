<div>
    <style>
        .list-group-item {
            padding: 0.25rem 0.25rem;
        }
    </style>

    <li class="dropdown pc-h-item d-inline-flex d-md-none">
        <a class="pc-head-link head-link-secondary dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown" href="#"
            role="button" aria-haspopup="false" aria-expanded="false">
            <i class="ti ti-search"></i>
        </a>
        <div class="dropdown-menu pc-h-dropdown drp-search">
            <form class="px-3">
                <div class="mb-0 d-flex align-items-center">
                    <i data-feather="search"></i>
                    <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . ."
                        wire:model.live.debounce.300ms="keyword" />
                </div>
            </form>
        </div>
    </li>
    <li class="pc-h-item d-none d-md-inline-flex">
        <form class="header-search">
            <i data-feather="search" class="icon-search"></i>
            <input type="search" class="form-control" placeholder="Search here. . ."
                wire:model.live.debounce.300ms="keyword" />
            <button class="btn btn-light-secondary btn-search"><i class="ti ti-adjustments-horizontal"></i></button>
        </form>
    </li>

    {{-- DROPDOWN --}}
    @if (strlen($keyword) > 0 && (count($users) > 0 || count($posts) > 0))
        <div class="position-absolute top-100 bg-transparent">
            <ul class="list-group list-group-flush bg-transparent">
                @foreach ($users as $user)
                    <li class="list-group-item bg-transparent border-0">
                        <x-cards.user :user="$user" />
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
