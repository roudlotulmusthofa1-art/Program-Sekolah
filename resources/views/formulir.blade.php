<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Register</title>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">

    <h1 class="text-2xl font-bold text-center mb-6">
        Daftar Akun
    </h1>
    <form action="{{ route('register') }}" method="POST">
        @csrf 

        <input type="text"
            name="name"
            placeholder="Nama"
            class="w-full border p-3 rounded-lg mb-4">

        <input type="email"
            name="email"
            placeholder="Email"
            class="w-full border p-3 rounded-lg mb-4">

        <input type="password"
            name="password"
            placeholder="Password"
            class="w-full border p-3 rounded-lg mb-4">

        <button type="submit"
            class="w-full bg-blue-600 text-white p-3 rounded-lg">
            Daftar
        </button>
    </form>

    <p class="text-center mt-4">
        Sudah punya akun?
        <a href="{{ route('login') }}"
            class="text-blue-600">
            Login
        </a>
    </p>

</div>

</body>
</html>
