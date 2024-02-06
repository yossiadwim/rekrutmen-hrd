<div class="">
    @php
        
        if ($data->pelamar->hobi == null) {
            $array_hobi = null;
        } else {
            $string_hobi = $data->pelamar->hobi;
            $array_hobi = explode(', ', $string_hobi);
        }
    @endphp

    <div class="row">
        @if ($array_hobi == null)
            <h5 class="text-center">Tidak ada Data</h5>
        @else
            @foreach ($array_hobi as $item)
                <div class="col">
                    <h5><span class="badge rounded-pill text-bg-primary">{{ Str::title($item) }}</span>
                    </h5>
                </div>
            @endforeach
        @endif
    </div>
</div>
