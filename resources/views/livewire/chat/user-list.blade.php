<div>
    <div class="h-100 d-flex flex-column">

        <div class="flex-grow-1 overflow-auto">
            @foreach ($users as $user)
                <div wire:click="open('{{ $user->username }}')"
                    class="d-flex align-items-center gap-3 p-3 border-bottom chat-user">

                    <img src="{{ $this->profilePicturePath($user->profile_picture) }}" alt=""
                        class="rounded-circle" width="45" height="45">

                    <div>
                        <div class="fw-semibold">{{ $user->name }}</div>
                        <small class="text-muted">{{ '@' . $user->username }}</small>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <style>
        .chat-user {
            cursor: pointer;
        }

        .chat-user:hover {
            background-color: #f8f9fa;
        }
    </style>
</div>
