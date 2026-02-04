<div>
    <div align="right">
        <button type="submit" class="btn btn-danger" wire:loading.attr="disabled" wire:loading.class="opacity-50"
            wire:target="submit" data-bs-toggle="modal" data-bs-target="#deleteAccountModal" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="submit, confirm">
                Delete Account
            </span>
            <span wire:loading wire:target="submit, confirm">
                <span class="spinner-border spinner-border-sm me-1" role="status"></span>
            </span>
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-danger">Authentication Account</h5>
                    <button type="button" class="btn-close" wire:click="cancel" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" wire:model.defer="email"
                            wire:loading.attr="readonly">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" wire:model.defer="password"
                            wire:loading.attr="readonly">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" wire:click="cancel"
                        wire:loading.attr="disabled">Cancel</button>
                    <button class="btn btn-danger" wire:click="submit" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="submit, confirm">
                            Delete Account
                        </span>
                        <span wire:loading wire:target="submit, confirm">
                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                        </span>
                    </button>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="confirmationDeleteAccountModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-danger">Confirm Delete Account</h5>
                    <button type="button" class="btn-close" wire:click="cancel" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label align="center">Type "DELETE"</label>
                    <input type="text" class="form-control" wire:model.defer="confirmationWord"
                        wire:loading.attr="readonly">
                    @error('confirmationWord')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" wire:click="cancel"
                        wire:loading.attr="disabled">Cancel</button>
                    <button class="btn btn-outline-danger" wire:click="confirm" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="submit, confirm">
                            Delete Account
                        </span>
                        <span wire:loading wire:target="submit, confirm">
                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                        </span>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {

            Livewire.on('open-auth-modal', () => {
                new bootstrap.Modal(
                    document.getElementById('deleteAccountModal')
                ).show();
            });

            Livewire.on('close-auth-modal', () => {
                bootstrap.Modal
                    .getInstance(document.getElementById('deleteAccountModal'))
                    ?.hide();
            });

            Livewire.on('open-confirm-modal', () => {
                new bootstrap.Modal(
                    document.getElementById('confirmationDeleteAccountModal')
                ).show();
            });

        });
    </script>

</div>
