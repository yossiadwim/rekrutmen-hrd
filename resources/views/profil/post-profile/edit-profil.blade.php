<a href="/profil-kandidat/users/{{ $user->slug }}/edit" class="btn btn-success border-0" data-bs-toggle="modal"
    data-bs-target="#editProfil"></i>
    Edit Profil</a>

<!-- Modal -->
<div class="modal fade" id="editProfil" tabindex="-1" aria-labelledby="profilLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="profilLabel">Edit Profil</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    onclick="hapusData()"></button>
            </div>
            <form action="/profil-kandidat/users/{{ $user->slug }}" method="POST" id="formEditProfil"
                enctype="multipart/form-data">
                @method('put')
                <div class="modal-body">
                    @csrf
                    <div class="form-floating">
                        <input type="text" class="form-control mb-4 " name="nama_pelamar" id="namaPelamar"
                            placeholder="Nama Anda" value="{{ $user->pelamar->nama_pelamar }}" required>
                        <label for="namaPelamar">Nama Anda</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Masukkan email Anda" value="{{ $user->pelamar->email }}" readonly required>
                        <label for="email">Masukkan email Anda</label>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text"
                                    class="form-control @error('nomor_telepon')
                                     is-invalid
                                 @enderror"
                                    id="nomorTeleponPelamar" name="telepon_rumah" placeholder="Nomor telepon"
                                    aria-describedby="noHpHelp" value="{{ $user->pelamar->telepon_rumah }}"
                                    maxlength="12" required>
                                @error('nomor_telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="nomorTeleponPelamar" class="text-body-tertiary">Masukkan nomor telepon.
                                    Contoh 081234567890</label>
                            </div>

                        </div>
                    </div>


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            placeholder="Masukkan alamat anda" value="{{ $user->pelamar->alamat }}" required>
                        <label for="alamat">Masukkan alamat Anda</label>
                    </div>



                    <div class="mt-3 mb-2">
                        <label for="date" class="px-2">Masukkan tanggal lahir </label>
                        <input type="date"
                            class="form-control @error('tanggal_lahir')
                             is-invalid
                         @enderror"
                            id="tanggal_lahir" name="tanggal_lahir" value="{{ $user->pelamar->tanggal_lahir }}"
                            required>
                        @error('usia')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="mt-3 mb-2">
                        <label for="jenisKelamin">Jenis Kelamin</label>
                        <select
                            class="form-select  @error('jenis_kelamin')
                             is-invalid
                         @enderror"
                            id="jenisKelamin" aria-label="Default select example" name="jenis_kelamin">
                            @if (old('jenis_kelamin', $user->pelamar->jenis_kelamin) == 'laki-laki')
                                <option value="laki-laki" selected>Laki-laki</option>
                            @elseif(old('jenis_kelamin', $user->pelamar->jenis_kelamin) == 'perempuan')
                                <option value="perempuan" selected>Perempuan</option>
                            @else
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            @endif
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        {{-- <div class="form-floating">
                            <select class="form-select selectpicker" data-live-search="true" data-show-subtext="true"
                                id="kebangsaan" name="kebangsaan" aria-label="Floating label select example">
                                @foreach ($countries as $country)
                                    @if (old('kebangsaan', $country) == $user->pelamar->kebangsaan)
                                        <option value="{{ $user->pelamar->kebangsaan }}" selected>
                                            {{ $user->pelamar->kebangsaan }}
                                        </option>
                                    @else
                                        <option value="{{ $country }}">{{ $country }}</option>
                                    @endif
                                @endforeach

                            </select>
                            <label for="kebangsaan">Kewarganegaraan</label>
                        </div> --}}
                        <div class="mt-4">
                            <label for="exampleDataList" class="form-label">Kewarganegaraan</label>
                            <input class="form-control" list="datalistOptions" id="kebangsaan" name="kebangsaan"
                                placeholder="Ketika untuk cari...">
                            <datalist id="datalistOptions">
                                @foreach ($countries as $country)
                                    @if (old('kebangsaan', $country) == $user->pelamar->kebangsaan)
                                        <option value="{{ $user->pelamar->kebangsaan }}" selected>
                                            {{ $user->pelamar->kebangsaan }}
                                        </option>
                                    @else
                                        <option value="{{ $country }}">{{ $country }}</option>
                                    @endif
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        onclick="hapusData()">Batal</button>
                    <button class="btn btn-success" type="submit" id="submit-form">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>
