<div class="tab-pane fade" id="pills-penawaran" role="tabpanel"aria-labelledby="pills-penawaran-tab" tabindex="0">
    <div class="container mt-4 rounded " id="kandidat_container">
        <div class="row" id="kandidat">
            {{-- @foreach ($datas as $data)
                @if ($data->statusLamaran[0]->status->slug == 'penawaran')
                    <div class="col-sm-3">
                        <div class="card text-center mt-4 mb-3 h-200 shadow-sm" style="width: 18rem;">
                            <div class="card-header" style="background-color: white">
                                <span class="badge rounded-pill"
                                    style="background-color: #90c291; color: #ffffff ">{{ Str::title($data->statusLamaran[0]->status->nama_status) }}

                                </span>
                            </div>
                            <div class="card-body">
                                <img class="rounded-circle" height="70px" width="70px"
                                    style="border-radius: 50%; object-fit: cover;"
                                    src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                <h5 class="card-title">{{ $data->pelamar->nama_pelamar }}
                                </h5>

                                <p class="card-text mt-1"><i class="fa-solid fa-location-dot"></i>
                                    {{ $data->pelamar->alamat }}</p>
                                <p>Melamar pada
                                    {{ \Carbon\Carbon::parse($data->tanggal_melamar)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y ') }}
                                </p>
                                <a href="/admin-dashboard/lowongan/detail-pelamar/{{ $data->pelamar->user->slug }}"
                                    class="btn" style="background-color: #90c291; outline-color: #90c291">Lihat
                                    Detail </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="container col-12 mt-4 ">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('img/search.png') }}" alt="" class="">
                        </div>
                        <div class="d-flex justify-content-center">
                            <p class="mt-3 fw-semibold">Tidak ada pelamar ditahap ini</p>
                        </div>

                    </div>
                @endif
            @endforeach --}}



            @if (count($penawaran) > 0)
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama & Alamat</th>
                            <th scope="col">Email</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Nomor Telepon</th>
                            <th scope="col">Posisi Terakhir</th>
                            <th scope="col">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($penawaran); $i++)
                            <tr class="text-center">
                                <th scope="row">{{ $i + 1 }}</th>
                                <td>{{ $penawaran[$i]['pelamar']['nama_pelamar'] }} {!! nl2br('<br>') !!}
                                    {{ $penawaran[$i]['pelamar']['alamat'] }}</td>
                                <td>{{ $penawaran[$i]['pelamar']['email'] }}</td>
                                <td>{{ $penawaran[$i]['pelamar']['jenis_kelamin'] }}</td>
                                <td>{{ $penawaran[$i]['pelamar']['telepon_rumah'] }}</td>
                                @if ($penawaran[$i]['pelamar']['pengalaman_kerja'] != null)
                                    <td>
                                        @for ($j = 0; $j < count($penawaran[$i]['pelamar']['pengalaman_kerja']); $j++)
                                            {{ $penawaran[$i]['pelamar']['pengalaman_kerja'][$j]['posisi'] }}
                                            {!! nl2br('<br>') !!}
                                        @endfor
                                    </td>
                                @else
                                    <td>-</td>
                                @endif
                                <td>
                                    <a href="/admin-dashboard/lowongan/{{ $datas[0]->lowongan->slug }}/detail-pelamar/{{ $penawaran[$i]['pelamar']['user']['uuid'] }}"
                                        class="btn btn-success btn-detail fw-semibold text-white"
                                        id="button-detail-{{ $penawaran[$i]['pelamar']['user']['slug'] }}"
                                        data-pk-id="{{ $penawaran[$i]['pelamar']['user']['slug'] }}"
                                       ><i
                                            class="bi bi-info-circle-fill"></i> Detail </a>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                {{-- @for ($i = 0; $i < count($penawaran); $i++)
                    <div class="col-sm-3">
                        <div class="card text-center mt-4 mb-3 h-200 shadow-sm" style="width: 18rem;">
                            <div class="card-header" style="background-color: white">
                                <span class="badge rounded-pill"
                                    style="background-color: #90c291; color: #ffffff ">{{ Str::title($review[$i]['status_lamaran'][0]['status']['nama_status']) }}

                                </span>
                            </div>
                            <div class="card-body">
                                <img class="rounded-circle" height="70px" width="70px"
                                    style="border-radius: 50%; object-fit: cover;"
                                    src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                <h5 class="card-title">
                                </h5>

                                <p class="card-text mt-1"><i class="fa-solid fa-location-dot"></i>
                                </p>
                                <p>Melamar pada
                                    {{ \Carbon\Carbon::parse($data->tanggal_melamar)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('l, j F Y ') }}
                                </p>
                                <a href="/admin-dashboard/lowongan/detail-pelamar/" class="btn"
                                    style="background-color: #90c291; outline-color: #90c291">Lihat
                                    Detail </a>
                            </div>
                        </div>
                    </div>  
                @endfor --}}
            @else
                <div class="container col-12 mt-4 ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('img/search.png') }}" alt="" class="">
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="mt-3 fw-semibold">Tidak ada pelamar ditahap ini</p>
                    </div>

                </div>
            @endif
        </div>
    </div>


</div>
