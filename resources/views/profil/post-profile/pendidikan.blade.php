<div class="md-12 mt-5 mb-5">
    <div class="row">
        <div class="col-8">
            <h3 class="fw-bold ">RIWAYAT PENDIDIKAN</h3>
        </div>
        @if ($pendidikanExists)
            <div class="col-4">
                <a href="/profil-kandidat/users/{{ $user->slug }}/education" class="btn bg-btn btn-success border-0"
                    data-bs-toggle="modal" data-bs-target="#pendidikan"><i class="bi bi-plus-circle-fill"></i> Tambahkan
                    pendidikan</a>
            </div>

            <!-- Modal -->
            <div class="modal fade " id="pendidikan" tabindex="-1" aria-labelledby="pendidikanLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="pendidikanLabel">Pendidikan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" id="close"
                                aria-label="Close" onclick="hapusData()"></button>
                        </div>
                        <form action="/pendidikan" method="post" id="formPendidikan" enctype="multipart/form-data">
                            <div class="modal-body">
                                <p>Beritahu kami pendidikan yang pernah Anda tempuh</p>
                                @csrf

                                <div class=" mb-4">
                                    <div class="">
                                        <label for="jenjangPendidikan">Pilih Jenjang Pendidikan</label>
                                        <select class="form-select" aria-label="Default select example"
                                            id="jenjangPendidikan" name="jenjang_pendidikan" onchange="click()"
                                            required>
                                            <option selected disabled>Pilih Jenjang Pendidikan</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="SMK">SMK</option>
                                            <option value="D3">D3</option>
                                            <option value="D4">D4</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-floating mb-4 mt-4">
                                    <input type="text" class="form-control" id="nama_institusi" name="nama_institusi"
                                        placeholder="nama_institusi" required>

                                    <label for="nama_institusi">Nama Sekolah/Institusi/Universitas</label>
                                </div>

                                <div class="form-floating mb-4 mt-4">
                                    <input type="text" class="form-control" id="jurusan" name="jurusan"
                                        placeholder="jurusan" >

                                    <label for="jurusan">Jurusan</label>
                                </div>
                                <div class="form-floating mb-4 mt-4">
                                    <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus"
                                        placeholder="tahun_lulus" required>

                                    <label for="tahun_lulus">Tahun Selesai</label>
                                </div>

                                <div class="form-floating mb-4 mt-4">
                                    <input type="text" class="form-control" id="ipk" name="ipk"
                                        placeholder="ipk">

                                    <label for="ipk">IPK (Indeks Prestasi Kumulatif)</label>
                                </div>

                                <div class="form-floating mb-4 mt-4" hidden>
                                    <input type="text" class="form-control" id="id_pelamar" name="id_pelamar"
                                        placeholder="id_pelamar" value="{{ $user->id_pelamar }}" required>

                                    <label for="id_pelamar">id_pelamar</label>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-batal" data-bs-dismiss="modal"
                                    onclick="hapusData()">Batal</button>
                                <button type="submit" class="btn btn-success btn-simpan border-0"
                                    id="submit-button-pendidikan">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <hr class="border border-secondary">
    <div class="col-md-12 mt-5 mb-5 d-flex justify-content-center">

        @if (!$pendidikanExists)
            <!-- Button trigger modal -->
            <a href="/profil-kandidat/users/{{ $user->slug }}/education" class="btn btn-success border-0"
                data-bs-toggle="modal" data-bs-target="#pendidikan"><i class="bi bi-plus-circle-fill"></i> Tambahkan
                pendidikan</a>

            <!-- Modal -->
            <div class="modal fade " id="pendidikan" tabindex="-1" aria-labelledby="pendidikanLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="pendidikanLabel">Pendidikan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" id="close"
                                aria-label="Close" onclick="hapusData()"></button>
                        </div>
                        <form action="/pendidikan" method="post" id="formPendidikan" enctype="multipart/form-data">
                            <div class="modal-body">
                                <p>Beritahu kami pendidikan yang pernah Anda tempuh</p>
                                @csrf

                                <div class="row g-3 mb-4">
                                    <div class="">
                                        <label for="jenjangPendidikan">Pilih Jenjang Pendidikan</label>
                                        <select class="form-select" aria-label="Default select example"
                                            id="jenjangPendidikan" name="jenjang_pendidikan" required>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="SMK">SMK</option>
                                            <option value="D3">D3</option>
                                            <option value="D4">D4</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-floating mb-4 mt-4 ">
                                    <input type="text" class="form-control" id="nama_institusi"
                                        name="nama_institusi" placeholder="nama_institusi" required>

                                    <label for="nama_institusi">Nama Sekolah/Institusi/Universitas</label>
                                </div>

                                <div class="form-floating mb-4 mt-4 ">
                                    <input type="text" class="form-control" id="jurusan" name="jurusan"
                                        placeholder="jurusan" >

                                    <label for="jurusan">Jurusan</label>
                                </div>

                                <div class="form-floating mb-4 mt-4 ">
                                    <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus"
                                        placeholder="tahun_lulus" required>

                                    <label for="tahun_lulus">Tahun Selesai</label>
                                </div>

                                <div class="form-floating mb-4 mt-4 ">
                                    <input type="text" class="form-control" id="ipk" name="ipk"
                                        placeholder="ipk" >

                                    <label for="ipk">IPK (Indeks Prestasi Kumulatif)</label>
                                </div>

                                <div class="form-floating mb-4 mt-4 " hidden>
                                    <input type="text" class="form-control" id="id_pelamar" name="id_pelamar"
                                        placeholder="id_pelamar" value="{{ $user->id_pelamar }}" required>

                                    <label for="id_pelamar">id_pelamar</label>
                                </div>


                                {{-- <div class="">
                                <div class="mb-3 mt-4">
                                    <label for="formFileMultiple" class="form-label">Masukkan lampiran</label>
                                    <input class="form-control" type="file" id="formFileMultiple" multiple>
                                </div>
                            </div> --}}

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-batal" data-bs-dismiss="modal"
                                    onclick="hapusData()">Batal</button>
                                <button type="submit" class="btn btn-success btn-simpan border-0"
                                    id="submit-button-pendidikan">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="container">
                @foreach ($pendidikans as $pendidikan)
                    <div class="row border-secondary border-2 rounded shadow-sm mb-2"
                        style="background-color: #f2f1f1">
                        <div class="col-8 mt-2">

                            <p class="fw-bold">{{ $pendidikan->nama_institusi }}</p>
                            <p>{{ $pendidikan->jenjang_pendidikan }}</p>
                            <p>{{ $pendidikan->jurusan }}</p>
                            <p>{{ $pendidikan->tahun_lulus }}</p>
                            {{-- <p>IPK: {{ $pendidikan->ipk }}</p> --}}

                        </div>
                        <div class="col-4 mt-2">
                            <div>
                                <a href="/pendidikan/{{ $pendidikan->id }}/edit"
                                    class="btn btn-warning border-0 mt-5 mb-5" data-bs-toggle="modal"
                                    data-bs-target="#pendidikan-{{ $pendidikan->id_pendidikan }}"><i
                                        class="bi bi-pencil-fill"></i>
                                    Edit</a>

                                <a href="/pendidikan/{{ $pendidikan->id }}" class="btn btn-danger border-0 mt-5 mb-5"
                                    data-bs-toggle="modal"
                                    data-bs-target="#hapusPendidikan{{ $pendidikan->id_pendidikan }}"><i
                                        class="bi bi-trash3-fill"></i>
                                    Hapus</a>
                            </div>
                            <div class="modal fade " id="pendidikan-{{ $pendidikan->id_pendidikan }}" tabindex="-1"
                                aria-labelledby="pendidikanLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content ">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="pendidikanLabel">Pendidikan</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                id="close" aria-label="Close" onclick="hapusData()"></button>
                                        </div>
                                        <form action="/pendidikan/{{ $pendidikan->id_pendidikan }}" method="POST"
                                            id="formPendidikan" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <p>Beritahu kami pendidikan yang pernah Anda tempuh</p>

                                                <div class="row g-3 mb-4">
                                                    <div class="">
                                                        <label for="jenjangPendidikan">Pilih Jenjang Pendidikan</label>
                                                        <select class="form-select"
                                                            aria-label="Default select example" id="jenjangPendidikan"
                                                            name="jenjang_pendidikan" required>
                                                            @if (old('jenjang_pendidikan', $pendidikan->jenjang_pendidikan) == 'SD')
                                                                <option value="SD" selected>SD (Sekolah Dasar)
                                                                </option>
                                                                <option value="SMP">SMP (Sekolah Menengah Pertama)
                                                                </option>
                                                                <option value="SMA">SMA (Sekolah Menengah Atas)
                                                                </option>
                                                                <option value="SMK">SMK (Sekolah Menengah Kejuruan)
                                                                </option>
                                                                <option value="D3">D3
                                                                </option>
                                                                <option value="D4">D4
                                                                </option>
                                                                <option value="S1">S1
                                                                </option>
                                                                <option value="S2">S2
                                                                </option>
                                                                <option value="S3">S3
                                                                </option>
                                                            @elseif (old('jenjang_pendidikan', $pendidikan->jenjang_pendidikan) == 'SMP')
                                                                <option value="SD">SD (Sekolah Dasar)
                                                                </option>
                                                                <option value="SMP" selected>SMP (Sekolah Menengah
                                                                    Pertama)
                                                                </option>
                                                                <option value="SMA">SMA (Sekolah Menengah Atas)
                                                                </option>
                                                                <option value="SMK">SMK (Sekolah Menengah Kejuruan)
                                                                </option>
                                                                <option value="D3">D3
                                                                </option>
                                                                <option value="D4">D4
                                                                </option>
                                                                <option value="S1">S1
                                                                </option>
                                                                <option value="S2">S2
                                                                </option>
                                                                <option value="S3">S3
                                                                </option>
                                                            @elseif (old('jenjang_pendidikan', $pendidikan->jenjang_pendidikan) == 'SMA')
                                                                <option value="SD">SD (Sekolah Dasar)
                                                                </option>
                                                                <option value="SMP">SMP (Sekolah Menengah Pertama)
                                                                </option>
                                                                <option value="SMA" selected>SMA (Sekolah Menengah
                                                                    Atas)
                                                                </option>
                                                                <option value="SMK">SMK (Sekolah Menengah Kejuruan)
                                                                </option>
                                                                <option value="D3">D3</option>
                                                                <option value="D4">D4
                                                                </option>
                                                                <option value="S1">S1
                                                                </option>
                                                                <option value="S2">S2
                                                                </option>
                                                                <option value="S3">S3
                                                                </option>
                                                            @elseif (old('jenjang_pendidikan', $pendidikan->jenjang_pendidikan) == 'SMK')
                                                                <option value="SD">SD (Sekolah Dasar)
                                                                </option>
                                                                <option value="SMP">SMP (Sekolah Menengah Pertama)
                                                                </option>
                                                                <option value="SMA">SMA (Sekola Menengah Atas)
                                                                </option>
                                                                <option value="SMK" selected>SMK (Sekolah Menengah
                                                                    Kejuruan)
                                                                </option>
                                                                <option value="D3">D3
                                                                </option>
                                                                <option value="D4">D4
                                                                </option>
                                                                <option value="S1">S1
                                                                </option>
                                                                <option value="S2">S2
                                                                </option>
                                                                <option value="S3">S3
                                                                </option>
                                                            @elseif (old('jenjang_pendidikan', $pendidikan->jenjang_pendidikan) == 'D3')
                                                                <option value="SD">SD (Sekolah Dasar)
                                                                </option>
                                                                <option value="SMP">SMP (Sekolah Menengah Pertama)
                                                                </option>
                                                                <option value="SMA">SMA (Sekola Menengah Atas)
                                                                </option>
                                                                <option value="SMK">SMK (Sekolah Menengah Kejuruan)
                                                                </option>
                                                                <option value="D3" selected>D3
                                                                </option>
                                                                <option value="D4">D4
                                                                </option>
                                                                <option value="S1">S1
                                                                </option>
                                                                <option value="S2">S2
                                                                </option>
                                                                <option value="S3">S3
                                                                </option>
                                                            @elseif (old('jenjang_pendidikan', $pendidikan->jenjang_pendidikan) == 'D4')
                                                                <option value="SD">SD (Sekolah Dasar)
                                                                </option>
                                                                <option value="SMP">SMP (Sekolah Menengah Pertama)
                                                                </option>
                                                                <option value="SMA">SMA (Sekola Menengah Atas)
                                                                </option>
                                                                <option value="SMK">SMK (Sekolah Menengah Kejuruan)
                                                                </option>
                                                                <option value="D3">D3
                                                                </option>
                                                                <option value="D4" selected>D4
                                                                </option>
                                                                <option value="S1">S1
                                                                </option>
                                                                <option value="S2">S2
                                                                </option>
                                                                <option value="S3">S3
                                                                </option>
                                                            @elseif (old('jenjang_pendidikan', $pendidikan->jenjang_pendidikan) == 'S1')
                                                                <option value="SD">SD (Sekolah Dasar)
                                                                </option>
                                                                <option value="SMP">SMP (Sekolah Menengah Pertama)
                                                                </option>
                                                                <option value="SMA">SMA (Sekola Menengah Atas)
                                                                </option>
                                                                <option value="SMK">SMK (Sekolah Menengah Kejuruan)
                                                                </option>
                                                                <option value="D3">D3
                                                                </option>
                                                                <option value="D4">D4
                                                                </option>
                                                                <option value="S1" selected>S1
                                                                </option>
                                                                <option value="S2">S2
                                                                </option>
                                                                <option value="S3">S3
                                                                </option>
                                                            @elseif (old('jenjang_pendidikan', $pendidikan->jenjang_pendidikan) == 'S2')
                                                                <option value="SD">SD (Sekolah Dasar)
                                                                </option>
                                                                <option value="SMP">SMP (Sekolah Menengah Pertama)
                                                                </option>
                                                                <option value="SMA">SMA (Sekola Menengah Atas)
                                                                </option>
                                                                <option value="SMK">SMK (Sekolah Menengah Kejuruan)
                                                                </option>
                                                                <option value="D3">D3
                                                                </option>
                                                                <option value="D4">D4
                                                                </option>
                                                                <option value="S1">S1
                                                                </option>
                                                                <option value="S2" selected>S2
                                                                </option>
                                                                <option value="S3">S3
                                                                </option>
                                                            @elseif (old('jenjang_pendidikan', $pendidikan->jenjang_pendidikan) == 'S3')
                                                                <option value="SD">SD (Sekolah Dasar)
                                                                </option>
                                                                <option value="SMP">SMP (Sekolah Menengah Pertama)
                                                                </option>
                                                                <option value="SMA">SMA (Sekola Menengah Atas)
                                                                </option>
                                                                <option value="SMK">SMK (Sekolah Menengah Kejuruan)
                                                                </option>
                                                                <option value="D3">D3
                                                                </option>
                                                                <option value="D4">D4
                                                                </option>
                                                                <option value="S1">S1
                                                                </option>
                                                                <option value="S2">S2
                                                                </option>
                                                                <option value="S3" selected>S3
                                                                </option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-floating mb-4 mt-4 ">
                                                    <input type="text" class="form-control" id="nama_institusi"
                                                        name="nama_institusi" placeholder="nama_institusi"
                                                        value="{{ old('nama_institusi', $pendidikan->nama_institusi) }}"
                                                        required>

                                                    <label for="nama_institusi">Nama
                                                        Sekolah/Institusi/Universitas</label>
                                                </div>

                                                <div class="form-floating mb-4 mt-4 ">
                                                    <input type="text" class="form-control" id="jurusan"
                                                        name="jurusan" placeholder="jurusan"
                                                        value="{{ old('jurusan', $pendidikan->jurusan) }}" >

                                                    <label for="jurusan">Jurusan</label>
                                                </div>

                                                <div class="form-floating mb-4 mt-4 ">
                                                    <input type="text" class="form-control" id="tahun_selesai"
                                                        name="tahun_lulus" placeholder="tahun_selesai"
                                                        value="{{ old('tahun_selesai', $pendidikan->tahun_lulus) }}"
                                                        required>

                                                    <label for="tahun_selesai">Tahun Selesai</label>
                                                </div>

                                                <div class="form-floating mb-4 mt-4 ">
                                                    <input type="text" class="form-control" id="ipk"
                                                        name="ipk" placeholder="ipk"
                                                        value="{{ old('ipk', $pendidikan->ipk) }}" >

                                                    <label for="ipk">IPK (Indeks Prestasi Kumulatif)</label>
                                                </div>

                                                <div class="form-floating mb-4 mt-4 " hidden>
                                                    <input type="text" class="form-control" id="id_pelamar"
                                                        name="id_pelamar" placeholder="id_pelamar"
                                                        value="{{ $user->id_pelamar }}" required>

                                                    <label for="id_pelamar">id_pelamar</label>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger btn-batal"
                                                    data-bs-dismiss="modal" onclick="hapusData()">Batal</button>
                                                <button type="submit" class="btn btn-success btn-edit border-0"
                                                    id="submit-button-edit-pendidikan-{{ $pendidikan->id_pendidikan }}"
                                                    value="{{ $pendidikan->id_pendidikan }}"
                                                    onclick="getID({{ $pendidikan->id_pendidikan }});">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="hapusPendidikan{{ $pendidikan->id_pendidikan }}"
                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <form action="/pendidikan/{{ $pendidikan->id_pendidikan }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-success btn-delete"
                                                    id="submit-button-delete-pendidikan-{{ $pendidikan->id_pendidikan }}"
                                                    value="{{ $pendidikan->id_pendidikan }}"
                                                    onclick="getID({{ $pendidikan->id_pendidikan }});">Hapus</button>
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
