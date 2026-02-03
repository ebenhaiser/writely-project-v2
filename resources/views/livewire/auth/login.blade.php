<div>
    @if ($errors->has('loginFailed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('loginFailed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form wire:submit.prevent="submit">
        <input type="hidden" wire:model="returnUrl" />
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Email / Username"
                wire:model.defer="login" />
            <label for="floatingInput">Email / Username</label>
            @if ($errors->has('login'))
                <div id="defaultFormControlHelp" class="form-text text-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingInput1" placeholder="Password"
                wire:model.defer="password" />
            <label for="floatingInput1">Password</label>
            @if ($errors->has('password'))
                <div id="defaultFormControlHelp" class="form-text text-danger">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>
        <div class="d-flex mt-1 justify-content-between">
            {{-- <div class="form-check">
            <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="" />
            <label class="form-check-label text-muted" for="customCheckc1">Remember me</label>
        </div> --}}
            {{-- <h5 class="text-secondary">Forgot Password?</h5> --}}
        </div>
        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-secondary">Sign In</button>
        </div>
    </form>
</div>
