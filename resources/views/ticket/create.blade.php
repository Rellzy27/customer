@extends('layouts.page')

@section('title', 'Create Ticket')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Create Ticket</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('ticket.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $user->nama_pelanggan }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_pesanan">deskripsi_pesanan</label>
                        <textarea class="form-control" id="deskripsi_pesanan" name="deskripsi_pesanan" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="appointment_date">Appointment Date</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <input data-datepicker="" class="form-control" id="appointment_date" name="tanggal" type="text"
                                placeholder="dd/mm/yyyy" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @endsection