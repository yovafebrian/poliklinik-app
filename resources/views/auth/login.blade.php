<h2>Ini halaman login</h2>

@if ($errors->any())
    <p style="color: red">{{$errors->first()}}</p>
@endif

<form method="POST" action="{{route('login')}}">
    @csrf
    <label for="">Email :</label>
    <input type="email" name="email" required> <br>

    <label for="">Password</label>
    <input type="password" name="password" required> <br>

    <button type="submit">Login</button>
</form>

<p>Sudah punya akun? <a href="{{ route('register') }}">register di sini</a></p>