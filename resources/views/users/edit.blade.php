@extends('layouts.main')

@section('title', 'Edit User')

@section('content')
    <h1>Edit User: {{ $user->username }}</h1>

    <div style="max-width: 600px; margin: 0 auto; background: rgba(255,255,255,0.15); padding: 30px; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.1);">
        <form action="{{ route('users.update', $user->users_id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Penting untuk metode update --}}

            <div style="margin-bottom: 20px;">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password">Password (kosongkan jika tidak ingin mengubah):</label>
                <input type="password" id="password" name="password">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="class">Class:</label>
                <select id="class" name="class" required>
                    <option value="X" {{ old('class', $user->class) == 'X' ? 'selected' : '' }}>X</option>
                    <option value="XI" {{ old('class', $user->class) == 'XI' ? 'selected' : '' }}>XI</option>
                    <option value="XII" {{ old('class', $user->class) == 'XII' ? 'selected' : '' }}>XII</option>
                </select>
                @error('class')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="major">Major:</label>
                <select id="major" name="major" required>
                    <option value="RPL" {{ old('major', $user->major) == 'RPL' ? 'selected' : '' }}>RPL</option>
                    <option value="TJKT" {{ old('major', $user->major) == 'TJKT' ? 'selected' : '' }}>TJKT</option>
                    <option value="PSPT" {{ old('major', $user->major) == 'PSPT' ? 'selected' : '' }}>PSPT</option>
                    <option value="ANIMASI" {{ old('major', $user->major) == 'ANIMASI' ? 'selected' : '' }}>ANIMASI</option>
                    <option value="TE" {{ old('major', $user->major) == 'TE' ? 'selected' : '' }}>TE</option>
                </select>
                @error('major')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Update User</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary" style="width: 100%; margin-top: 10px; background-color: #6c757d;">Batal</a>
        </form>
    </div>
@endsection