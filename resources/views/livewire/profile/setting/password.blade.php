<div>
    <x-layout.alert />
    <form wire:submit.prevent="submit">
        <div class="mb-3">
            <label for="" class="form-label">Old Password</label>
            <input type="password" class="form-control" wire:model.defer="old_password">
            @if ($errors->has('old_password'))
                <div class="form-text text-danger">
                    {{ $errors->first('old_password') }}
                </div>
            @endif

        </div>
        <div class="mb-3">
            <label for="" class="form-label">New Password</label>
            <input type="password" class="form-control" aria-describedby="" maxlength="50"
                wire:model.defer="new_password">
            @if ($errors->has('new_password'))
                <div id="defaultFormControlHelp" class="form-text text-danger">
                    {{ $errors->first('new_password') }}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" aria-describedby="" maxlength="50"
                wire:model.defer="confirm_new_password">
            @if ($errors->has('confirm_new_password'))
                <div id="defaultFormControlHelp" class="form-text text-danger">
                    {{ $errors->first('confirm_new_password') }}
                </div>
            @endif
        </div>
        <div align="right">
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:loading.class="opacity-50"
                wire:target="submit">
                <span wire:loading.remove wire:target="submit">
                    Change Password
                </span>

                <span wire:loading wire:target="submit">
                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                </span>
            </button>
        </div>
    </form>
</div>
