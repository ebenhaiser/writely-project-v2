<div>
    <div class="card">
        <div class="card-header">
            <h1>{{ $name }} {{ $follow == 'following' ? 'Following' : 'Followers' }}</h1>
        </div>
        <div class="card-body">
            <div>
                <input type="text" class="form-control w-100" aria-describedby="" maxlength="50"
                    placeholder="Search {{ $follow == 'following' ? 'Following' : 'Followers' }} ..." wire:model.defer="">
            </div>
        </div>
    </div>
</div>
