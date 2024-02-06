@php
    if (in_array($data->pelamar->id, $kemampuanKomputerId)) {
        $string_nama_kemampuan = $data->pelamar->kemampuanKomputer[0]->nama_kemampuan;
        $array_kemampuan_komputer = explode(',', $string_nama_kemampuan);
    
        $string_software = $data->pelamar->kemampuanKomputer[0]->software;
        $array_software = explode(',', $string_software);
    } else {
        $array_kemampuan_komputer = null;
        $array_software = null;
    }
@endphp

@if ($array_kemampuan_komputer != null || $array_software != null)
    <div class="row">
        @foreach ($array_kemampuan_komputer as $item)
            <div class="col">
                <h5><span class="badge rounded-pill text-bg-primary">{{ Str::title($item) }}</span>
                </h5>
            </div>
        @endforeach
    </div>
    <div class="row">
        @foreach ($array_software as $item)
            <div class="col">
                <h5><span class="badge rounded-pill text-bg-primary">{{ Str::title($item) }}</span>
                </h5>
            </div>
        @endforeach
    </div>
@else
    <h5 class="text-center">Tidak ada Data</h5>
@endif
