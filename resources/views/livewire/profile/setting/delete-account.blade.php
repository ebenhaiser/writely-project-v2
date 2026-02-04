<div>
    <div align="right">
        <button type="submit" class="btn btn-danger" wire:loading.attr="disabled" wire:loading.class="opacity-50"
            wire:target="submit" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
            <span wire:loading.remove wire:target="submit">
                Delete Account
            </span>
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Authentication Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control" wire:model.defer="email">
                        @if ($errors->has('password'))
                            <div class="form-text text-danger">
                                {{ $errors->first('password') }}
                            </div>
                        @endif

                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">New Password</label>
                        <input type="password" class="form-control" wire:model.defer="password">
                        @if ($errors->has('password'))
                            <div id="defaultFormControlHelp" class="form-text text-danger">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>

                    <button type="submit" class="btn btn-outline-danger" wire:loading.attr="disabled"
                        wire:loading.class="opacity-50" wire:target="submit">
                        <span wire:loading.remove wire:target="submit">
                            Delete Account
                        </span>

                        <span wire:loading wire:target="submit">
                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Confirm Delete Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control" wire:model.defer="email">
                        @if ($errors->has('password'))
                            <div class="form-text text-danger">
                                {{ $errors->first('password') }}
                            </div>
                        @endif

                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">New Password</label>
                        <input type="password" class="form-control" wire:model.defer="password">
                        @if ($errors->has('password'))
                            <div id="defaultFormControlHelp" class="form-text text-danger">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>

                    <button type="submit" class="btn btn-outline-danger" wire:loading.attr="disabled"
                        wire:loading.class="opacity-50" wire:target="submit">
                        <span wire:loading.remove wire:target="submit">
                            Delete Account
                        </span>

                        <span wire:loading wire:target="submit">
                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
