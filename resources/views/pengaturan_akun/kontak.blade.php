<div class="tab-pane fade" id="v-pills-kontak" role="tabpanel" aria-labelledby="v-pills-kontak-tab" tabindex="0">

    <div class="container">
        <div class="card mb-5">
            <div class="card-body">
                <h5 class="fw-bold">Ubah Nomor Telepon </h5>
                <form action="/profil-kandidat/users/{{ $user->slug }}/changeAccountSettings" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-5">
                            <div class="form-floating">
                                <input type="text" class="form-control 
                                @error('telepon_rumah')
                                    is-invalid
                                @enderror" id="nomor_telepon_baru"
                                    placeholder="Nomor Telepon" name="telepon_rumah"
                                    oninput="validatePasswordConfirmation()" maxlength="12">
                                @error('telepon_rumah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="floatingPassword">Masukkan nomor telepon baru</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-success" name="ganti_nomor_telepon" id="ganti_nomor_telepon"
                            value="ganti_nomor_telepon">
                            Ubah Nomor Telepon
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
