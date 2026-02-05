<div>
    <style>
        .register-container {
            max-width: 520px;
            margin: auto;
        }

        .stepper {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .stepper::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: #dee2e6;
            transform: translateY(-50%);
        }

        .step {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #dee2e6;
            color: #6c757d;
            font-weight: 600;
            text-align: center;
            line-height: 36px;
            z-index: 1;
        }

        .step.active {
            background: #6c757d;
            color: #fff;
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }

        .step-content {
            opacity: 0;
            transform: translateX(30px);
            transition: all .35s ease;
            pointer-events: none;
        }

        .step-content.active {
            opacity: 1;
            transform: translateX(0);
            pointer-events: auto;
        }
    </style>

    <div class="register-container">
        <!-- STEP INDICATOR -->
        <div class="stepper mb-4">
            <div class="step {{ $step == 1 ? 'active' : '' }}">1</div>
            <div class="step {{ $step == 2 && $stepPassed >= 2 ? 'active' : '' }}">2</div>
            <div class="step {{ $step == 3 && $stepPassed == 3 ? 'active' : '' }}">3</div>
        </div>

        <!-- STEP 1 -->
        <div class="step-content {{ $step == 1 ? 'active' : '' }}">
            <h5 class="mb-3">Personal Information</h5>
            <form wire:submit.prevent="submitStep1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="First Name" wire:model='firstName'>
                            <label>First Name</label>
                            @if ($errors->has('firstName'))
                                <div class="form-text text-danger">
                                    {{ $errors->first('firstName') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Last Name (Optional)"
                                wire:model='lastName'>
                            <label>Last Name (Optional)</label>
                            @if ($errors->has('lastName'))
                                <div class="form-text text-danger">
                                    {{ $errors->first('lastName') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-secondary">Next</button>
                </div>
            </form>
        </div>

        <!-- STEP 2 -->
        <div class="step-content {{ $step == 2 ? 'active' : '' }}">
            <h5 class="mb-3">Account Details</h5>
            <form wire:submit.prevent="submitStep2">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" placeholder="Email" wire:model.defer="email">
                    <label>Email Address</label>
                    @if ($errors->has('email'))
                        <div class="form-text text-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Username" wire:model.defer="username">
                    <label>Username</label>
                    @if ($errors->has('username'))
                        <div class="form-text text-danger">
                            {{ $errors->first('username') }}
                        </div>
                    @endif
                </div>

                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary w-50" wire:click="previousBtn">Back</button>
                    <button type="submit" class="btn btn-secondary w-50">Next</button>
                </div>
            </form>
        </div>

        <!-- STEP 3 -->
        <div class="step-content {{ $step == 3 ? 'active' : '' }}">
            <h5 class="mb-3">Security</h5>
            <form wire:submit.prevent="submitStep3">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder="Password" wire:model.defer="password">
                    <label>Password</label>
                    @if ($errors->has('password'))
                        <div class="form-text text-danger">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password"
                        wire:model.defer="confirm_password">
                    <label>Confirm Password</label>
                    @if ($errors->has('confirm_password'))
                        <div class="form-text text-danger">
                            {{ $errors->first('confirm_password') }}
                        </div>
                    @endif
                </div>

                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary w-50" wire:click="previousBtn">Back</button>
                    <button type="submit" class="btn btn-secondary w-50">Create Account</button>
                </div>
            </form>
        </div>
    </div>

</div>
