<x-layouts.app title="Pasien Dashboard">
    @php
        $user = auth()->user();
        $totalPoli = \App\Models\Poli::count();
        $totalJadwal = \App\Models\JadwalPeriksa::count();
        $totalPasien = \App\Models\User::where('role','pasien')->count();
        $myRegistrations = \App\Models\DaftarPoli::where('id_pasien', $user->id)->with(['jadwalPeriksa.poli','jadwalPeriksa.dokter'])->latest()->take(5)->get();
        $upcoming = \App\Models\DaftarPoli::where('id_pasien', $user->id)->with(['jadwalPeriksa'])->whereHas('jadwalPeriksa')->orderBy('id')->first();
    @endphp

    <div class="container-fluid mt-4">
        <h4 class="mb-4">Halo, {{ $user->nama ?? $user->name }}</h4>

        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-hospital"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Poli</span>
                        <span class="info-box-number">{{ $totalPoli }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-calendar-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Jadwal</span>
                        <span class="info-box-number">{{ $totalJadwal }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pasien</span>
                        <span class="info-box-number">{{ $totalPasien }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-primary">
                    <span class="info-box-icon"><i class="fas fa-user-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Registrasi Saya</span>
                        <span class="info-box-number">{{ \App\Models\DaftarPoli::where('id_pasien', $user->id)->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Registrasi Terbaru Saya</h6>
                    </div>
                    <div class="card-body">
                        @if($myRegistrations->isEmpty())
                            <div class="text-muted">Belum ada pendaftaran. <a href="{{ route('pasien.daftar') }}">Daftar sekarang</a></div>
                        @else
                            <ul class="list-group">
                                @foreach($myRegistrations as $r)
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fw-semibold">{{ $r->jadwalPeriksa->poli->nama_poli ?? '-' }}</div>
                                            <small class="text-muted">{{ $r->jadwalPeriksa->hari ?? '-' }} • {{ \Carbon\Carbon::createFromFormat('H:i:s', $r->jadwalPeriksa->jam_mulai ?? '00:00:00')->format('H:i') }}</small>
                                            <div class="small text-muted">No. antrean: {{ $r->no_antrian }}</div>
                                        </div>
                                        <div class="text-end">
                                            <small class="badge bg-secondary">{{ $r->jadwalPeriksa->dokter->nama ?? 'Dokter' }}</small>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ route('pasien.daftar') }}" class="btn btn-sm btn-primary">Daftar Poli</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Jadwal Umum</h6>
                    </div>
                    <div class="card-body">
                        @php
                            $recentJadwals = \App\Models\JadwalPeriksa::with(['poli','dokter'])->orderBy('hari')->orderBy('jam_mulai')->take(6)->get();
                        @endphp

                        @if($recentJadwals->isEmpty())
                            <div class="text-muted">Belum ada jadwal terdaftar.</div>
                        @else
                            <ul class="list-group">
                                @foreach($recentJadwals as $j)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $j->poli->nama_poli ?? '-' }}</strong>
                                            <div class="small text-muted">{{ $j->hari }} • {{ \Carbon\Carbon::createFromFormat('H:i:s', $j->jam_mulai ?? '00:00:00')->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $j->jam_selesai ?? '00:00:00')->format('H:i') }}</div>
                                        </div>
                                        <span class="badge bg-primary">{{ $j->dokter->nama ?? 'Dokter' }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>