<div>
    <div class="d-flex flex-column h-100">

        <!-- HEADER -->
        <div class="border-bottom p-3 d-flex align-items-center gap-3">
            <a href="{{ route('messages') }}" class="btn btn-light d-md-none">
                ←
            </a>

            <img src="{{ asset('img/profilePicture/' . ($receiver->profile_picture ?? 'default.jpg')) }}"
                class="rounded-circle" width="40" height="40">

            <div>
                <div class="fw-bold">{{ $receiver->name }}</div>
                <small class="text-muted">@{{ $receiver - > username }}</small>
            </div>
        </div>

        <!-- MESSAGES -->
        <div id="chatBody" class="flex-grow-1 overflow-auto p-3 bg-light" wire:poll.3s="loadMessages">

            @foreach ($messages as $msg)
                <div class="mb-2 d-flex {{ $msg->from_user_id === auth()->id() ? 'justify-content-end' : '' }}">
                    <div
                        class="px-3 py-2 rounded
                    {{ $msg->from_user_id === auth()->id() ? 'bg-primary text-white' : 'bg-white border' }}">
                        {{ $msg->message }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- INPUT -->
        <form wire:submit.prevent="send" class="p-3 border-top bg-white">
            <div class="input-group">
                <input type="text" wire:model.defer="message" class="form-control" placeholder="Type a message...">
                <button class="btn btn-primary">
                    <i class="bx bx-send"></i>
                </button>
            </div>
        </form>

    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('scroll-bottom', () => {
                let chat = document.getElementById('chatBody');
                chat.scrollTop = chat.scrollHeight;
            });
        });
    </script>
</div>
