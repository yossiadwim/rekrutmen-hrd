@if (in_array($data->pelamar->id, $referensiId))
    <div class="">
        <table class="table" id="tableReferensi">
            <thead class="">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Posisi</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Hubungan</th>

                </tr>
            </thead>
            <tbody id="table-body-referensi-satunama">
                @for ($i = 0; $i < count($data->pelamar->referensi); $i++)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $data->pelamar->referensi[$i]->nama_referensi }}</td>
                        <td>{{ $data->pelamar->referensi[$i]->email_referensi }}</td>
                        <td>{{ $data->pelamar->referensi[$i]->telepon_referensi }}</td>
                        <td>{{ $data->pelamar->referensi[$i]->posisi_referensi == null ? '-' : $data->pelamar->referensi[$i]->posisi_referensi }}
                        </td>
                        <td>{{ $data->pelamar->referensi[$i]->alamat_referensi }}</td>
                        <td>{{ $data->pelamar->referensi[$i]->hubungan_referensi }}
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@else
    <h5 class="text-center">Tidak Ada Data</h5>
@endif
