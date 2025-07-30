@extends('layouts.page')

@section('title', 'My Profile')

@section('css')
<style>
    .profile-pic-container {
        position: relative;
        width: 100px;
        height: 100px;
        margin: 0 auto;
        border-radius: 50%;
    }

    .profile-user-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }

    .profile-pic-container .upload-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s ease;
        cursor: pointer;
    }

    .profile-pic-container:hover .upload-overlay {
        opacity: 1;
    }

    .upload-overlay span {
        font-size: 0.8rem;
        margin-top: 5px;
    }

    .form-control[readonly] {
        background-color: transparent;
        border: 0;
        box-shadow: none;
        padding-left: 0;
        cursor: default;
    }
    
    .form-control:not([readonly]) {
        background-color: #fff;
        border: 1px solid #ced4da;
    }

    .toggle-password-icon {
        cursor: pointer;
    }
</style>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mt-3 mb-3">
            <div class="card-header">
                <h3 class="card-title">Informasi Personal</h3>
                <div class="card-tools">
                    <button type="button" id="tombol-edit-personal" class="btn btn-sm btn-warning">Edit</button>
                    <button type="submit" form="personal-update-form" id="tombol-simpan-personal" class="btn btn-sm btn-success" style="display: none;">Simpan</button>
                    <button type="button" id="tombol-batal-personal" class="btn btn-sm btn-secondary" style="display: none;">Batal</button>
                </div>
            </div>
            <div class="card-body">
                <form id="personal-update-form" action="{{ route('profile.update.personal') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_pelanggan" value="{{ $user->nama_pelanggan ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Nama Perusahaan <sub class="text-muted">(Opsional)</sub></label>
                            <input type="text" class="form-control" name="nama_perusahaan" value="{{ $user->nama_perusahaan ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="{{ $user->username ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>NIK <sub class="text-muted">(Opsional)</sub></label>
                            <input type="text" class="form-control" name="nik" value="{{ $user->nik ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat_pelanggan" value="{{ $user->alamat_pelanggan ?? '-' }}" readonly>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3 mb-3">
            <div class="card-header">
                <h3 class="card-title">Ganti Password</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('ganti-password') }}" method="POST">
                    @csrf
                        <div class="col-md-4 form-group mb-3">
                            <label>Password Lama</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password_lama') is-invalid @enderror" name="password_lama" required autocomplete="current-password">
                                <span class="input-group-text toggle-password-icon"><i class="fas fa-eye"></i></span>
                            </div>
                            @error('password_lama')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label>Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <span class="input-group-text toggle-password-icon"><i class="fas fa-eye"></i></span>
                            </div>
                            @error('password')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label>Konfirmasi Password Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <span class="input-group-text toggle-password-icon"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Ganti Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card col-md-12 mt-3 mb-3 card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <form id="photo-upload-form" action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data" class="d-none">
                        @csrf
                        <input type="file" name="foto" id="foto-upload" accept="image/*">
                    </form>
                    <div class="profile-pic-container" id="profile-pic-trigger">
                        <img class="profile-user-img img-fluid rounded-circle" id="profile-pic-preview" src="{{ $user->foto ? Storage::url($user->foto) : asset('default.png') }}" alt="User profile picture">
                        <div class="upload-overlay">
                            <i class="fas fa-camera"></i>
                            <span>Ganti Foto</span>
                        </div>
                    </div>
                </div>
                <h3 class="profile-username text-center mt-3 mb-0">{{ $user->username }}</h3>
                <p class="text-muted text-center" style="font-size: 0.9rem;">{{ $user->alamat_pelanggan }}</p>
            </div>
        </div>
        
        <div class="card mt-3 mb-3">
            <div class="card-header">
                <h3 class="card-title">Kontak</h3>
                <div class="card-tools">
                    <button type="button" id="tombol-edit-kontak" class="btn btn-sm btn-warning">Edit</button>
                    <button type="submit" form="kontak-update-form" id="tombol-simpan-kontak" class="btn btn-sm btn-success" style="display: none;">Simpan</button>
                    <button type="button" id="tombol-batal-kontak" class="btn btn-sm btn-secondary" style="display: none;">Batal</button>
                </div>
            </div>
            <div class="card-body">
                <form id="kontak-update-form" action="{{ route('profile.update.kontak') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nomor Telepon</label>
                        <input type="text" class="form-control" name="telp_pelanggan" value="{{ $user->telp_pelanggan ?? '-' }}" readonly>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        setupEditToggle(
            '#tombol-edit-personal', 
            '#tombol-simpan-personal', 
            '#tombol-batal-personal', 
            '#personal-update-form'
        );
        setupFormSubmission('#personal-update-form', 'Informasi personal berhasil diperbarui.');

        setupEditToggle(
            '#tombol-edit-kontak', 
            '#tombol-simpan-kontak', 
            '#tombol-batal-kontak', 
            '#kontak-update-form'
        );
        setupFormSubmission('#kontak-update-form', 'Informasi kontak berhasil diperbarui.');


        function setupEditToggle(editBtn, saveBtn, cancelBtn, formId) {
            const formInputs = $(formId + ' input');
            const originalValues = {};

            $(editBtn).on('click', function () {
                formInputs.each(function() {
                    originalValues[$(this).attr('name')] = $(this).val();
                });
                
                formInputs.removeAttr('readonly').removeClass('form-control-plaintext');
                $(editBtn).hide();
                $(saveBtn + ', ' + cancelBtn).show();
            });

            $(cancelBtn).on('click', function () {
                formInputs.each(function() {
                    $(this).val(originalValues[$(this).attr('name')]);
                });

                formInputs.attr('readonly', true).addClass('form-control-plaintext');
                $(editBtn).show();
                $(saveBtn + ', ' + cancelBtn).hide();
            });
        }

        function setupFormSubmission(formId, successMessage) {
            $(formId).on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        Swal.fire({
                            title: 'Sukses!',
                            text: successMessage,
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = 'Update gagal, silahkan periksa kembali data Anda.';
                        if (errors) {
                            errorMsg = Object.values(errors).map(e => e[0]).join('<br>');
                        }
                        Swal.fire('Error', errorMsg, 'error');
                    }
                });
            });
        }

        $('.toggle-password-icon').on('click', function () {
            const icon = $(this).find('i');
            const passwordInput = $(this).closest('.input-group').find('input');
            const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
            passwordInput.attr('type', type);
            icon.toggleClass('fa-eye fa-eye-slash');
        });

        $('#profile-pic-trigger').on('click', function () {
            $('#foto-upload').click();
        });

        $('#foto-upload').on('change', function () {
            let formData = new FormData($('#photo-upload-form')[0]);
            $.ajax({
                url: "{{ route('profile.update.photo') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.fire({
                        title: 'Sukses!',
                        text: response.success,
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    let errorMsg = (xhr.responseJSON?.errors?.foto)
                        ? xhr.responseJSON.errors.foto[0]
                        : 'Gambar gagal diupload.';
                    Swal.fire('Error', errorMsg, 'error');
                }
            });
        });
    });
</script>
@include('partials.toast')
@stop
