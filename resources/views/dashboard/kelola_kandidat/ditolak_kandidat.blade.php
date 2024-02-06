<div class="tab-pane fade" id="pills-ditolak" role="tabpanel" aria-labelledby="pills-ditolak-tab" tabindex="0">
    <div class="container mt-4 rounded border border-1" id="kandidat_container">
        <div class="row " id="kandidat">
            @if (count($ditolak) > 0)
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
                        @for ($i = 0; $i < count($ditolak); $i++)
                            <tr class="text-center">
                                <th scope="row">{{ $i + 1 }}</th>
                                <td>{{ $ditolak[$i]['pelamar']['nama_pelamar'] }} {!! nl2br('<br>') !!}
                                    {{ $ditolak[$i]['pelamar']['alamat'] }}</td>
                                <td>{{ $ditolak[$i]['pelamar']['email'] }}</td>
                                <td>{!! $ditolak[$i]['pelamar']['jenis_kelamin'] != null ? $ditolak[$i]['pelamar']['jenis_kelamin'] : '-' !!}</td>
                                <td>{{ $ditolak[$i]['pelamar']['telepon_rumah'] != null ? $ditolak[$i]['pelamar']['telepon_rumah'] : '-' }}
                                </td>
                                @if ($ditolak[$i]['pelamar']['pengalaman_kerja'] != null)
                                <td>
                                    @for ($j = 0; $j < count($ditolak[$i]['pelamar']['pengalaman_kerja']); $j++)
                                        {{ $ditolak[$i]['pelamar']['pengalaman_kerja'][$j]['posisi'] }} {!! nl2br('<br>') !!}
                                    @endfor
                                </td>
                                @else
                                    <td>-</td>
                                @endif
                                <td>
                                    <a href="/admin-dashboard/lowongan/{{ $datas[0]->lowongan->slug }}/detail-pelamar/{{ $ditolak[$i]['pelamar']['user']['uuid'] }}"
                                        class="btn btn-success btn-detail fw-semibold text-white"
                                        id="button-detail-{{ $ditolak[$i]['pelamar']['user']['slug'] }}"
                                        data-pk-id="{{ $ditolak[$i]['pelamar']['user']['slug'] }}"
                                        ><i
                                            class="bi bi-info-circle-fill"></i> Detail </a>
                                    {{-- {!! nl2br('<br>') !!} --}}

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
