<x-layouts.guest>
    <div class="login-box d-flex flex-column justify-content-center align-items-center w-100 vh-100">
        <div class="login-logo mb-3">
            <a href="#"><b>Poli</b>klinik</a>
        </div>

        <div class="card shadow">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Harap daftar terlebih dahulu untuk membuat akun</p>

                {{-- Tampilkan error validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="nama" value="{{ old('nama') }}" required placeholder="Nama Lengkap">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="input-group mb-3">
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}" required placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="{{ old('alamat') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                {{-- Gunakan ikon map-marker-alt agar aman di semua versi --}}
                                <span class="fas fa-map-marker-alt"></span>
                            </div>
                        </div>
                    </div>

                    {{-- No HP --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="No HP" name="no_hp" value="{{ old('no_hp') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-mobile-alt"></span>
                            </div>
                        </div>
                    </div>

                    {{-- No KTP --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="No KTP" name="no_ktp" value="{{ old('no_ktp') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password_confirmation" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                        </div>
                    </div>
                </form>

                <p class="mt-3 mb-0 text-center">
                    Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</x-layouts.guest>
