<div class="offcanvas offcanvas-end " data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="notifikasi_user"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Notifikasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#belum_dibaca"
                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Belum
                    Dibaca</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#sudah_dibaca"
                    type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Sudah
                    Dibaca</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane mt-2 fade show active" id="belum_dibaca" role="tabpanel" aria-labelledby="home-tab"
                tabindex="0">
                @foreach ($notifikasi_unread as $notif)
                    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                        @if ($notif->type == 'App\Notifications\RegisterMessage')
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-2 fw-bold ">{!! $notif->data['subject'] !!}</h6>
                            </div>
                            <p class="mb-1">Selamat datang {{ $notif->data['nama_pelamar'] }}</p>
                        @elseif($notif->type == 'App\Notifications\ApplicationStatusChange')
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-2 fw-bold ">{!! $notif->data['subject'] !!}</h6>
                            </div>
                            <p class="mb-1">Status lamaran pada {{ $notif->data['nama_lowongan'] }} diperbarui ke
                                Tahap </p>
                            <p class="fw-bold">{{ $notif->data['status'] }} </p>
                            </p>
                        @endif
                    </a>
                    <p><a href="/markasread/{{ $notif->id }}"
                            class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Tandai
                            sudah dibaca</a></p>
                    <small>{{ $notif->created_at->diffForHumans() }}</small>
                    <hr class="dividers">
                @endforeach
            </div>
            <div class="tab-pane fade mt-2" id="sudah_dibaca" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                @foreach ($notifikasi_read as $notif)
                    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                        @if ($notif->type == 'App\Notifications\RegisterMessage')
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-2 fw-bold ">{!! $notif->data['subject'] !!}</h6>
                            </div>
                            <p class="mb-1 ">Selamat datang {{ $notif->data['nama_pelamar'] }}</p>
                            
                        @elseif($notif->type == 'App\Notifications\ApplicationStatusChange')
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-2 fw-bold ">{!! $notif->data['subject'] !!}</h6>
                            </div>
                            <p class="mb-1">Status lamaran pada {{ $notif->data['nama_lowongan'] }} diperbarui ke
                                Tahap </p>
                            <p class="fw-bold">{{ $notif->data['status'] }} </p>
                            </p>
                        @endif
                    </a>
                    <small>{{ $notif->created_at->diffForHumans() }}</small>
                    <hr class="dividers">
                @endforeach
            </div>
        </div>

    </div>
</div>
