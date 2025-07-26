@extends('layouts.volt')

@section('title', 'Daftar Akun')

@section('css')
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .form-step {
        display: none;
    }

    .form-step.active {
        display: block;
    }
</style>
@endsection

@section('content')
<main class="d-flex align-items-center bg-soft py-4" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100" style="max-width: 600px;">
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h3">Buat Akun Baru</h1>
                    </div>

                    <form method="POST" action="{{ route('register') }}" id="multi-step-form" class="mt-4" novalidate>
                        @csrf

                        <fieldset class="form-step active" data-step="1">
                            <h5 class="mb-4">Informasi Akun</h5>
                            <div class="row">
                                <div class="form-group mb-4 col-md-6">
                                    <label for="nama_pelanggan">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><svg class="icon icon-xs" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                            </svg></span>
                                        <input id="nama_pelanggan" type="text" placeholder="Nama Lengkap"
                                            class="form-control @error('nama_pelanggan') is-invalid @enderror"
                                            name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" required
                                            autofocus>
                                    </div>
                                    @error('nama_pelanggan')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4 col-md-6">
                                    <label for="nama_perusahaan">Nama Perusahaan (Opsional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><svg class="icon icon-xs" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                                                    clip-rule="evenodd"></path>
                                            </svg></span>
                                        <input id="nama_perusahaan" type="text" placeholder="Nama Perusahaan"
                                            class="form-control" name="nama_perusahaan"
                                            value="{{ old('nama_perusahaan') }}">
                                    </div>
                                </div>
                                <div class="form-group mb-4 col-12">
                                    <label for="alamat_pelanggan">Alamat</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><svg class="icon icon-xs" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                    clip-rule="evenodd"></path>
                                            </svg></span>
                                        <input id="alamat_pelanggan" type="text" placeholder="Alamat"
                                            class="form-control @error('alamat_pelanggan') is-invalid @enderror"
                                            name="alamat_pelanggan" value="{{ old('alamat_pelanggan') }}" required>
                                    </div>
                                    @error('alamat_pelanggan')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4 col-12">
                                    <label for="telp_pelanggan">Nomor Telepon</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><svg class="icon icon-xs" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z">
                                                </path>
                                            </svg></span>
                                        <input id="telp_pelanggan" type="number" placeholder="Nomor Telepon"
                                            class="form-control @error('telp_pelanggan') is-invalid @enderror"
                                            name="telp_pelanggan" value="{{ old('telp_pelanggan') }}" required>
                                    </div>
                                    @error('telp_pelanggan')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="button" class="btn btn-primary" id="nextButton">Selanjutnya</button>
                            </div>
                        </fieldset>

                        <fieldset class="form-step" data-step="2">
                            <h5 class="mb-4">Detail Akun</h5>
                            <div class="row">
                                <div class="form-group mb-4 col-md-6">
                                    <label for="username">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><svg class="icon icon-xs" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                            </svg></span>
                                        <input id="username" type="text" placeholder="Username"
                                            class="form-control @error('username') is-invalid @enderror" name="username"
                                            value="{{ old('username') }}" required>
                                    </div>
                                    @error('username')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4 col-md-6">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><svg class="icon icon-xs" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                                </path>
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                                </path>
                                            </svg></span>
                                        <input id="email" type="email" placeholder="Email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4 col-md-12">
                                    <label for="password">Kata Sandi</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><svg class="icon icon-xs" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg></span>
                                        <input id="password" type="password" placeholder="Kata Sandi"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4 col-md-12">
                                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><svg class="icon icon-xs" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg></span>
                                        <input id="password_confirmation" type="password"
                                            placeholder="Konfirmasi Kata Sandi" class="form-control"
                                            name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-">
                                <button type="button" id="prevButton"
                                    class="btn btn-secondary col-md-6">Kembali</button>
                                <button type="submit" class="btn btn-gray-800 col-md-6">Buat Akun</button>
                            </div>
                        </fieldset>
                    </form>

                    <div class="d-flex justify-content-center align-items-center mt-4">
                        <span class="fw-normal">
                            Sudah memiliki akun?
                            <a href="{{ route('login') }}" class="fw-bold">Masuk disini</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script>
    $(document).ready(function () {

        $('#nextButton').on('click', function () {
            const currentStep = $('.form-step.active');
            const nextStepElement = currentStep.next('.form-step');
            let isValid = true;

            // Find all required inputs in the current step
            currentStep.find('input[required]').each(function() {
                // If the input is empty...
                if ($(this).val().trim() === '') {
                    isValid = false; // Mark form as invalid
                    $(this).addClass('is-invalid'); // Show Bootstrap's invalid feedback
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (isValid && nextStepElement.length) {
                currentStep.removeClass('active');
                nextStepElement.addClass('active');
            }
        });

        $('#prevButton').on('click', function () {
            const currentStep = $('.form-step.active');
            const prevStepElement = currentStep.prev('.form-step');

            currentStep.find('input.is-invalid').removeClass('is-invalid');

            if (prevStepElement.length) {
                currentStep.removeClass('active');
                prevStepElement.addClass('active');
            }
        });

    });
</script>
@endsection