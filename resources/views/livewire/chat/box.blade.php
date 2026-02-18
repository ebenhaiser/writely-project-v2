<div class="h-100 d-flex flex-column position-relative">

    <!-- HEADER -->
    <div class="border-bottom p-3 d-flex align-items-center gap-3 bg-white flex-shrink-0">
        <img src="{{ $this->profilePicturePath($receiver->profile_picture) }}" class="rounded-circle" width="40"
            height="40">

        <div>
            <div class="fw-bold">{{ $receiver->name }}</div>
            <small class="text-muted">{{ '@' . $receiver->username }}</small>
        </div>
    </div>

    <!-- CHAT BODY (SCROLL AREA) -->
    <div id="chatBody" class="flex-grow-1 overflow-auto p-3 bg-light" wire:init="$dispatch('chat-mounted')">
        @foreach ($chatMessages as $msg)
            <div class="mb-2 d-flex {{ $msg->from_user_id === Auth::id() ? 'justify-content-end' : '' }}"
                wire:key="msg-{{ $msg->id }}">
                <div
                    class="d-flex flex-column
            {{ $msg->from_user_id === Auth::id() ? 'align-items-end' : 'align-items-start' }}">

                    <!-- BUBBLE -->
                    <div
                        class="px-3 py-2 rounded
                {{ $msg->from_user_id === Auth::id() ? 'bg-primary text-white' : 'bg-white border' }}">
                        {{ $msg->message }}
                    </div>

                    <!-- JAM -->
                    <small class="text-muted mt-1" style="font-size: 11px;">
                        {{ $msg->created_at->format('H:i') }}
                    </small>

                </div>
            </div>
        @endforeach

    </div>

    <!-- INPUT -->
    <form wire:submit.prevent="send" class="p-3 border-top bg-white flex-shrink-0">
        <div class="input-group">
            <input type="text" wire:model.defer="message" class="form-control" placeholder="Type a message..."
                autocomplete="off">
            <button class="btn btn-primary">Send</button>
        </div>
    </form>

    <!-- SCROLL BUTTON -->
    <button id="scrollBtn" class="btn btn-primary rounded-circle d-none"
        style="position:absolute; bottom:90px; right:20px;">
        ⬇
    </button>

    <!-- SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            let chatBody = null;
            let scrollBtn = null;
            let autoScroll = true;

            function scrollToBottom(force = false) {
                if (!chatBody) return;

                if (force || autoScroll) {
                    chatBody.scrollTo({
                        top: chatBody.scrollHeight,
                        behavior: 'smooth'
                    });
                }

                scrollBtn.classList.add('d-none');
            }

            // pertama kali chat dibuka
            Livewire.on('chat-mounted', () => {
                chatBody = document.getElementById('chatBody');
                scrollBtn = document.getElementById('scrollBtn');

                chatBody.addEventListener('scroll', () => {
                    const atBottom =
                        chatBody.scrollTop + chatBody.clientHeight >=
                        chatBody.scrollHeight - 50;

                    autoScroll = atBottom;

                    scrollBtn.classList.toggle('d-none', atBottom);
                });

                setTimeout(() => scrollToBottom(true), 100);
            });

            // setelah kirim message
            Livewire.on('scroll-chat-bottom', () => {
                setTimeout(() => scrollToBottom(true), 100);
            });

            // manual scroll button
            scrollBtn?.addEventListener('click', () => {
                scrollToBottom(true);
            });

        });
    </script>

</div>
