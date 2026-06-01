<h1>Login Berhasil </h1>
<h2>halaman super admin</h2>

<form action="{{ route('logout') }}" method="POST">
    @csrf

    <button type="submit">
        Logout
    </button>
</form>