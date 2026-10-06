@extends('layouts.pelanggan') @section('title', 'Profil') @section('content') @auth
<div class="my-profile-page">
    {{-- ========================================= HEADER ========================================== --}}
    <div class="my-profile-header">
        <h1>Profil Saya</h1>
        <p>Kelola informasi akun anda</p>
    </div>
    {{-- ========================================= FOTO + IDENTITAS ========================================== --}}
    <div class="my-profile-identity">
        <div class="my-profile-avatar">
            <div class="avatar-head"></div>
            <div class="avatar-body"></div>
        </div>
        <div class="my-profile-name">
            <h3>{{ Auth::user()->nama }}</h3>
            <p>Pelanggan</p>
        </div>
    </div>
    {{-- ========================================= INFORMASI PROFIL ========================================== --}} @if (Auth::user()->pelanggan)
        <div class="my-profile-data">
            {{-- NAMA --}}
            <div class="my-profile-item">
                <div class="my-profile-label">Nama Lengkap</div>
                <div class="my-profile-value">{{ Auth::user()->nama }}</div>
            </div>
            {{-- NO HP --}}
            <div class="my-profile-item">
                <div class="my-profile-label">No. HP</div>
                <div class="my-profile-value">{{ Auth::user()->pelanggan->no_hp }}</div>
            </div>
            {{-- ALAMAT --}}
            <div class="my-profile-item">
                <div class="my-profile-label">Alamat</div>
                <div class="my-profile-value">{{ Auth::user()->pelanggan->alamat }}</div>
            </div>
        </div>
    @else
        <div class="alert alert-warning">Data pelanggan belum tersedia.</div>
    @endif {{-- ========================================= TOMBOL ========================================== --}}
    <div class="my-profile-buttons">
        {{-- EDIT PROFILE --}}
        <button type="button" class="my-profile-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">
            Edit Profile
        </button>
        {{-- LOGOUT --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf <button type="submit" class="my-profile-btn">Log Out</button>
        </form>
    </div>
</div>
{{-- ===================================================== MODAL EDIT PROFILE
====================================================== --}}
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content profile-modal">
            {{-- HEADER MODAL --}}
            <div class="modal-header profile-modal-header">
                <div>
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <p>Perbarui informasi profil Anda.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- FORM --}}
            <form action="{{ route('pelanggan.profil.update') }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-body profile-modal-body">
                    {{-- NAMA --}}
                    <div class="profile-form-group">
                        <label for="edit_nama"> Nama Lengkap </label>
                        <input type="text" id="edit_nama" name="nama"
                            value="{{ old('nama', Auth::user()->nama) }}" required />
                        @error('nama')
                            <small class="profile-error"> {{ $message }} </small>
                        @enderror
                    </div>
                    {{-- NO HP --}}
                    <div class="profile-form-group">
                        <label for="edit_no_hp"> No. HP </label>
                        <input type="text" id="edit_no_hp" name="no_hp"
                            value="{{ old('no_hp', Auth::user()->pelanggan->no_hp ?? '') }}" required />
                        @error('no_hp')
                            <small class="profile-error"> {{ $message }} </small>
                        @enderror
                    </div>
                    {{-- EMAIL --}}
                    <div class="profile-form-group">
                        <label for="edit_email"> Email </label>
                        <input type="email" id="edit_email" name="email"
                            value="{{ old('email', Auth::user()->pelanggan->email ?? '') }}" required />
                        @error('email')
                            <small class="profile-error"> {{ $message }} </small>
                        @enderror
                    </div>
                    {{-- ALAMAT --}}
                    <div class="profile-form-group">
                        <label for="edit_alamat"> Alamat </label>
                        <textarea id="edit_alamat" name="alamat" required>
{{ old('alamat', Auth::user()->pelanggan->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <small class="profile-error"> {{ $message }} </small>
                        @enderror
                    </div>
                </div>
                {{-- FOOTER MODAL --}}
                <div class="modal-footer profile-modal-footer">
                    <button type="button" class="profile-cancel-btn" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="profile-save-btn">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div class="alert alert-light border">Silakan login untuk melihat profil.</div>
@endauth


<style>
/* ========================================= PROFIL PELANGGAN ========================================= */
.my-profile-page {
    width: 100%;
    max-width: 900px;
    padding: 10px 25px 50px;
}

/* ========================================= HEADER ========================================= */
.my-profile-header {
    margin-bottom: 28px;
}

.my-profile-header h1 {
    margin: 0 0 5px 0;
    font-size: 30px;
    font-weight: 800;
    color: #222;
}

.my-profile-header p {
    margin: 0;
    font-size: 16px;
    color: #555;
}

/* ========================================= FOTO + NAMA ========================================= */
.my-profile-identity {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 32px;
}

/* AVATAR */
.my-profile-avatar {
    position: relative;
    width: 120px;
    height: 120px;
    min-width: 120px;
    border: 2px solid #aaa;
    border-radius: 50%;
    background: #fff;
    overflow: hidden;
}

/* KEPALA */
.avatar-head {
    position: absolute;
    width: 42px;
    height: 42px;
    background: #9299a8;
    border-radius: 50%;
    top: 22px;
    left: 37px;
}

/* BADAN */
.avatar-body {
    position: absolute;
    width: 82px;
    height: 45px;
    background: #9299a8;
    border-radius: 50% 50% 0 0;
    left: 19px;
    bottom: -5px;
}

/* NAMA */
.my-profile-name h3 {
    margin: 0 0 2px 0;
    font-size: 20px;
    font-weight: 800;
    color: #222;
}

.my-profile-name p {
    margin: 0;
    font-size: 15px;
    color: #555;
}

/* ========================================= DATA PROFIL ========================================= */
.my-profile-data {
    width: 100%;
    max-width: 430px;
}

.my-profile-item {
    margin-bottom: 18px;
}

.my-profile-label {
    font-size: 15px;
    color: #333;
    margin-bottom: 7px;
}

.my-profile-value {
    width: 100%;
    min-height: 32px;
    padding: 0 0 7px 0;
    border-bottom: 2px solid #b8b8b8;
    font-size: 15px;
    color: #222;
    line-height: 1.5;
    word-break: break-word;
}

/* ========================================= BUTTON ========================================= */
.my-profile-buttons {
    display: flex;
    align-items: center;
    gap: 32px;
    margin-top: 28px;
}

.my-profile-buttons form {
    margin: 0;
    padding: 0;
}

.my-profile-btn {
    width: 125px;
    height: 40px;
    background: #fff;
    border: 1px solid #efc38b;
    border-radius: 4px;
    color: #555;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s ease;
}

.my-profile-btn:hover {
    background: #fff8ee;
    border-color: #e7aa60;
}

/* ========================================= MODAL EDIT PROFILE ========================================= */
.profile-modal {
    border: none;
    border-radius: 14px;
    overflow: hidden;
}

.profile-modal-header {
    padding: 20px 22px;
    border-bottom: 1px solid #eeeeee;
    background: #fff;
}

.profile-modal-header .modal-title {
    margin: 0 0 4px;
    color: #222;
    font-size: 18px;
    font-weight: 750;
}

.profile-modal-header p {
    margin: 0;
    color: #999;
    font-size: 12px;
}

.profile-modal-body {
    padding: 22px;
}

.profile-form-group {
    margin-bottom: 17px;
}

.profile-form-group:last-child {
    margin-bottom: 0;
}

.profile-form-group label {
    display: block;
    margin-bottom: 7px;
    color: #444;
    font-size: 13px;
    font-weight: 600;
}

.profile-form-group input,
.profile-form-group textarea {
    width: 100%;
    padding: 10px 12px;
    background: #fafafa;
    border: 1px solid #e3e3e3;
    border-radius: 7px;
    outline: none;
    color: #333;
    font-size: 13px;
    transition: 0.2s ease;
}

.profile-form-group input {
    height: 42px;
}

.profile-form-group textarea {
    min-height: 85px;
    resize: vertical;
}

.profile-form-group input:focus,
.profile-form-group textarea:focus {
    background: #fff;
    border-color: #f6c344;
    box-shadow: 0 0 0 3px rgba(246, 195, 68, 0.12);
}

/* ERROR */
.profile-error {
    display: block;
    margin-top: 5px;
    color: #d9534f;
    font-size: 11px;
}

/* ========================================= MODAL FOOTER ========================================= */
.profile-modal-footer {
    padding: 16px 22px;
    border-top: 1px solid #eeeeee;
    background: #fff;
    gap: 8px;
}

.profile-cancel-btn,
.profile-save-btn {
    height: 40px;
    padding: 8px 18px;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s ease;
}

.profile-cancel-btn {
    background: #fff;
    border: 1px solid #dddddd;
    color: #666;
}

.profile-cancel-btn:hover {
    background: #f7f7f7;
}

.profile-save-btn {
    background: #f6c344;
    border: 1px solid #f6c344;
    color: #222;
}

.profile-save-btn:hover {
    background: #eab52f;
    border-color: #eab52f;
    transform: translateY(-1px);
}

/* ========================================= RESPONSIVE ========================================= */
@media (max-width: 768px) {
    .my-profile-page {
        padding: 10px 5px 40px;
    }

    .my-profile-header h1 {
        font-size: 26px;
    }

    .my-profile-header p {
        font-size: 14px;
    }

    .my-profile-identity {
        gap: 15px;
    }

    .my-profile-avatar {
        width: 95px;
        height: 95px;
        min-width: 95px;
    }

    .avatar-head {
        width: 34px;
        height: 34px;
        top: 18px;
        left: 29px;
    }

    .avatar-body {
        width: 65px;
        height: 36px;
        left: 14px;
    }

    .my-profile-name h3 {
        font-size: 18px;
    }

    .my-profile-data {
        max-width: 100%;
    }

    .my-profile-buttons {
        gap: 15px;
    }

    .my-profile-btn {
        width: 115px;
    }
}
</style> @endsection
