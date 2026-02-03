<div>
    @if (session('successAlert'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('successAlert') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form wire:submit.prevent="submit">
        <div class="mb-3">
            <label for="" class="form-label">Old E-mail address</label>
            <input type="email" class="form-control" placeholder="{{ $masked_email }}" wire:model.defer="old_email">
            @if ($errors->has('old_email'))
                <div class="form-text text-danger">
                    {{ $errors->first('old_email') }}
                </div>
            @endif

        </div>
        <div class="mb-3">
            <label for="" class="form-label">New E-mail address</label>
            <input type="email" class="form-control" aria-describedby="" maxlength="50" wire:model.defer="new_email">
            @if ($errors->has('new_email'))
                <div id="defaultFormControlHelp" class="form-text text-danger">
                    {{ $errors->first('new_email') }}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Confirm New E-mail address</label>
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
            <input type="password" name="password" class="form-control" wire:model.defer="password" required>
            @if ($errors->has('password'))
                <div id="defaultFormControlHelp" class="form-text text-danger">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>
        <div align="right">
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:loading.class="opacity-50"
                wire:target="submit">
                <span wire:loading.remove wire:target="submit">
                    Change E-mail
                </span>

                <span wire:loading wire:target="submit">
                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                </span>
            </button>
        </div>
    </form>
</div>
