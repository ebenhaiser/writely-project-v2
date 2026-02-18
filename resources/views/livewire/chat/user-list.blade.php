<div class="h-100 d-flex flex-column">

    <!-- USER LIST -->
    <div class="flex-grow-1 overflow-auto">

        @forelse ($users as $user)
            <div
                wire:click="open('{{ $user->username }}')"
                class="d-flex align-items-center gap-3 p-3 border-bottom chat-user">

                <!-- FOTO -->
                <img
                    src="{{ $this->profilePicturePath($user->profile_picture) }}"
                    class="rounded-circle"
                    width="45"
                    height="45">

                <!-- INFO -->
                <div class="flex-grow-1">
                    <div class="fw-semibold">
                        {{ $user->name }}
                    </div>
                    <small class="text-muted">
                        {{ '@' . $user->username }}
                    </small>
                </div>

                <!-- WAKTU CHAT TERAKHIR -->
                @if ($user->last_message_at)
                    <small class="text-muted">
                        {{ \Carbon\Carbon::parse($user->last_message_at)->diffForHumans() }}
                    </small>
                @endif
            </div>
        @empty
            <div class="text-center text-muted p-4">
                Belum ada percakapan
            </div>
        @endforelse

    </div>

    <style>
        .chat-user {
            cursor: pointer;
            transition: background 0.2s;
        }

        .chat-user:hover {
            background-color: #f8f9fa;
        }
    </style>
</div>
