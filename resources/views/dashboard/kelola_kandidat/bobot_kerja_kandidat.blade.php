{{-- @dd($data_lowongan) --}}
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SATUNAMA | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b3626122b8.js" crossorigin="anonymous"></script>

</head>

<body style="font-family: Poppins;">

    @include('partials.navbar')

    <div class="container mt-5 mb-5">
        <nav class="mt-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">

                    <a href="/admin-dashboard/lowongan/{{ $lowongan->slug }}/detail-pelamar/{{ $user->slug }}">Detail
                        Kandidat</a>


                </li>
                <li class="breadcrumb-item active" aria-current="page">Beban Kerja</li>
            </ol>
        </nav>

        @foreach ($data_lowongan as $data)
            @if ($data->statusLamaran[0]->status->nama_status == 'penawaran')
                <div class="row">
                    <div class="col-3 border rounded mx-2">
                        <div class="mt-4 text-center">
                            <img class="rounded-circle " width="150px"
                                src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                            <h6 class="mb-3 fw-bold">{{ $data->pelamar->nama_pelamar }}</h6>
                            <p>Melamar
                                {{ \Carbon\Carbon::parse($data->tanggal_melamar)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y ') }}
                            </p>
                        </div>

                        <div class="mt-3 d-flex justify-content-center">
                            @if ($data_penawaran[0]->sudah_terkirim)
                                <button type="button" class="btn btn-success" disabled>Sudah Terkirim <i
                                        class="fa-solid fa-circle-check" style="color: #ffffff;"></i></button>
                            @else
                                @if ($data_penawaran[0]->kisaran_gaji == null)
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#sendoffering">
                                        Kirim penawaran <i class="fa-solid fa-paper-plane" style="color: #ffffff;"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="sendoffering" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <form
                                                action="/admin-dashboard/lowongan/detail-pelamar/beban-kerja/{{ $user->slug }}"
                                                method="POST">
                                                @csrf

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Penawaran
                                                            Gaji
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Kirim penawaran kepada {{ $data->pelamar->nama_pelamar }} ?
                                                        <input type="text" name="id_pelamar_lowongan"
                                                            value="{{ $data->id_pelamar_lowongan }}" hidden>
                                                        <input type="text" name="kisaran_gaji"
                                                            value="{{ $gaji == null ? '-' : $gaji[0]->gaji }}" hidden>
                                                        <input type="text" name="sudah_terkirim" id="status_terkirim"
                                                            value="true" hidden>

                                                        <input type="text" name="id_lowongan" id="id_lowongan"
                                                            value="{{ $lowongan->id }}" hidden>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success">Kirim</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @elseif ($data_penawaran[0]->status_penawaran == 'negosiasi' && $data_penawaran[0]->gaji_final == null)
                                    <button class="btn btn-warning" disabled><span
                                            class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                        <span role="status">Sedang negosiasi...</span></button>
                                @elseif ($data_penawaran[0]->status_penawaran == 'negosiasi' && $data_penawaran[0]->gaji_final != null)
                                    <button class="btn btn-success" disabled><span
                                            class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                        <span role="status">Negosiasi sudah dikirim, menunggu
                                            konfirmasi...</span></button>
                                @elseif ($data_penawaran[0]->status_penawaran == 'terima')
                                    <button class="btn btn-success" disabled>Pelamar menerima penawaran</button>
                                @elseif ($data_penawaran[0]->status_penawaran == 'tolak')
                                    <button class="btn btn-danger" disabled>Pelamar menolak penawaran</button>
                                @endif
                            @endif
                        </div>
                    </div>


                    <div class="col-8 rounded border">
                        <div class="my-3">
                            <h5 class="fw-bold mb-3">{{ $data->lowongan->nama_lowongan }}</h5>
                            <h6 class="fw-bold mb-3"><i class="fa-solid fa-building" style="color: #000000;"></i>
                                Departemen
                                {{ $data->lowongan->departemen->nama_departemen }}</h6>
                            <p>Beban kerja: </p>
                            <div class="">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col" class="col-3 ">Jenis Analisa</th>
                                            <th scope="col" class="col-7">Analisa Kriteria</th>
                                            <th scope="col" class="col-2">Bobot Analisa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hasil_analisa as $index => $data_hasil_analisa)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ Str::title($data_hasil_analisa->jenisAnalisa->tipeAnalisa->nama_analisa) }}
                                                </td>
                                                <td>{{ $data_hasil_analisa->jenisAnalisa->jenisAnalisaKriteria[0]->jenis_analisa_kriteria }}
                                                </td>
                                                <td class="text-center">{{ $data_hasil_analisa->poin }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td style="border: none"></td>
                                            <td style="border: none"></td>
                                            <td class="text-end fw-bold" style="border: none;">Total poin</td>
                                            <td class="text-center fw-bold " style="border: none;">
                                                {{ $poin[0]->total_poin }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: none"></td>
                                            <td style="border: none"></td>
                                            <td class="text-end fw-bold" style="border: none">Kisaran Gaji</td>
                                            <td class="text-center fw-bold" style="border: none">Rp
                                                {{ number_format($gaji[0]->gaji, 0, ',', '.') }}
                                            </td>
                                        </tr>

                                        @if (in_array($data->id_pelamar_lowongan, $penawaran_pelamar_id))
                                            @if ($data_penawaran[0]->gaji_final != null)
                                                <td style="border: none"></td>
                                                <td style="border: none"></td>
                                                <td class="text-end fw-bold" style="border: none">Gaji Akhir</td>
                                                <td class="text-center fw-bold" style="border: none">Rp
                                                    {{ number_format($data_penawaran[0]->gaji_final, 0, ',', '.') }}
                                                </td>
                                            @endif
                                        @endif


                                    </tbody>

                                </table>
                                <div class=""
                                    {{ $data_penawaran[0]->status_penawaran == 'terima' ? '' : 'hidden' }}>
                                    <i>*Penerima telah menerima penawaran ini</i>
                                </div>
                                <div class=""
                                    {{ $data_penawaran[0]->status_penawaran == 'tolak' ? '' : 'hidden' }}>
                                    <i>*Penerima telah menolak penawaran ini</i>
                                </div>
                                @if ($data_penawaran[0]->status_penawaran == 'negosiasi' && $data_penawaran[0]->gaji_final == null)
                                    <p class="mt-3">Apakah sudah selesai?</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="sudah" onclick="showHideInputGajiFinal()">
                                        <label class="form-check-label" for="sudah">
                                            Sudah
                                        </label>
                                    </div>

                                    <div class="form-floating mb-3 col-4" id="form-gaji-final" style="display: none"
                                        onclick="showHideInputGajiFinal()">

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Tetapkan gaji final
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form
                                                        action="/admin-dashboard/lowongan/detail-pelamar/beban-kerja/{{ $user->slug }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-body">

                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control"
                                                                    id="gaji_final" name="gaji_final"
                                                                    oninput="formatCurrency(this)">
                                                                <input type="text" name="kisaran_gaji"
                                                                    value="{{ $data_penawaran[0]->kisaran_gaji }}"
                                                                    hidden>
                                                                <input type="text" name="id_lowongan"
                                                                    value="{{ $lowongan->id }}"
                                                                    hidden>
                                                                <label for="gaji_final">Masukkan gaji final</label>
                                                            </div>
                                                            {{-- <input type="text" name="status_penawaran"
                                                            value="terima" hidden> --}}
                                                        </div>
                                                        <div class="mb-3 d-flex justify-content-end mx-3">
                                                            <button type="button" class="btn btn-secondary mx-2"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-primary mx-2">Lanjutkan
                                                            </button>

                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="belum">
                                        <label class="form-check-label" for="belum">
                                            Belum
                                        </label>
                                    </div>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
<script>
    function showHideInputGajiFinal() {
        const showRadio = document.getElementById('sudah');
        const hideRadio = document.getElementById('belum');
        const input_gaji_final = document.getElementById('form-gaji-final');

        showRadio.addEventListener('change', () => {
            if (showRadio.checked) {
                input_gaji_final.style.display = 'block';
            }
        });

        hideRadio.addEventListener('change', () => {
            if (hideRadio.checked) {
                input_gaji_final.style.display = 'none';
            }
        });

    }

    function formatCurrency(input) {

        // Get input value and remove non-numeric characters
        let value = input.value.replace(/[^\d]/g, '');

        // Format the value with IDR currency format
        let formattedValue = formatIDRCurrency(value);

        // Update the input value with the formatted currency value
        input.value = formattedValue;

        input_gaji.addEventListener("input", function() {
            if (input_gaji.value != "") {
                input_gaji.classList.add("is-valid");
            } else {
                input_gaji.classList.add("is-invalid");
            }
        })

    }

    function formatIDRCurrency(value) {

        let formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        });

        return formatter.format(Number(value));
    }
</script>
