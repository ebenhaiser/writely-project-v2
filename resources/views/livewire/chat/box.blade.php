<div class="h-100 d-flex flex-column position-relative">

    <!-- HEADER (FIXED) -->
    <div class="border-bottom p-3 d-flex align-items-center gap-3 flex-shrink-0 bg-white">
        <a href="{{ route('messages') }}" class="btn btn-light d-md-none">
            ←
        </a>

        <img src="{{ $this->profilePicturePath($receiver->profile_picture) }}" class="rounded-circle" width="40"
            height="40">

        <div>
            <div class="fw-bold">{{ $receiver->name }}</div>
            <small class="text-muted">{{ '@' . $receiver->username }}</small>
        </div>
    </div>

    <!-- MESSAGES (SCROLL DI SINI) -->
    <div id="chatBody" class="flex-grow-1 overflow-auto p-3 bg-light" wire:poll.3s="loadMessages"
        wire:init="$dispatch('chat-mounted')">

        @foreach ($chatMessages as $msg)
            <div wire:key="msg-{{ $msg->id }}"
                class="mb-2 d-flex {{ $msg->from_user_id === auth()->id() ? 'justify-content-end' : '' }}">
                <div
                    class="px-3 py-2 rounded
            {{ $msg->from_user_id === auth()->id() ? 'bg-primary text-white' : 'bg-white border' }}">
                    {{ $msg->message }}
                </div>
            </div>
        @endforeach

    </div>

    <!-- INPUT (NEMPEL BAWAH) -->
    <form wire:submit.prevent="send" class="p-3 border-top bg-white flex-shrink-0">
        <div class="input-group">
            <input type="text" wire:model.defer="message" class="form-control" placeholder="Type a message...">
            <button class="btn btn-primary">
                <i class="ti ti-arrow-circle-right"></i>
            </button>
        </div>
    </form>

    <button id="scrollToBottomBtn" class="btn btn-primary rounded-circle shadow d-none"
        style="position:absolute; bottom:90px; right:20px; z-index:20;">
        ⬇
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            let chatBody;
            let scrollBtn;
            let shouldAutoScroll = true;

            function scrollToBottom(force = false) {
                if (!chatBody) return;

                if (force || shouldAutoScroll) {
                    chatBody.scrollTop = chatBody.scrollHeight;
                }
                scrollBtn.classList.add('d-none');
                shouldAutoScroll = true;
            }

            // 🔥 EVENT KHUSUS SETELAH SEND (INI YANG KAMU TANYA)
            Livewire.on('chat-scroll-bottom', () => {
                setTimeout(() => {
                    scrollToBottom(true);
                }, 80); // tunggu DOM update
            });

            // 🔥 CHAT SUDAH BENAR-BENAR TER-RENDER
            Livewire.on('chat-mounted', () => {
                chatBody = document.getElementById('chatBody');
                scrollBtn = document.getElementById('scrollToBottomBtn');

                // USER SCROLL DETECTION
                chatBody.addEventListener('scroll', () => {
                    const threshold = 100;
                    const atBottom =
                        chatBody.scrollTop + chatBody.clientHeight >=
                        chatBody.scrollHeight - threshold;

                    shouldAutoScroll = atBottom;

                    if (!atBottom) {
                        scrollBtn.classList.remove('d-none');
                    } else {
                        scrollBtn.classList.add('d-none');
                    }
                });

                // FIRST LOAD — PAKSA
                setTimeout(() => scrollToBottom(true), 100);
            });

            // 🔥 SETELAH SETIAP UPDATE LIVEWIRE (poll, dsb)
            Livewire.hook('message.processed', (message, component) => {
                if (component.name === 'chat.box') {
                    setTimeout(() => scrollToBottom(), 50);
                }
            });

            // BUTTON MANUAL
            document.addEventListener('click', (e) => {
                if (e.target.closest('#scrollToBottomBtn')) {
                    scrollToBottom(true);
                }
            });

        });
    </script>
</div>
