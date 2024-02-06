<div class="modal modal-lg fade" id="instrumen-manajemen" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Instrumen
                    {{ $analisa_manajemen[0]->id_tipe_analisa }}/9
                    {{ Str::title($analisa_manajemen[0]->nama_analisa) }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="accordion" id="manajemen">
                    @foreach ($analisa_manajemen as $data)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#manajemen_{{ $data->id_jenis_analisa }}" aria-expanded="false"
                                    aria-controls="manajemen_{{ $data->id_jenis_analisa }}">
                                    {{ $data->jenis_analisa_kriteria }}
                                </button>
                            </h2>
                            <div id="manajemen_{{ $data->id_jenis_analisa }}" class="accordion-collapse collapse"
                                data-bs-parent="#manajemen">
                                <div class="accordion-body">
                                    <form
                                        action="/admin-dashboard/lowongan/{{ $lowongan->slug }}/instrumen-analisis-beban-kerja/{{ $data_pelamar->slug }}"
                                        method="POST">
                                        @csrf
                                        <ul>
                                            <li>
                                                <p>{!! str_replace('\n', '<br />', $data->kriteria) !!}</p>
                                            </li>
                                        </ul>

                                        <label for="range-manajemen-{{ $data->id_jenis_analisa }}"
                                            class="form-label">Bobot</label>

                                        <label for=""><span class="badge text-bg-secondary"
                                                id="label_bobot_manajemen-{{ $data->id_jenis_analisa }}">0</span></label>

                                        <input type="range" class="form-range form-range-manajemen mb-5" min="{{ $data->bobot_minimal }}"
                                            max="{{ $data->bobot_maksimal }}" step="1" value="{{ $data->id_jenis_analisa }}"
                                            id="range-manajemen-{{ $data->id_jenis_analisa }}" name="bobot" oninput="getID({{ $data->id_jenis_analisa }})">

                                        <input type="text" name="indeks" value="{{ $data->indeks }}" hidden>

                                        <input type="text" name="slug_analisa" value="{{ $data->slug }}" hidden>

                                        {{-- <input type="text" name="slug_user"
                                            value="{{ $datas[0]->pelamar->user->slug }}" hidden> --}}

                                        <input type="text" name="id_tipe_analisa"
                                            value="{{ $data->id_tipe_analisa }}" hidden>

                                        <input type="text" name="id_jenis_analisa"
                                            value="{{ $data->id_jenis_analisa_kriteria }}" hidden>

                                        <input type="text" name="id_pelamar_lowongan"
                                            value="{{ $pelamar_lowongan[0]->id_pelamar_lowongan }}" hidden>
                                        <input type="text" name="id" value="{{ $lowongan->id }}" hidden>

                                        <input type="text" name="id_karyawan"
                                            value="{{ auth()->user()->id_karyawan }}" hidden>


                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success btn-simpan-analisa"
                                                id="simpan-analisa-{{ $data->id_jenis_analisa }}"
                                                value="{{ $data->id_jenis_analisa }}">Simpan</button>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
            </div>

        </div>
    </div>
</div>
