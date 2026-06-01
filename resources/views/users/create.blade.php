@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-6">
        Tambah User
    </h1>

    <form action="{{ route('users.store') }}" method="POST">

        @csrf

        <div class="mb-4">
            <label>Nama</label>

            <input
                type="text"
                name="name"
                class="w-full border rounded-lg p-3"
            >
        </div>

        <div class="mb-4">
            <label>Email</label>

            <input
                type="email"
                name="email"
                class="w-full border rounded-lg p-3"
            >
        </div>

        <div class="mb-4">
            <label>Password</label>

            <input
                type="password"
                name="password"
                class="w-full border rounded-lg p-3"
            >
        </div>

        <div class="mb-4">
            <label>Role</label>

            <select
                name="role"
                class="w-full border rounded-lg p-3"
            >
                <option value="tu">TU</option>
                <option value="bendahara">Bendahara</option>
                <option value="guru">Guru</option>
                <option value="wali_kelas">Wali Kelas</option>
                <option value="wali_santri">Wali Santri</option>
            </select>
        </div>

        <button
            type="submit"
            class="bg-blue-500 text-white px-6 py-3 rounded-lg"
        >
            Simpan
        </button>

    </form>

</div>

@endsection