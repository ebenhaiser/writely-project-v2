<div>
    <div class="card">
        <div class="card-header">
            <div class="h3">Email</div>
        </div>
        <div class="card-body">
            <form action="{{ route('change.email.submit', $profile->username) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Curent Email address</label>
                    <input type="text" class="form-control" value="{{ $profile->email }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">New Email address</label>
                    <input name="new_email1" class="form-control" id="" aria-describedby="" required
                        maxlength="50">
                </div>
                <div align="right">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#change-email">Change Email</button>
                </div>

                {{-- modal --}}
                <div class="modal fade" id="change-email" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                    Change Email</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" align="center">
                                <input type="password" name="password" class="form-control" placeholder="Enter password"
                                    required>
                                <div id="" class="form-text">Enter your password for changing email</div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Change Email</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end modal --}}
            </form>
        </div>
    </div>
</div>
