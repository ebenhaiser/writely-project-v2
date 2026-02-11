<div>
    <div class="card">
        <div class="card-header">
            <h1>{{ $title }}</h1>
        </div>
        <div class="card-body">
            <div>
                <input type="text" class="form-control w-100" aria-describedby="" maxlength="50"
                    placeholder="Search {{ $follow == 'following' ? 'Following' : 'Followers' }} ..." wire:model.live="keyword">
            </div>
        </div>
    </div>

    @if (count($users) > 0)
        <div class="row">
            @foreach ($users as $user)
                <div class="col-md-4">
                    <x-cards.user :user="$user" />
                </div>
            @endforeach
        </div>
        {{ $users->links() }}
    @else
        <div align="center">
            <i>No data found.</i>
        </div>
    @endif
</div>
