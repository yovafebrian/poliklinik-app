
<x-layouts.app title="Dokter Dashboard">
 @php
        $dokterId = auth()->id();
        $jadwalCount = \App\Models\JadwalPeriksa::where('id_dokter', $dokterId)->count();
        $pasienCount = \App\Models\User::where('role','pasien')->count();
        $recentJadwals = \App\Models\JadwalPeriksa::where('id_dokter', $dokterId)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->take(5)
            ->get();
        $nextJadwal = \App\Models\JadwalPeriksa::where('id_dokter', $dokterId)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->first();
        $today = \Carbon\Carbon::now()->locale(app()->getLocale())->isoFormat('dddd'); // tampilkan nama hari lokal jika perlu
    @endphp

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="info-box bg-primary">
                    <span class="info-box-icon"><i class="fas fa-calendar-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Jadwal</span>
                        <span class="info-box-number">{{ $jadwalCount }}</span>
                        <a href="{{ route('jadwal-periksa.index') }}" class="small-box-footer text-white">Kelola Jadwal <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-user-injured"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pasien</span>
                        <span class="info-box-number">{{ $pasienCount }}</span>
                        <a href="{{ route('pasiens.index') }}" class="small-box-footer text-white">Lihat Pasien <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12 mb-3">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Jadwal Berikutnya</span>
                        @if($nextJadwal)
                            <span class="info-box-number">{{ $nextJadwal->hari }} | {{ \Carbon\Carbon::createFromFormat('H:i:s', $nextJadwal->jam_mulai)->format('H:i') ?? $nextJadwal->jam_mulai }}</span>
                            <p class="mb-0 text-truncate">{{ 'Poli ID: ' . ($nextJadwal->id_poli ?? '-') }}</p>
                        @else
                            <span class="info-box-number">-</span>
                            <p class="mb-0">Belum ada jadwal</p>
                        @endif
                        <a href="{{ route('jadwal-periksa.index') }}" class="small-box-footer text-white">Kelola Jadwal <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Jadwal Terbaru</h3>
            </div>
            <div class="card-body p-0">
                @if($recentJadwals->isEmpty())
                    <div class="p-3">Belum ada jadwal. <a href="{{ route('jadwal-periksa.create') }}">Tambahkan jadwal</a></div>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($recentJadwals as $j)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $j->hari }}</strong> — {{ \Carbon\Carbon::createFromFormat('H:i:s', $j->jam_mulai)->format('H:i') ?? $j->jam_mulai }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $j->jam_selesai)->format('H:i') ?? $j->jam_selesai }}
                                    <div class="text-muted small">Poli: {{ $j->id_poli ?? '-' }}</div>
                                </div>
                                <div>
                                    <a href="{{ route('jadwal-periksa.edit', $j->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('jadwal-periksa.destroy', $j->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Hapus jadwal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>