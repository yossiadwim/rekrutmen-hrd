<div class="tab-pane fade show active" id="v-pills-akun" role="tabpanel" aria-labelledby="v-pills-akun-tab" tabindex="0">

    <div class="container">
        <form action="/profil-kandidat/users/{{ $user->slug }}/changeAccountSettings" method="POST">
            @csrf
            <div class="card mb-5">
                <div class="card-body">
                    <h5 class="fw-bold">Ganti Kata Sandi </h5>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                <input type="password"
                                    class="form-control @error('password')
                                    is-invalid
                                @enderror"
                                    id="password_baru" placeholder="Password" name="password"
                                    oninput="validatePasswordConfirmation()">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="floatingPassword">Masukkan kata sandi baru</label>
                            </div>
                            <button type="button" id="showpasswordbaru" class="btn btn-light btn-sm mt-1"
                                onclick="togglePasswordVisibility()">Tampilkan kata sandi</button>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="password" name="konfirmasi_password_baru"
                                    class="form-control @error('konfirmasi_password_baru')
                                    is-invalid
                                @enderror"
                                    id="konfirmasi_password_baru" placeholder="Password"
                                    oninput="validatePasswordConfirmation()">
                                @error('konfirmasi_password_baru')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="floatingPassword">Konfirmasi kata sandi baru</label>
                            </div>
                            <button type="button" id="showkonfirmasipasswordbaru" class="btn btn-light btn-sm mt-1"
                                onclick="togglePasswordVisibility()">Tampilkan kata sandi</button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-success" name="ganti_kata_sandi" id="ganti_kata_sandi" value="ganti_kata_sandi">
                            Ganti kata sandi
                        </button>
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-body">
                    <h5 class="fw-bold">Ganti Email </h5>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-floating">
                                <input type="email"
                                    class="form-control @error('email')
                                    is-invalid
                                @enderror"
                                    id="email" placeholder="Password" name="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="email">Masukkan email baru</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-success" name="ganti_email_baru" value="ganti_email_baru" id="ganti_email_baru">
                            Ganti Email
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>



</div>
<div id="loader" class="loader-wrapper" style="display: none;">
    <div class="loader"></div>
    <div class="mx-2 fw-bold text-light">Loading...</div>
</div>
