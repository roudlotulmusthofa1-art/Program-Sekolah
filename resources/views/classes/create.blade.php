@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-6">
        Tambah Kelas
    </h1>

    <form action="{{ route('classes.store') }}" method="POST">

        @csrf

        <div class="mb-4">

            <label>Nama Kelas</label>

            <input
                type="text"
                name="name"
                placeholder="Contoh: 7A"
                class="w-full border rounded-lg p-3"
            >

        </div>

        <div class="mb-4">

            <label>Wali Kelas</label>

            <select
                name="teacher_id"
                class="w-full border rounded-lg p-3"
            >

                @foreach($teachers as $teacher)

                    <option value="{{ $teacher->id }}">

                        {{ $teacher->user->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <button
            class="bg-blue-500 text-white px-6 py-3 rounded-lg"
        >
            Simpan
        </button>

    </form>

</div>

@endsection