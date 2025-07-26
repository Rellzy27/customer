@extends('layouts.volt')

@section('title', __('Service Unavailable'))

@section('content')
    <main>
        <section class="vh-100 d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row align-items-center ">
                    <div class="col-12 col-lg-7 order-1 order-lg-1 text-center d-flex align-items-center justify-content-center">
                        <img class="img-fluid w-75" src="{{ asset('volt/assets/img/illustrations/503.svg')}}" alt="503 Service Unavailable">
                    </div>
                    <div class="col-12 col-lg-5 order-2 order-lg-2 text-center text-lg-left">
                        <h1 class="mt-5">We're currently performing maintenance</h1>
                        <p class="lead my-4">We should be back shortly. Thanks for your patience.</p>
                        <a href="" onclick="location.reload();" class="btn btn-gray-800 d-inline-flex align-items-center justify-content-center mb-4">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                            Try again
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

