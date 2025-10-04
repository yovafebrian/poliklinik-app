<h2>Register</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

 <form action="{{route('register')}}" method="POST">

    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="nama" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required>
    </div>
    <div>
        <label for="no_hp">No HP:</label>
        <input type="text" id="no_hp" name="no_hp" required>
    </div>
    <div>
        <label for="no_ktp">No KTP:</label>
        <input type="text" id="no_ktp" name="no_ktp" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <button type="submit">Register</button>
 </form>
<p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>