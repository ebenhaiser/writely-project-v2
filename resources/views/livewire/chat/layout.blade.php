<div>
    <div class="card shadow chat-card">

        <div class="row g-0 chat-card-body">

            <!-- USER LIST -->
            <div class="col-md-4 border-end chat-userlist">
                <livewire:chat.user-list />
            </div>

            <!-- CHAT -->
            <div class="col-md-8 chat-main">
                @if ($receiver)
                    <livewire:chat.box :receiver="$receiver" :key="$receiver->id" />
                @else
                    <div class="h-100 d-flex justify-content-center align-items-center text-muted">
                        <i>Select a conversation</i>
                    </div>
                @endif
            </div>

        </div>

    </div>

    <style>
        /* CARD TETAP */
        .chat-card {
            height: calc(100vh - 120px);
            max-height: 800px;
        }

        /* GRID FIX */
        .chat-card-body {
            height: 100%;
        }

        /* USER LIST */
        .chat-userlist {
            height: 100%;
            overflow-y: auto;
        }

        /* CHAT MAIN */
        .chat-main {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
    </style>
</div>
