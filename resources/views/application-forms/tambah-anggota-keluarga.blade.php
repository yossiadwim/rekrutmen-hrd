{{-- <!-- Button trigger modal -->
<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal_tambah_anggota_keluarga"
    style="background-color: #F25700; color: #ffffff"><i class="fa-solid fa-plus" style="color: #ffffff;"></i>
    Tambah Informasi Anggota Keluarga
</button>

<!-- Modal -->
<div class="modal fade" id="modal_tambah_anggota_keluarga" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Anggota Keluarga</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <select class="form-select" id="hubungan" name="hubungan"
                        aria-label="Floating label select example">
                        <option value="" selected disabled>Pilih</option>
                        <option value="Ayah">Ayah</option>
                        <option value="Ibu">Ibu</option>
                        <option value="Family">Family1</option>
                        <option value="Family">Family2</option>
                        <option value="Family">Family3</option>
                        <option value="Family">Family4</option>
                        <option value="Family">Family5</option>

                    </select>
                    <label for="floatingSelect">Hubungan</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                    <label for="nama">Nama</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin1"
                        aria-label="Floating label select example">
                        <option value="" selected disabled>Pilih</option>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>

                    </select>
                    <label for="floatingSelect">Jenis Kelamin</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="umur" name="umur1" placeholder="Umur">
                    <label for="umur">Umur</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" aria-label="Default select example" id="jenjangPendidikan"
                        name="jenjang_pendidikan" onchange="click()">
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
                    <label for="floatingSelect">Pendidikan Terakhir</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan">
                    <label for="pekerjaan">Pekerjaan</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="perusahaan" name="perusahaan"
                        placeholder="perusahaan">
                    <label for="Perusahaan">Perusahaan/Instansi</label>
                </div>
                <hr class="border border-dark border-2 opcacity-50">
                <button type="button" id="button_tambah_anggota" onclick="addFormAnggota()" class="btn btn-primary"><i
                        class="fa-solid fa-plus" style="color: #ffffff;"></i>
                    Tambah</button>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div> --}}

{{-- @csrf --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SATUNAMA | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/main-style.css">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/application_form.js') }}"></script>
</head>

<body style="font-family: Poppins;">

    @auth
    
        @include('partials.navbar')

        @include('partials.notification_pelamar')

        <div class="container mt-5 mb-3">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h3 class="fw-bold">Application Form - Data Keluarga</h3>
        </div>

        <div class="container mt-5 mb-5">
            <form action="/{{ $lowongan->slug }}/application-form/data-keluarga" method="POST">
                @csrf
                <table class="table" id="tableFamily">
                    <caption>Catatan: Tidak termasuk yang bersangkutan</caption>
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Hubungan</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col-1">Umur</th>
                            <th scope="col-1">Pendidikan Terakhir</th>
                            <th scope="col">Posisi</th>
                            <th scope="col">Perusahaan</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="table-body-family">
                        <td>
                            <select class="form-select" id="hubungan" name="hubungan_keluarga[]"
                                aria-label="Floating label select example">
                                <option value="" selected disabled>Pilih</option>
                                <option value="ayah">Ayah</option>
                                <option value="ibu">Ibu</option>
                                <option value="kakak">Kakak</option>
                                <option value="adik">Adik</option>
                                <option value="paman">Paman</option>
                                <option value="bibi">Bibi</option>
                                <option value="kakek">Kakek</option>
                                <option value="nenek">Nenek</option>
                            </select>
                            @error('nama_lowongan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </td>

                        <td>

                            <input type="text" class="form-control" id="nama" name="nama_anggota_keluarga[]">
                        </td>

                        <td>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin_anggota_keluarga[]"
                                aria-label="Floating label select example">
                                <option value="" selected disabled>Pilih</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>

                            </select>
                        </td>

                        <td>
                            <input type="text" class="form-control" id="umur" name="umur_anggota_keluarga[]"
                                min="0">
                        </td>

                        <td>

                            <select class="form-select" aria-label="Default select example" id="jenjangPendidikan"
                                name="jenjang_pendidikan_anggota_keluarga[]">
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

                        </td>

                        <td>

                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan_anggota_keluarga[]">

                        </td>

                        <td>

                            <input type="text" class="form-control" id="perusahaan" name="perusahaan_tempat_bekerja[]">


                        </td>

                        <td> <button type="button" class="btn btn-danger" id="remove-family-row"></i> Hapus</button>
                        </td>
                    </tbody>

                </table>

                <input type="number" name="counter_row_keluarga" id="counter_row_keluarga" style="display: none" value="1">

                <div class="col-3 mt-4">
                    <button type="button" class="btn btn-success" id="add-family-row"><i class="fa-solid fa-plus"
                            style="color: #ffffff;"></i> Tambah</button>
                </div>

                <div class="mt-5">
                    <button type="button" name="previous" id="previous-button"
                        class="btn btn-primary">Sebelumnya</button>
                    <button type="submit" name="next" class="btn btn-secondary">Selanjutnya</button>
                </div>

            </form>

        </div>

    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/application_form.js') }}"></script>

</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the "Previous" button element by its ID
        const previousButton = document.getElementById('previous-button');

        // Add a click event listener to the "Previous" button
        previousButton.addEventListener('click', function() {
            // Navigate back to the previous step, e.g., Step 1
            window.location.href =
                "{{ route('application-forms.tambah-anak', [
                    'user' => $user,
                    'lowongan' => $lowongan,
                ]) }}";
        });
    });
</script>



{{-- <div class="form-floating">
        <input type="number" class="form-control" name="jumlah_anggota_keluarga" id="jumlah_anggota_keluarga" placeholder="Jumlah Anggota Keluarga"
            onchange="addRowTableFamily()" min="0">
        <label for="jumlah_anggota_keluarga">Jumlah Anggota Keluarga</label>
    </div> --}}
{{-- <div class="col-3 mt-4">
    <button type="button" class="btn btn-success" id="add-family-row"><i class="fa-solid fa-plus"
            style="color: #ffffff;"></i> Tambah</button>
</div> --}}
