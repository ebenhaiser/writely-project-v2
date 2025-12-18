<div>
    <style>
        .avatar-profile img {
            /* width: 100px;
                height: 100px; */
            object-fit: cover;
        }

        .profile-name h2 {
            font-size: 18px;
        }

        .profile-name p {
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .avatar-profile img {
                width: 80px;
                height: 80px;
            }

            .profile-name h2 {
                font-size: 18px;
            }

            .profile-name p {
                font-size: 14px;
            }

            .btn-edit-profile a {
                font-size: 12px;
                width: 60px;
                padding: 4px 8px;
            }

            .profile-post-follow span h5,
            .profile-post-follow span p {
                font-size: 14px
            }
        }
    </style>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="d-flex flex-wrap align-items-center justify-content-between pt-4 pb-6 px-0">
                    <div class="col-sm-8">
                        <div class="d-flex align-items-center avatar-edit">
                            <div
                                class="avatar-profile avatar-xxl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                                <img src="https://placehold.co/400" alt=""
                                    class="avatar-xxl rounded-circle border border-white-color-40" width="80"
                                    height="80">
                            </div>
                            <div class="lh-1 profile-name">
                                <h2 class="mb-0">{{ $name }}<a class="text-decoration-none"
                                        data-bs-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="Beginner" href="/pages/profile#!"></a></h2>
                                <p class="mb-2 d-block"><i>{{ '@' . $username }}</i></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-primary flex-fill" data-bs-toggle="modal"
                                data-bs-target="#change-profile-picture">Change Profile Picture</button>

                            <button type="button" class="btn btn-danger flex-fill" data-bs-toggle="modal"
                                data-bs-target="#delete-profile-picture">Delete Profile Picture</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="change-profile-picture" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Change Profile Picture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" align="center">
                    <input type="file" name="profile_picture" accept="image/*" class="form-control" required>
                    <div id="" class="form-text">Upload your picture</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Change Picture</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-profile-picture" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Delete Profile Picture</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" align="center">
                    {{-- <img src="{{ asset('img/profilePicture/' . (Auth::user()->profile_picture && file_exists(public_path('img/profilePicture/' . Auth::user()->profile_picture)) ? Auth::user()->profile_picture : 'default.jpg')) }}"
                                    alt=""
                                    class="avatar-xxl rounded-circle border border-white-color-40"
                                    width="130" height="130"> --}}
                    <p class="mt-2"><i>Are you sure want to delete your profile picture?</i></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="" class="btn btn-danger">Delete Profile Picture</a>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal --}}
</div>
