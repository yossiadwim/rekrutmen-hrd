<div class="tab-pane fade show" id="pills-reference-check" role="tabpanel" aria-labelledby="pills-reference-check-tab"
    tabindex="0">
    <div class="container mt-4 rounded border border-1" id="kandidat_container">
        <div class="row " id="kandidat">
            @if (count($reference_check) > 0)
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
                        @for ($i = 0; $i < count($reference_check); $i++)
                            <tr class="text-center">
                                <th scope="row">{{ $i + 1 }}</th>
                                <td>{{ $reference_check[$i]['pelamar']['nama_pelamar'] }} {!! nl2br('<br>') !!}
                                    {{ $reference_check[$i]['pelamar']['alamat'] }}</td>
                                <td>{{ $reference_check[$i]['pelamar']['email'] }}</td>
                                <td>{{ $reference_check[$i]['pelamar']['jenis_kelamin'] != null ? $reference_check[$i]['pelamar']['jenis_kelamin'] : 'Belum diisi' }}
                                </td>
                                <td>{{ $reference_check[$i]['pelamar']['telepon_rumah'] }}</td>
                                @if ($reference_check[$i]['pelamar']['pengalaman_kerja'] != null)
                                    <td>
                                        @for ($j = 0; $j < count($reference_check[$i]['pelamar']['pengalaman_kerja']); $j++)
                                            {{ $reference_check[$i]['pelamar']['pengalaman_kerja'][$j]['posisi'] }} {!! nl2br('<br>') !!}
                                        @endfor
                                    </td>
                                @else
                                    <td>-</td>
                                @endif
                                <td>
                                    <a href="/admin-dashboard/lowongan/{{ $datas[0]->lowongan->slug }}/detail-pelamar/{{ $reference_check[$i]['pelamar']['user']['uuid'] }}"
                                        class="btn btn-success btn-detail fw-semibold text-white"
                                        id="button-detail-{{ $reference_check[$i]['pelamar']['user']['slug'] }}"
                                        data-pk-id="{{ $reference_check[$i]['pelamar']['user']['slug'] }}"
                                        ><i
                                            class="bi bi-info-circle-fill"></i> Detail </a>

                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
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
