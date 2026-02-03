<div>
    <x-layout.alert />
    <form wire:submit.prevent="submit">
        <div class="mb-3">
            <label for="" class="form-label">Display Name</label>
            <input type="text" class="form-control" placeholder="" wire:model.defer="name">
            @if ($errors->has('Nname'))
                <div class="form-text text-danger">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Username</label>
            <input type="text" class="form-control" placeholder="" wire:model.defer="username">
            @if ($errors->has('username'))
                <div class="form-text text-danger">
                    {{ $errors->first('username') }}
                </div>
            @endif
        </div>
        <div align="right">
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:loading.class="opacity-50"
                wire:target="submit">
                <span wire:loading.remove wire:target="submit">
                    Save Changes
                </span>

                <span wire:loading wire:target="submit">
                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                </span>
            </button>
        </div>
    </form>
</div>
