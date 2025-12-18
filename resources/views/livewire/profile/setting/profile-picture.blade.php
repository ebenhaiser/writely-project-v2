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

            /* Tambahkan style untuk spinner di gambar profil */
            .profile-spinner-container {
                width: 80px;
                height: 80px;
                display: flex;
                align-items: center;
                justify-content: center;
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
                                <!-- Spinner saat loading submit -->
                                <div wire:loading.flex wire:target="submit" class="profile-spinner-container">
                                    <span class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </span>
                                </div>

                                <!-- Gambar profil normal (saat tidak loading) -->
                                <div wire:loading.remove wire:target="submit">
                                    @php
                                        $user = Auth::user();
                                        $profilePictureUrl = $user->profile_picture
                                            ? Storage::url($user->profile_picture)
                                            : 'https://placehold.co/400';
                                    @endphp
                                    <img src="{{ $profilePictureUrl }}" alt="https://placehold.co/400"
                                        class="avatar-xxl rounded-circle border border-white-color-40" width="80"
                                        height="80">
                                </div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="clear()"></button>
                </div>

                <div class="modal-body" align="center">
                    <input type="file" name="profile_picture" class="form-control mb-1"
                        accept=".jpg, .jpeg, .png, .webp" wire:model="profile_picture">
                    @if ($errors->has('profile_picture'))
                        <div id="defaultFormControlHelp" class="form-text text-danger mb-1">
                            {{ $errors->first('profile_picture') }}
                        </div>
                    @endif
                    @if ($profile_picture)
                        <img src="{{ $profile_picture->temporaryUrl() }}" alt="Preview" class="img-fluid mt-3 rounded">
                    @elseif(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}"
                            alt="Current" class="img-fluid mt-3 rounded">
                    @else
                        <img src="https://placehold.co/400" alt="Preview" class="img-fluid mt-3 rounded">
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="clear()">Cancel</button>
                    <button class="btn btn-primary" wire:click="submit()" wire:loading.attr="disabled"
                        wire:loading.class="opacity-50" wire:target="submit(), profile_picture">
                        <span wire:loading wire:target="submit(), profile_picture">
                            <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                        </span>
                        <span wire:loading.remove wire:target="submit(), profile_picture" data-bs-dismiss="modal">Change
                            Picture</span>
                    </button>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        >Cancel</button>
                    <button href="" class="btn btn-danger" data-bs-dismiss="modal" wire:click="delete()">Delete Profile Picture</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal --}}
</div>
