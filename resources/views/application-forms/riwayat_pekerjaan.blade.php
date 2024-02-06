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

        <div class="container mt-5 mb-5">
            <h3>
                <p class="fw-bold">Application Form - Pengalaman Kerja</p>
            </h3>
            <form action="/{{ $lowongan->slug }}/application-form/data-pengalaman-kerja" method="post">
                @csrf
                @if ($pengalamanKerjaExists)
                    <table class="table mt-4" id="tableRiwayatPendidikan">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Nama Perusahaan</th>
                                <th scope="col">Email Instansi</th>
                                <th scope="col">No Telepon</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">Periode</th>
                                <th scope="col">Gaji</th>
                                <th scope="col">Alasan Mengundurkan Diri</th>
                                <th scope="col"></th>


                            </tr>
                        </thead>
                        <tbody id="table-body-riwayat-pekerjaan">
                            @foreach ($pengalamanKerja as $pk)
                                <tr id="table-row-riwayat-pekerjaan">
                                    <td>
                                        <input type="text" class="form-control" id="nama_perusahaan"
                                            name="nama_perusahaan" placeholder="Nama Perusahaan"
                                            value="{{ old('nama_perusahaan', $pk->nama_perusahaan) == null ? '' : $pk->nama_perusahaan }}"
                                            disabled>

                                    </td>
                                    <td>
                                        <input type="email" class="form-control" id="email_instansi" name="email_instansi"
                                            placeholder="Email Instansi"
                                            value="{{ old('email_instansi', $pk->email_instansi) == null ? '' : $pk->email_instansi }}"
                                            disabled>

                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="telepon" name="telepon"
                                            placeholder="No Telepon"
                                            value="{{ old('telepon', $pk->telepon) == null ? '' : $pk->telepon }}" disabled>

                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="posisi" name="posisi"
                                            placeholder="Posisi"
                                            value="{{ old('posisi', $pk->posisi) == null ? '' : $pk->posisi }}" disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="periode" name="periode"
                                            placeholder="Periode"
                                            value="{{ old('periode', $pk->periode) == null ? '' : $pk->periode }}" disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="gaji" name="gaji"
                                            placeholder="Gaji" value=" @currency($pk->gaji)" disabled>
                                    </td>
                                    <td>
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="alasan_mengundurkan_diri"
                                                style="height: 200px" disabled>{{ $pk->alasan_mengundurkan_diri }}</textarea>
                                            <label for="floatingTextarea2">Alasan mengundurkan diri</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tbody id="table-body-riwayat-pekerjaan-2">

                        </tbody>
                    </table>

                    <div class="col-3 mt-4">
                        <button type="button" class="btn btn-success" id="add-work-row"><i class="fa-solid fa-plus"
                                style="color: #ffffff;"></i> Tambah</button>
                    </div>
                @else
                    <table class="table mt-4" id="tableRiwayatPendidikan">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Nama Perusahaan</th>
                                <th scope="col">Email Instansi</th>
                                <th scope="col">No Telepon</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">Periode</th>
                                <th scope="col">Gaji</th>
                                <th scope="col">Alasan Mengundurkan Diri</th>
                                <th scope="col"></th>


                            </tr>
                        </thead>
                        <tbody id="table-body-riwayat-pekerjaan">

                        </tbody>
                    </table>
                    <div class="col-3 mt-4">
                        <button type="button" class="btn btn-success" id="add-work-row"><i class="fa-solid fa-plus"
                                style="color: #ffffff;"></i> Tambah</button>
                    </div>
                @endif
                <div class="mt-5">
                    <button type="button" name="previous" id="previous-button"
                        class="btn btn-primary">Sebelumnya</button>
                    <button type="submit" name="next" class="btn btn-secondary">Selanjutnya</button>
                </div>

            </form>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="{{ asset('js/application_form.js') }}"></script>

    @endauth
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
                "{{ route('application-forms.tambah-data-penguasaan-bahasa', [
                    'user' => $user,
                    'lowongan' => $lowongan,
                ]) }}";
        });
    });
</script>
