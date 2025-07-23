@extends('layouts.volt')

@section('title', 'Daftar')

@section('content')
<main class="d-flex h-100 text-center text-bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-2 mx-auto flex-column">
        <section class="mt-1 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image" data-background-lg="{{ asset('volt/assets/img/illustrations/signin.svg') }}">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Buat Akun</h1>
                            </div>
                            <form method="POST" action="{{ route('register') }}" class="mt-4">
                                @csrf

                                <div class="form-group mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                                        </span>
                                        <input id="nama_pelanggan" type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" required autofocus placeholder="Nama">
                                    </div>
                                    @error('nama_pelanggan')
                                        <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path></svg>
                                        </span>
                                        <input id="nama_perusahaan" type="text" class="form-control" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" placeholder="Nama Perusahaan">
                                    </div>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon4">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path></svg>
                                        </span>
                                        <input id="telp_pelanggan" type="text" class="form-control" name="telp_pelanggan" value="{{ old('telp_pelanggan') }}" placeholder="Nomor Telepon">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon5">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                                        </span>
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username" required>
                                    </div>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                                        </span>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>
                                

                                <div class="form-group mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon5">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                        </span>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Kata Sandi">
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon6">
                                           <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                                        </span>
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required placeholder="Konfirmasi Kata Sandi">
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gray-800">Buat Akun</button>
                                </div>
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
        </section>
    </div>
</main>
@endsection

