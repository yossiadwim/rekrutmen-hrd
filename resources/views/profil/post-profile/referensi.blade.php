<div class="md-12 mt-5">
    <div class="row">
        <div class="col-8">
            <h3 class="fw-bold ">REFERENSI</h3>
        </div>
        @if ($referensiExists)
            <div class="col-4">
                <a href="/profil-kandidat/users/{{ $user->uuid }}/reference" class="btn bg-btn btn-success border-0"
                    data-bs-toggle="modal" data-bs-target="#referensi"><i class="bi bi-plus-circle-fill"></i> Tambahkan
                    Referensi</a>
            </div>

            <!-- Modal -->
            <div class="modal fade " id="referensi" tabindex="-1" aria-labelledby="refeensiLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="pendidikanLabel">Referensi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" id="close"
                                aria-label="Close" onclick="hapusData()"></button>
                        </div>
                        <form action="/referensi" method="post" id="formPendidikan" enctype="multipart/form-data">
                            <div class="modal-body">
                                <p>Tambahkan referensi Anda dalam mendaftar</p>
                                @csrf

                                <div class="form-floating mb-4 mt-4">
                                    <input type="text" class="form-control" id="nama_referensi" name="nama_referensi"
                                        placeholder="nama" required>

                                    <label for="nama">Nama</label>
                                </div>

                                <div class="form-floating mb-4 mt-4">
                                    <input type="text" class="form-control" id="alamat_referensi"
                                        name="alamat_referensi" placeholder="alamat" required>

                                    <label for="alamat">Alamat</label>
                                </div>
                                <div class="form-floating mb-4 mt-4">
                                    <input type="text" class="form-control" id="telepon_referensi"
                                        name="telepon_referensi" placeholder="telepon" required maxlength="12">

                                    <label for="telepon">Telepon</label>
                                </div>
                                <div class="form-floating mb-4 mt-4">
                                    <input type="email" class="form-control" id="email_referensi"
                                        name="email_referensi" placeholder="email" required>

                                    <label for="email">Email</label>
                                </div>

                                <div class="form-floating mb-4 mt-4">
                                    <input type="text" class="form-control" id="hubungan_referensi"
                                        name="hubungan_referensi" placeholder="hubungan" required>

                                    <label for="hubungan">Hubungan</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="button-check-reference">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Apakah dari SATUNAMA?
                                    </label>
                                </div>

                                <div class="form-floating mb-4 mt-4 col-12" id="div-posisi" hidden>
                                    <input type="text" class="form-control" id="posisi_referensi"
                                        name="posisi_referensi" placeholder="posisi">

                                    <label for="posisi">Posisi</label>
                                </div>

                                <div class="form-floating mb-4 mt-4" hidden>
                                    <input type="text" class="form-control" id="id_pelamar" name="id_pelamar"
                                        placeholder="id_pelamar" value="{{ $user->id_pelamar }}">

                                    <label for="id_pelamar">id_pelamar</label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-batal" data-bs-dismiss="modal"
                                        onclick="hapusData()">Batal</button>
                                    <button type="submit" class="btn btn-success btn-simpan border-0"
                                        id="submit-button-referensi">Simpan</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <hr class="border border-secondary">
    <div class="col-md-12 mt-5 mb-5 d-flex justify-content-center">
        @if (!$referensiExists)
            <!-- Button trigger modal -->
            <a href="/profil-kandidat/users/{{ $user->uuid }}/reference" class="btn btn-success border-0"
                data-bs-toggle="modal" data-bs-target="#reference"><i class="bi bi-plus-circle-fill"></i> Tambahkan
                Referensi</a>

            <!-- Modal -->
            <div class="modal fade " id="reference" tabindex="-1" aria-labelledby="refernceLabel"
                aria-hidden="true">
                <div class="modal-dialog  modal-md">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="referenceLabel">Referensi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" id="close"
                                aria-label="Close" onclick="hapusData()"></button>
                        </div>
                        <form action="/referensi" method="post" id="formPendidikan" enctype="multipart/form-data">
                            <div class="modal-body">
                                <p>Tambahkan referensi yang Anda gunakan dalam melamar</p>
                                @csrf

                                <div class="form-floating mb-4 mt-4 col-12">
                                    <input type="text" class="form-control" id="nama_referensi"
                                        name="nama_referensi" placeholder="nama" required>

                                    <label for="nama">Nama</label>
                                </div>

                                <div class="form-floating mb-4 mt-4 col-12">
                                    <input type="text" class="form-control" id="alamat_referensi"
                                        name="alamat_referensi" placeholder="alamat" required>

                                    <label for="alamat">Alamat</label>
                                </div>
                                <div class="form-floating mb-4 mt-4 col-12">
                                    <input type="text" class="form-control" id="telepon_referensi"
                                        name="telepon_referensi" placeholder="telepon" required maxlength="12">

                                    <label for="telepon">Telepon</label>
                                </div>
                                <div class="form-floating mb-4 mt-4 col-12">
                                    <input type="email" class="form-control" id="email_referensi"
                                        name="email_referensi" placeholder="email" required>

                                    <label for="email">Email</label>
                                </div>

                                <div class="form-floating mb-4 mt-4 col-12">
                                    <input type="text" class="form-control" id="hubungan_referensi"
                                        name="hubungan_referensi" placeholder="hubungan" required>

                                    <label for="hubungan">Hubungan</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="button-check-reference">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Apakah dari SATUNAMA?
                                    </label>
                                </div>

                                <div class="form-floating mb-4 mt-4 col-12" id="div-posisi" hidden>
                                    <input type="text" class="form-control" id="posisi_referensi"
                                        name="posisi_referensi" placeholder="posisi">

                                    <label for="posisi">Posisi</label>
                                </div>

                                <div class="form-floating mb-4 mt-4 col-6" hidden>
                                    <input type="text" class="form-control" id="id_pelamar" name="id_pelamar"
                                        placeholder="id_pelamar" value="{{ $user->id_pelamar }}">

                                    <label for="id_pelamar">id_pelamar</label>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-batal" data-bs-dismiss="modal"
                                    onclick="hapusData()">Batal</button>
                                <button type="submit" class="btn btn-success btn-simpan border-0" id="submit-button-referensi">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                @foreach ($referensis as $referensi)
                    <div class="row rounded shadow-sm mb-3" style="background-color: #f2f1f1">
                        <div class="col-8">
                            <p>Nama: {{ $referensi->nama_referensi }}</p>
                            <p>Alamat: {{ $referensi->alamat_referensi }}</p>
                            <p>Telepon: {{ $referensi->telepon_referensi }}</p>
                            <p>Email: {{ $referensi->email_referensi }}</p>
                            <p>Hubungan: {{ $referensi->hubungan_referensi }}</p>
                            <p>Posisi: {{ $referensi->posisi_referensi == null ? '-' : $referensi->posisi_referensi }}
                            </p>
                        </div>
                        <div class="col-4">
                            <div>
                                <a href="/referensi/{{ $referensi->id_referensi }}/edit"
                                    class="btn btn-warning border-0 mt-5 mb-5" data-bs-toggle="modal"
                                    data-bs-target="#referensi-{{ $referensi->id_referensi }}"><i
                                        class="bi bi-pencil-fill"></i>
                                    Edit</a>

                                <a href="/referensi/{{ $referensi->id_referensi }}"
                                    class="btn btn-danger border-0 mt-5 mb-5" data-bs-toggle="modal"
                                    data-bs-target="#hapusReferensi{{ $referensi->id_referensi }}"><i
                                        class="bi bi-trash3-fill"></i>
                                    Hapus</a>
                            </div>
                            <div class="modal fade " id="referensi-{{ $referensi->id_referensi }}" tabindex="-1"
                                aria-labelledby="referensiLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-md">
                                    <div class="modal-content ">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="referensiLabel">Referensi</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                id="close" aria-label="Close" onclick="hapusData()"></button>
                                        </div>
                                        <form action="/referensi/{{ $referensi->id_referensi }}" method="POST"
                                            id="formReferensi" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <p>Tambahkan referensi yang Anda gunakan dalam melamar</p>
                                                <div class="form-floating mb-4 mt-4 col-12">
                                                    <input type="text" class="form-control" id="nama_referensi"
                                                        name="nama_referensi" placeholder="nama"
                                                        value="{{ old('nama', $referensi->nama_referensi) }}"
                                                        required>

                                                    <label for="nama">Nama</label>
                                                </div>

                                                <div class="form-floating mb-4 mt-4 col-12">
                                                    <input type="text" class="form-control" id="alamat_referensi"
                                                        name="alamat_referensi" placeholder="alamat"
                                                        value="{{ old('alamat_referensi', $referensi->alamat_referensi) }}"
                                                        required>

                                                    <label for="alamat">Alamat</label>
                                                </div>
                                                <div class="form-floating mb-4 mt-4 col-12">
                                                    <input type="text" class="form-control" id="telepon_referensi"
                                                        name="telepon_referensi" placeholder="telepon"
                                                        value="{{ old('telepon_referensi', $referensi->telepon_referensi) }}"required
                                                        maxlength="12">

                                                    <label for="telepon">Telepon</label>
                                                </div>
                                                <div class="form-floating mb-4 mt-4 col-12">
                                                    <input type="email" class="form-control" id="email_referensi"
                                                        name="email_referensi" placeholder="email"
                                                        value="{{ old('email_referensi', $referensi->email_referensi) }}"
                                                        required>

                                                    <label for="email">Email</label>
                                                </div>

                                                <div class="form-floating mb-4 mt-4 col-12">
                                                    <input type="text" class="form-control"
                                                        id="hubungan_referensi" name="hubungan_referensi"
                                                        placeholder="hubungan"
                                                        value="{{ old('hubungan_referensi', $referensi->hubungan_referensi) }}"required>

                                                    <label for="hubungan">Hubungan</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="button-check-reference">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Apakah dari SATUNAMA?
                                                    </label>
                                                </div>

                                                <div class="form-floating mb-4 mt-4 col-12" id="div-posisi-edit" hidden>
                                                    <input type="text" class="form-control" id="posisi_referensi"
                                                        name="posisi_referensi" placeholder="posisi"
                                                        value="{{ old('posisi_referensi', $referensi->posisi_referensi) }}">

                                                    <label for="posisi">Posisi</label>
                                                </div>

                                                <div class="form-floating mb-4 mt-4 col-6" hidden>
                                                    <input type="text" class="form-control" id="id_pelamar"
                                                        name="id_pelamar" placeholder="id_pelamar"
                                                        value="{{ $user->id_pelamar }}">

                                                    <label for="id_pelamar">id_pelamar</label>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger btn-batal"
                                                    data-bs-dismiss="modal" onclick="hapusData()">Batal</button>
                                                <button type="submit" class="btn btn-success btn-edit border-0"
                                                    id="submit-button-edit-referensi-{{ $referensi->id_referensi }}"
                                                    value="{{ $referensi->id_referensi }}"
                                                    onclick="getID({{ $referensi->id_referensi }});">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="hapusReferensi{{ $referensi->id_referensi }}" tabindex="-1"
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
                                                data-bs-dismiss="modal">Close</button>
                                            <form action="/referensi/{{ $referensi->id_referensi }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-success btn-delete"
                                                    id="submit-button-delete-referensi-{{ $referensi->id_referensi }}"
                                                    value="{{ $referensi->id_referensi }}"
                                                    onclick="getID({{ $referensi->id_referensi }});">Hapus</button>
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