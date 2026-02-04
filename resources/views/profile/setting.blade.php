<x-layout.main>
    <x-slot:title>{{ $title }}</x-slot:title>
    <livewire:profile.setting.profile-picture />

    <div class="accordion accordion-flush mb-3" id="accordionFlushExample">
        <div class="accordion-item">
            <div class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                    <h4>Profile</h4>
                </button>
            </div>
            <div id="flush-collapseOne" class="accordion-collapse collapse show"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <livewire:profile.setting.profile />
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        <h4>E-mail</h4>
                    </button>
                </div>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <livewire:profile.setting.email />
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        <h4>Password</h4>
                    </button>
                </div>
                <div id="flush-collapseThree" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <livewire:profile.setting.password />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.main>
