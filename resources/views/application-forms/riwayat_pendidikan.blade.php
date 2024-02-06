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
    @include('partials.navbar')

    @include('partials.notification_pelamar')

    <div class="container mt-5 mb-5">
        <h3>
            <p class="fw-bold">Application Form - Riwayat Pendidikan</p>
        </h3>
        @if ($pendidikanExists)
            <form action="/{{ $lowongan->slug }}/application-form/data-riwayat-pendidikan" method="post">
                @csrf
                <table class="table mt-4" id="tableRiwayatPendidikan">
                    <thead class="text-center">
                        <tr>
                            <th scope="col-2">Jenjang</th>
                            <th scope="col">Nama Sekolah/Universitas</th>
                            <th scope="col col-2">Jurusan</th>
                            <th scope="col-1">Tahun Selesai</th>
                            <th scope="col-1">IPK</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="table-body-riwayat-pendidikan">
                        @foreach ($pendidikans as $pendidikan)
                            <tr id="table-row-riwayat-pendidikan">
                                <td class="col-2">
                                    <div class="">
                                        <select class="form-select" aria-label="Default select example"
                                            id="jenjangPendidikan" name="jenjang_pendidikan[]" disabled>
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
                                                <option value="SMP" selected>SMP (Sekolah Menengah Pertama)
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
                                                <option value="SMA" selected>SMA (Sekolah Menengah Atas)
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
                                                <option value="SMA">SMA (Sekolah Menengah Atas)
                                                </option>
                                                <option value="SMK" selected>SMK (Sekolah Menengah Kejuruan)
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
                                                <option value="SMP">SMP
                                                </option>
                                                <option value="SMA">SMA
                                                </option>
                                                <option value="SMK">SMK
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
                                                <option value="SMP">SMP
                                                </option>
                                                <option value="SMA">SMA
                                                </option>
                                                <option value="SMK">SMK
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
                                                <option value="SMP">SMP
                                                </option>
                                                <option value="SMA">SMA
                                                </option>
                                                <option value="SMK">SMK
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
                                                <option value="SMP">SMP
                                                </option>
                                                <option value="SMA">SMA
                                                </option>
                                                <option value="SMK">SMK
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
                                                <option value="SMP">SMP
                                                </option>
                                                <option value="SMA">SMA
                                                </option>
                                                <option value="SMK">SMK
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
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="nama_institusi"
                                        name="nama_institusi[]" placeholder="Nama Sekolah/Universitas"
                                        value="{{ old('jenjang_pendidikan', $pendidikan->nama_institusi) == null ? '' : $pendidikan->nama_institusi }}"
                                        disabled>
                                </td>
                                <td class="col-2">
                                    <input type="text" class="form-control" id="jurusan" name="jurusan[]"
                                        placeholder="Jurusan"
                                        value="{{ old('jenjang_pendidikan', $pendidikan->jurusan) == null ? '' : $pendidikan->jurusan }}"
                                        disabled>
                                </td>
                                <td class="col-1">
                                    <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus[]"
                                        placeholder=""
                                        value="{{ old('jenjang_pendidikan', $pendidikan->tahun_lulus) == null ? '' : $pendidikan->tahun_lulus }}"
                                        disabled>
                                </td>
                                <td class="col-1">
                                    <input type="text" class="form-control" id="ipk" name="ipk[]"
                                        placeholder="Indeks Prestasi Kumulatif (IPK)"
                                        value="{{ old('jenjang_pendidikan', $pendidikan->ipk) == null ? '' : $pendidikan->ipk }}"
                                        disabled>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                    <tbody id="table-riwayat-pendidikan-2">

                    </tbody>

                    
                </table>

                <div class="col-3 mt-4">
                    <button type="button" class="btn btn-success" id="add-education-row"><i
                            class="fa-solid fa-plus" style="color: #ffffff;"></i> Tambah</button>
                </div>
                
                <div class="mt-5">
                    <button type="button" name="previous" id="previous-button" class="btn btn-primary">Sebelumnya</button>
                    <button type="submit" name="next" class="btn btn-secondary">Selanjutnya</button>
                </div>
            </form>

            {{-- <div class="col-3 mt-4">
                <button type="button" class="btn btn-success" id="add-education-row"><i class="fa-solid fa-plus"
                        style="color: #ffffff;"></i> Tambah</button>
            </div> --}}
        @else
            <form action="/{{ $lowongan->slug }}/application-form/data-riwayat-pendidikan" method="post">
                @csrf
                <table class="table mt-4" id="tableRiwayatPendidikan">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Jenjang</th>
                            <th scope="col">Nama Sekolah/Universitas</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Tahun Selesai</th>
                            <th scope="col">Indeks Prestasi Kumulatif (IPK)</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="table-body-riwayat-pendidikan">
                        {{-- <tr id="table-row-riwayat-pendidikan">
                    <td>
                        <div class="">
                            <select class="form-select" aria-label="Default select example" id="jenjangPendidikan"
                                name="jenjang_pendidikan[]" disabled>
                                <option value="SD" selected>SD (Sekolah Dasar)
                                </option>
                                <option value="SMP">SMP
                                </option>
                                <option value="SMA">SMA
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
    
                            </select>
                        </div>
                    </td>
                    <td>
                        <input type="text" class="form-control" id="nama_institusi" name="nama_institusi[]"
                            placeholder="Nama Sekolah/Universitas">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="jurusan" name="jurusan[]"
                            placeholder="Jurusan">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus[]"
                            placeholder="Tahun Selesai">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="ipk" name="ipk[]"
                            placeholder="Indeks Prestasi Kumulatif (IPK)">
                    </td>
                    <td>
                        <button type="button" class="btn btn-success" id="add-education-row"><i
                                class="fa-solid fa-plus" style="color: #ffffff;"></i> Tambah</button>
    
                    </td>
                </tr> --}}
                </table>

                <div class="col-3 mt-4">
                    <button type="button" class="btn btn-success" id="add-education-row"><i
                            class="fa-solid fa-plus" style="color: #ffffff;"></i> Tambah</button>
                </div>
            </form>

        @endif

        {{-- <div class="mt-5">
            <button type="button" name="previous" id="previous-button" class="btn btn-primary">Sebelumnya</button>
            <button type="submit" name="next" class="btn btn-secondary">Selanjutnya</button>
        </div> --}}

    </div>

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
                "{{ route('application-forms.tambah-data-kondisi-kesehatan', [
                    'user' => $user,
                    'lowongan' => $lowongan,
                ]) }}";
        });
    });
</script>
