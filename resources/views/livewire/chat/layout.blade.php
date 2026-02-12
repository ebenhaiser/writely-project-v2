<div class="card">
    <div class="row">

        <!-- USER LIST -->
        <div class="col-md-4 col-lg-3 border-end p-0
            {{ $receiver ? 'd-none d-md-block' : '' }}">
            {{-- <livewire:chat.user-list /> --}}
        </div>

        <!-- CHAT BOX -->
        <div class="col-md-8 col-lg-9 p-0">
            @if ($receiver)
                {{-- <livewire:chat.box :receiver="$receiver" :key="$receiver->id" /> --}}
            @else
                <div class="d-flex h-100 justify-content-center align-items-center text-muted">
                    <i>Select a conversation</i>
                </div>
            @endif
        </div>

    </div>
</div>
