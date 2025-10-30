<x-layouts.app title="Jadwal Periksa Dokter">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-12">
                {{-- <h1 class="mb-4">Jadwal Periksa Dokterasdasda</h1> --}}
                {{-- ALERT FLASH MESSAGE --}}
                @if (session('message'))
                    <div class="alert alert-{{ session('type') ?? 'success' }} alert-dismissible fade show" role="alert">
                        <strong>{{ session('type') == 'danger' ? 'Error!' : 'Berhasil!' }}</strong>
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <a href="{{ route('jadwal-periksa.create') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-plus"></i> Tambah Jadwal Periksa
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwalPeriksas as $jadwalPeriksa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jadwalPeriksa->hari }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwalPeriksa->jam_mulai)->format('H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwalPeriksa->jam_selesai)->format('H:i') }}</td>
                                    <td>
                                        <a href="{{ route('jadwal-periksa.edit', $jadwalPeriksa->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('jadwal-periksa.destroy', $jadwalPeriksa->id) }}"
                                            method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data jadwal periksa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, 3000);
    </script>
</x-layouts.app>
