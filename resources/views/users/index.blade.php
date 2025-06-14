@extends('layouts.main')

@section('title', 'Daftar User')

@section('content')
    <h1>Daftar User</h1>

    <a href="{{ route('users.create') }}" class="btn btn-success" style="margin-bottom: 20px; display: inline-block;">Tambah User</a>

    <table>
        <thead>
            <tr>
                <th>ID User</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Class</th>
                <th>Major</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->users_id }}</td> {{-- Asumsi kolom ID di tabel users adalah 'users_id' --}}
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td style="text-transform: capitalize;">{{ $user->role }}</td>
                    <td>{{ $user->class }}</td>
                    <td>{{ $user->major }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->users_id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('users.destroy', $user->users_id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin hapus user ini? Ini akan menghapus semua data terkait user ini.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center; color: #ccc;">Data user tidak tersedia</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection