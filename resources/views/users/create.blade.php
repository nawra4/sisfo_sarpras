@extends('layouts.main')

@section('title', 'Tambah User Baru')

@section('content')
    <h1>Tambah User Baru</h1>

    <div style="max-width: 600px; margin: 0 auto; background: rgba(255,255,255,0.15); padding: 30px; border-radius: 12px; box-shadow: 0 6px 20px rgba(0,0,0,0.1);">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="" disabled selected>Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="class">Class:</label>
                <select id="class" name="class" required>
                    <option value="" disabled selected>Pilih Kelas</option>
                    <option value="X" {{ old('class') == 'X' ? 'selected' : '' }}>X</option>
                    <option value="XI" {{ old('class') == 'XI' ? 'selected' : '' }}>XI</option>
                    <option value="XII" {{ old('class') == 'XII' ? 'selected' : '' }}>XII</option>
                </select>
                @error('class')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="major">Major:</label>
                <select id="major" name="major" required>
                    <option value="" disabled selected>Pilih Jurusan</option>
                    <option value="RPL" {{ old('major') == 'RPL' ? 'selected' : '' }}>RPL</option>
                    <option value="TJKT" {{ old('major') == 'TJKT' ? 'selected' : '' }}>TJKT</option>
                    <option value="PSPT" {{ old('major') == 'PSPT' ? 'selected' : '' }}>PSPT</option>
                    <option value="ANIMASI" {{ old('major') == 'ANIMASI' ? 'selected' : '' }}>ANIMASI</option>
                    <option value="TE" {{ old('major') == 'TE' ? 'selected' : '' }}>TE</option>
                </select>
                @error('major')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Tambah User</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary" style="width: 100%; margin-top: 10px; background-color: #6c757d;">Batal</a>
        </form>
    </div>
@endsection