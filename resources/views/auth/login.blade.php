@extends('layouts.volt')

@section('title', 'Masuk')

@section('content')
<main class="d-flex align-items-center bg-soft py-4" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 order-2 order-lg-1 text-center d-flex align-items-center justify-content-center d-none d-lg-block">
                <img class="img-fluid w-75" src="{{ asset('volt/assets/img/illustrations/Login.svg')}}" alt="Login Illustration">
            </div>
            <div class="col-12 col-lg-6 order-1 order-lg-2">
                <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5">
                    <div class="text-center text-md-center mb-4 mt-md-0">
                        <h1 class="mb-0 h3">Masuk ke Akun Anda</h1>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="mt-4">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="login">Email / Username / No. Telepon</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg></span>
                                <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autofocus placeholder="Email, Username, atau No. Telepon">
                            </div>
                        @error('login')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <div class="form-group mb-4">
                                <label for="password">Kata Sandi</label>
                                <div class="input-group">
                                    <span class="input-group-text"><svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg></span>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Kata Sandi">
                                </div>
                        @error('password')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-top mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label mb-0" for="remember">
                                  Ingat saya
                                </label>
                            </div>
                            <div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="small text-right">Lupa kata sandi?</a>
                                @endif
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-gray-800">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

