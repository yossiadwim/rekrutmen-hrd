@if (in_array($data->pelamar->id, $penguasaanBahasaId))

    <div class="">
        <ul>
            @foreach ($data->pelamar->penguasaanBahasa as $data_penguasaan_bahasa)
                <li>{{ $data_penguasaan_bahasa->nama_bahasa }} -
                    {{ $data_penguasaan_bahasa->tingkat_penguasaan }}</li>
            @endforeach
        </ul>
    </div>
@else
    <h5 class="text-center">Tidak Ada Data  </h5>
@endif
