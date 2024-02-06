
@if (in_array($data->pelamar->id, $pelatihanId))
<table class="table" id="tablePelatihan">
    <thead class="">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Subjek</th>
            <th scope="col">Tahun</th>
            <th scope="col">Nama Mentor</th>
        </tr>
    </thead>
    <tbody id="table-body-pelatihan">
        @for ($i = 0; $i < count($data->pelamar->pelatihan); $i++)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $data->pelamar->pelatihan[$i]->subjek_pelatihan }}</td>
                <td>{{ $data->pelamar->pelatihan[$i]->nama_mentor }}</td>
                <td>{{ $data->pelamar->pelatihan[$i]->tahun_pelatihan }}</td>
            </tr>
        @endfor
    </tbody>
</table>

@else
    <h5 class="text-center">Tidak Ada Data</h5>
@endif
