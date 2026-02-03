<div>
    {{-- <div class="card">
        <div class="card-header">
            <div class="h3">Email</div>
        </div>
        <div class="card-body"> --}}
            @if (session('successAlert'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('successAlert') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form wire:submit.prevent="submit">
                <div class="mb-3">
                    <label for="" class="form-label">Curent Email address</label>
                    <input type="text" class="form-control" wire:model.defer="masked_email" readonly>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">New Email address</label>
                    <input type="email" class="form-control" aria-describedby="" maxlength="50"
                        wire:model.defer="new_email">
                    @if ($errors->has('new_email'))
                        <div id="defaultFormControlHelp" class="form-text text-danger">
                            {{ $errors->first('new_email') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Confirm New Email address</label>
                    <input type="email" class="form-control" aria-describedby="" maxlength="50"
                        wire:model.defer="confirm_new_email">
                    @if ($errors->has('confirm_new_email'))
                        <div id="defaultFormControlHelp" class="form-text text-danger">
                            {{ $errors->first('confirm_new_email') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Enter your password for changing email</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password"
                        wire:model.defer="password" required>
                    @if ($errors->has('password'))
                        <div id="defaultFormControlHelp" class="form-text text-danger">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div align="right">
                    <button type="submit" class="btn btn-primary">Change Email</button>
                </div>
            </form>
        </div>
    {{-- </div>
</div> --}}
