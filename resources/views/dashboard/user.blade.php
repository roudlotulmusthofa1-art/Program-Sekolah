<h1>Login Berhasil </h1>
<h2>halaman user</h2>

<form action="{{ route('logout') }}" method="POST">
    @csrf

    <button type="submit">
        Logout
    </button>
</form>