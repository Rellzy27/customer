@extends('layouts.volt')

@section('title', __('Unauthorized'))

@section('content')
    <main>
        <section class="vh-100 d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row align-items-center ">
                    <div class="col-12 col-lg-7 order-1 order-lg-1 text-center d-flex align-items-center justify-content-center">
                        <img class="img-fluid w-75" src="{{ asset('volt/assets/img/illustrations/401.svg')}}" alt="401 Unauthorized">
                    </div>
                    <div class="col-12 col-lg-5 order-2 order-lg-2 text-center text-lg-left">
                        <h1 class="mt-5">You need to login to access this resource</h1>
                        <p class="lead my-4">Please login to continue.</p>
                        <a href="/" class="btn btn-gray-800 d-inline-flex align-items-center justify-content-center mb-4">
                            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                            Back to homepage
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

