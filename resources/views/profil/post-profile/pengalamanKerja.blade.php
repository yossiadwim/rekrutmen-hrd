<div id="loader" class="loader-wrapper" style="display: none;">
    <div class="loader"></div>
    <div class="mx-2 fw-bold text-light">Loading...</div>
</div>


<div class="md-12">
    <div class="row">
        <div class="col-8">
            <h3 class="fw-bold ">PENGALAMAN KERJA</h3>
        </div>
        @if ($pengalamanKerjaExists)
            <div class="col-4 text-align-right">
                <a href="/profil-kandidat/users/{{ $user->slug }}/work-experience"
                    class="btn btn-success bg-btn border-0" data-bs-toggle="modal" data-bs-target="#pengalamanKerja"><i
                        class="bi bi-plus-circle-fill"></i>
                    Tambahkan pengalaman kerja</a>
            </div>
            <div class="modal fade " id="pengalamanKerja" tabindex="-1" aria-labelledby="pengalamanKerjaLabel"
                aria-hidden="true">
                <div class="modal-dialog  ">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="pengalamanKerjaLabel">Pengalaman Kerja</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" ID="close"
                                aria-label="Close" onclick="hapusData()"></button>
                        </div>
                        <form method="post" action="/pengalamanKerja" id="formPengalamanKerja">
                            @csrf
                            <div class="modal-body">
                                <p>Tambahkan pengalaman kerja yang Anda miliki</p>

                                <div class="mb-3" hidden>
                                    <input type="text" class="form-control mb-4" name="id_pelamar" id="id_pelamar"
                                        value="">
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control mb-4" name="nama_perusahaan"
                                        id="namaPerusahaan" placeholder="Nama perusahaan" required>
                                    <label for="namaPerusahaan">Nama perusahaan</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control mb-4" name="email_instansi"
                                        id="email_instansi" placeholder="Email Instansi" required>
                                    <label for="email_instansi">Email Instansi</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control mb-4" name="posisi" id="posisi"
                                        placeholder="Posisi / jabatan" required>
                                    <label for="posisijabatan">Posisi / Jabatan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control mb-4" name="telepon" id="telepon"
                                        placeholder="telepon" maxlength="12" required>
                                    <label for="telepon">No Telepon</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control mb-4" name="periode" id="periode"
                                        placeholder="periode" required>
                                    <label for="periode">Periode. Contoh: 2020 - 2021</label>
                                </div>

                                {{-- <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" value="false" id="konfirmasi"
                                        name="masih_bekerja">
                                    <label class="form-check-label" for="konfirmasi">
                                        Saya masih bekerja di perusahaan ini
                                    </label>
                                </div> --}}

                                <div class="form-floating">
                                    <input type="text" class="form-control mb-4" name="gaji" id="gaji"
                                        placeholder="Gaji" oninput="formatCurrency(this)" required>
                                    <label for="gaji">Gaji</label>

                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="alasan_mengundurkan_diri"
                                        style="height: 200px" required></textarea>
                                    <label for="floatingTextarea2">Alasan mengundurkan diri</label>
                                </div>
                                <div class="form-floating" hidden>
                                    <input type="text" class="form-control mb-4" name="id_pelamar" id="id_pelamar"
                                        placeholder="id_pelamar" value="{{ $user->pelamar->id }}">
                                    <label for="id_pelamar">id_pelamar</label>

                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                    onclick="hapusData()">Batal</button>
                                <button type="submit" class="btn btn-success btn-simpan border-0"
                                    id="submit-button-pengalaman-kerja">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <hr class="border border-secondary">
    <div class="col-md-12 mt-5 mb-1 d-flex justify-content-center">

        @if (!$pengalamanKerjaExists)
            <a href="/profil-kandidat/users/{{ $user->slug }}/work-experience"
                class="btn btn-success border-0 mt-5 mb-5" data-bs-toggle="modal"
                data-bs-target="#pengalamanKerja"><i class="bi bi-plus-circle-fill"></i>
                Tambahkan pengalaman kerja</a>

            <!-- Modal -->
            <div class="modal fade " id="pengalamanKerja" tabindex="-1" aria-labelledby="pengalamanKerjaLabel"
                aria-hidden="true">
                <div class="modal-dialog  ">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="pengalamanKerjaLabel">Pengalaman Kerja</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" ID="close"
                                aria-label="Close" onclick="hapusData()"></button>
                        </div>
                        <form method="post" action="/pengalamanKerja" id="formPengalamanKerja">
                            @csrf
                            <div class="modal-body">
                                <p>Tambahkan pengalaman kerja yang Anda miliki</p>

                                <div class="mb-3" hidden>
                                    <input type="text" class="form-control mb-4" name="id_pelamar"
                                        id="id_pelamar" value="">
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control mb-4" name="nama_perusahaan"
                                        id="namaPerusahaan" placeholder="Nama perusahaan" required>
                                    <label for="namaPerusahaan">Nama perusahaan</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control mb-4" name="email_instansi"
                                        id="email_instansi" placeholder="Nama perusahaan" required>
                                    <label for="email_instansi">Email Instansi</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control mb-4" name="telepon" id="telepon"
                                        placeholder="telepon" maxlength="12" required>
                                    <label for="telepon">No Telepon</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control mb-4" name="posisi"
                                        id="posisijabatan" placeholder="Posisi / jabatan" required>
                                    <label for="posisijabatan">Posisi / Jabatan</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control mb-4" name="periode" id="periode"
                                        placeholder="periode" required>
                                    <label for="periode">Periode. Contoh: 2020 - 2021</label>
                                </div>
                                {{-- 
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" value="false" id="konfirmasi"
                                        name="masih_bekerja">
                                    <label class="form-check-label" for="konfirmasi">
                                        Saya masih bekerja di perusahaan ini
                                    </label>
                                </div> --}}

                                <div class="form-floating">
                                    <input type="text" class="form-control mb-4" name="gaji" id="gaji"
                                        placeholder="Gaji" oninput="formatCurrency(this)" required>
                                    <label for="gaji">Gaji</label>

                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        name="alasan_mengundurkan_diri" style="height: 200px" required></textarea>
                                    <label for="floatingTextarea2">Alasan mengundurkan diri</label>
                                </div>
                                <div class="form-floating" hidden>
                                    <input type="text" class="form-control mb-4" name="id_pelamar"
                                        id="id_pelamar" placeholder="id_pelamar" value="{{ $user->pelamar->id }}"
                                        required>
                                    <label for="id_pelamar">id_pelamar</label>

                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                    onclick="hapusData()">Batal</button>
                                <button type="submit" class="btn btn-success btn-simpan border-0"
                                    id="submit-button-pengalaman-kerja">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div id="loader" class="loader-wrapper" style="display: none;">
                <div class="loader"></div>
                <div class="mx-2 fw-bold text-light">Loading...</div>
            </div>

            <div class="container">
                @foreach ($pengalamanKerja as $pk)
                    <div class="row border-secondary border-2 rounded shadow-sm mb-2"
                        style="background-color: #f2f1f1">
                        <div class="col-8 mt-2">
                            <p class="fs-4 fw-bold">{{ $pk->nama_perusahaan }}</p>
                            <p>{{ $pk->posisi }}</p>
                            <p>{{ $pk->periode }}</p>
                        </div>
                        <div class="col-4">
                            <div>
                                <a href="/pengalamanKerja/{{ $pk->id }}/edit"
                                    class="btn btn-warning border-0 mt-5 mb-5" data-bs-toggle="modal"
                                    data-bs-target="#pengalamanKerja-{{ $pk->id }}"><i
                                        class="bi bi-pencil-fill"></i>
                                    Edit</a>

                                <a href="/pengalamanKerja/{{ $pk->id }}"
                                    class="btn btn-danger border-0 mt-5 mb-5" data-bs-toggle="modal"
                                    data-bs-target="#hapusPengalamanKerja{{ $pk->id }}"><i
                                        class="bi bi-trash3-fill"></i>
                                    Hapus</a>
                            </div>
                            <div class="modal fade " id="pengalamanKerja-{{ $pk->id }}" tabindex="-1"
                                aria-labelledby="pengalamanKerjaLabel" aria-hidden="true">
                                <div class="modal-dialog  ">
                                    <div class="modal-content ">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="pengalamanKerjaLabel">Pengalaman Kerja
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                ID="close" aria-label="Close" onclick="hapusData()"></button>
                                        </div>
                                        <form method="post" action="/pengalamanKerja/{{ $pk->id }}"
                                            id="formEditPengalamanKerja">
                                            @method('put')
                                            @csrf
                                            <div class="modal-body">
                                                <p>Tambahkan pengalaman kerja yang Anda miliki</p>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control mb-4"
                                                        name="nama_perusahaan" id="namaPerusahaan"
                                                        placeholder="Nama perusahaan"
                                                        value="{{ $pk->nama_perusahaan }}" required>
                                                    <label for="namaPerusahaan">Nama perusahaan</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="email" class="form-control mb-4"
                                                        name="email_instansi" id="email_instansi"
                                                        placeholder="Nama perusahaan"
                                                        value="{{ $pk->email_instansi }}" required>
                                                    <label for="email_instansi">Email Instansi</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control mb-4" name="posisi"
                                                        id="posisijabatan" placeholder="Posisi / jabatan"
                                                        value="{{ $pk->posisi }}"required>
                                                    <label for="posisijabatan">Posisi / Jabatan</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control mb-4" name="periode"
                                                        id="periode" placeholder="periode"
                                                        value="{{ $pk->periode }}"required>
                                                    <label for="periode">Periode. Contoh: 2020 - 2021</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control mb-4" name="telepon"
                                                        id="telepon" placeholder="telepon"
                                                        value="{{ $pk->telepon }}" maxlength="12"required>
                                                    <label for="telepon">No Telepon</label>
                                                </div>
                                                {{-- 
                                                <div class="form-check mb-4">
                                                    <input class="form-check-input" type="checkbox" value="false"
                                                        id="konfirmasi" name="masih_bekerja">
                                                    <label class="form-check-label" for="konfirmasi">
                                                        Saya masih bekerja di perusahaan ini
                                                    </label>
                                                </div> --}}

                                                <div class="form-floating">
                                                    <input type="text" class="form-control mb-4" name="gaji"
                                                        id="gaji" placeholder="Gaji" value="@currency($pk->gaji)"
                                                        oninput="formatCurrency(this)">
                                                    <label for="gaji">Gaji</label>

                                                </div>
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                                        name="alasan_mengundurkan_diri" style="height: 200px"required>{{ $pk->alasan_mengundurkan_diri }}</textarea>
                                                    <label for="floatingTextarea2">Alasan mengundurkan diri</label>
                                                </div>
                                                <div class="form-floating" hidden>
                                                    <input type="text" class="form-control mb-4" name="id_pelamar"
                                                        id="id_pelamar" placeholder="id_pelamar"
                                                        value="{{ $user->pelamar->id }}">
                                                    <label for="id_pelamar">id_pelamar</label>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                                    onclick="hapusData()">Batal</button>
                                                <button type="submit" class="btn btn-success btn-edit border-0"
                                                    id="submit-button-edit-pengalaman-kerja-{{ $pk->id }}"
                                                    value="{{ $pk->id }}"
                                                    onclick="getID({{ $pk->id }});">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="hapusPengalamanKerja{{ $pk->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Informasi ini akan dihapus. Yakin ingin menghapusnya?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Batal</button>
                                            <form action="/pengalamanKerja/{{ $pk->id }}" method="post"
                                                id="formPengalamanKerja">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-success btn-delete"
                                                    id="submit-button-delete-pengalaman-kerja-{{ $pk->id }}"
                                                    value="{{ $pk->id }}"
                                                    onclick="getID({{ $pk->id }});">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div id="loader" class="loader-wrapper" style="display: none;">
    <div class="loader"></div>
    <div class="mx-2 fw-bold text-light">Loading...</div>
</div>
