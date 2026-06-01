<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <input type="email" name="email" placeholder="Masukkan email">

    <button type="submit">
        Kirim Link Reset Password
    </button>
</form>