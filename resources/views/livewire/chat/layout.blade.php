<div>
    <div class="card shadow chat-card">
        <!-- HEADER -->
        <div class="card-header chat-header">
            <h5 class="mb-0">Messages</h5>
        </div>

        <!-- BODY -->
        <div class="row g-0 chat-body">

            <!-- USER LIST -->
            <div class="col-md-4 chat-userlist border-end">
                <livewire:chat.user-list />
            </div>

            <!-- CHAT AREA -->
            <div class="col-md-8 chat-main">
                <div class="h-100 d-flex flex-column" style="min-height:0">
                    @if ($receiver)
                        <livewire:chat.box :receiver="$receiver" :key="$receiver->id" />
                    @else
                        <div class="chat-empty">
                            <i>Select a conversation</i>
                        </div>
                    @endif

                </div>
            </div>




        </div>
    </div>

    <style>
        /* =========================
           CARD WRAPPER
        ========================== */
        .chat-card {
            height: calc(100vh - 120px);
            max-height: 800px;
            display: flex;
            flex-direction: column;
        }

        /* =========================
           HEADER (FIXED)
        ========================== */
        .chat-header {
            flex-shrink: 0;
            background: #fff;
            z-index: 2;
        }

        /* =========================
           BODY (FLEX)
        ========================== */
        .chat-body {
            flex: 1;
            min-height: 0;
            display: flex; 
        }

        /* =========================
           USER LIST
        ========================== */
        .chat-userlist {
            height: 100%;
            overflow-y: auto;
            background-color: #f8f9fa;
        }

        /* =========================
           CHAT MAIN
        ========================== */
        .chat-main {
            height: 100%;
            min-height: 0;
            display: flex;
            flex-direction: column;
            background-color: #fff;
        }

        /* =========================
           EMPTY STATE
        ========================== */
        .chat-empty {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }
    </style>
</div>
