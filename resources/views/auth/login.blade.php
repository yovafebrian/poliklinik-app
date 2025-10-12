<x-layouts.guest>
    <div class="login-box d-flex flex-column justify-content-center align-items-center w-100 vh-100">
        <div class="login-logo">
            <a href="#"><b>P</b>olinik</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Harap login terlebih dahulu!</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                        <p style="color:red">{{ $errors->first() }}</p>
                    @endif
                    <div class="row">
                        <div class="col-8">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </div>
                </form>

                <p class="mb-0">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
                </p>
            </div>
            </div>
    </div>
</x-layouts.guest>