<x-layouts.app title="Admin Dashboard">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-hospital"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Poli</span>
                        <span class="info-box-number">{{ \App\Models\Poli::count() }}</span>
                        <a href="{{ route('polis.index') }}" class="small-box-footer text-white">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-user-md"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Dokter</span>
                        <span class="info-box-number">{{ \App\Models\User::where('role','dokter')->count() }}</span>
                        <a href="{{ route('dokters.index') }}" class="small-box-footer text-white">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-user-injured"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pasien</span>
                        <span class="info-box-number">{{ \App\Models\User::where('role','pasien')->count() }}</span>
                        <a href="{{ route('pasiens.index') }}" class="small-box-footer text-white">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="info-box bg-danger">
                    <span class="info-box-icon"><i class="fas fa-pills"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Obat</span>
                        <span class="info-box-number">{{ \App\Models\Obat::count() }}</span>
                        <a href="{{ route('obats.index') }}" class="small-box-footer text-white">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Jadwal Periksa (Total)</h3>
                    </div>
                    <div class="card-body">
                        <h2>{{ \App\Models\JadwalPeriksa::count() }}</h2>
                        <p class="text-muted">Jumlah entri jadwal periksa yang tersimpan.</p>
                        <a href="{{ route('jadwal-periksa.index') }}" class="btn btn-sm btn-primary">Kelola Jadwal Periksa</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Dokter</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach(\App\Models\User::where('role','dokter')->latest()->take(5)->get() as $dokter)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $dokter->nama ?? $dokter->name }}
                                    <span class="badge badge-primary badge-pill">{{ $dokter->email }}</span>
                                </li>
                            @endforeach
                            @if(\App\Models\User::where('role','dokter')->count() == 0)
                                <li class="list-group-item">Belum ada dokter terdaftar.</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>