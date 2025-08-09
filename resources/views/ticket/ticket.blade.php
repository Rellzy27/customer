@extends('layouts.page')

@section('title', 'Pesanan')

@section('content')
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title">Edit ticket.</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="deskripsi_pesanan">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi_pesanan" name="deskripsi_pesanan" rows="4"
                            required>{{old('deskripsi_pesanan')}}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="appointment_date">Tanggal Janji Temu</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <input class="form-control" id="appointment_date" name="tanggal" type="text"
                                placeholder="dd/mm/yyyy" autocomplete="off" value="{{old('tanggal')}}" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editForm" class="btn btn-sm btn-primary">Edit</button>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Riwayat Pesanan</h3>
                <div class="card-tools">
                    <a href="{{route('ticket.create')}}" class="btn btn-primary">
                        <svg class="icon icon-xs me-1" fill="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5v14m7-7H5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Buat Pesanan
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th>Deskripsi</th>
                                <th width="15%">Tanggal Janji Temu</th>
                                <th width="15%">Status</th>
                                <th width="10px">#</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesanan as $ticket)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$ticket->deskripsi_pesanan}}</td>
                                    <td>{{$ticket->tanggal}}</td>
                                    <td class="text-center">
                                        @if ($ticket->status == 1)
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif ($ticket->status == 0 && $ticket->progres == 1)
                                            <span class="badge bg-info">Pesanan Dibuat</span>
                                        @elseif ($ticket->status == 0 && $ticket->progres == 2)
                                            <span class="badge bg-warning">Pesanan Diterima</span>
                                        @elseif ($ticket->status == 0 && $ticket->progres == 3)
                                            <span class="badge bg-secondary">Pesanan Diproses</span>
                                        @elseif ($ticket->status == 2)
                                            <span class="badge bg-danger">Batal</span>
                                        @endif
                                    </td>
                                    <td>{{$ticket->kd_pesanan}}</td>
                                    <td class="text-center">
                                        <a href="{{route('ticket.detail', $ticket->kd_pesanan)}}" class="btn btn-info">
                                            <svg class="icon icon-xs text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </a>
                                        @if ($ticket->status != 2 && $ticket->progres != 3 && $ticket->progres != 4 && \Carbon\Carbon::now()->diffInHours($ticket->created_at) < 24)
                                            <button type="button" class="btn btn-primary tombol-edit" data-bs-toggle="modal"
                                                data-bs-target="#editModal" data-id="{{$ticket->kd_pesanan}}"
                                                data-deskripsi="{{$ticket->deskripsi_pesanan}}"
                                                data-tanggal="{{$ticket->tanggal}}">
                                                <svg class="icon icon-xs text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button type="button" href="#" class="btn btn-danger"
                                                onclick="confirmCancel({{$ticket->kd_pesanan}})">
                                                <svg class="icon icon-xs text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <td colspan="5" class="text-center">Data Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('.tombol-edit').on('click', function () {
        const id = $(this).data('id');
        const deskripsi = $(this).data('deskripsi');
        const tanggal = $(this).data('tanggal');

        $('#deskripsi_pesanan').val(deskripsi);
        $('#appointment_date').val(tanggal);

        $('#editForm').attr('action', "{{route('ticket.edit', ':id')}}".replace(':id', id));
    })
    document.addEventListener("DOMContentLoaded", function () {
        const datepickerEl = document.getElementById('appointment_date');
        if (datepickerEl) {
            new Datepicker(datepickerEl, {
                format: 'dd/mm/yyyy',
                autohide: true,
            });
        }
    });
    function confirmCancel($ticket) {
        Swal.fire({
            title: 'Batalkan Pesanan?',
            text: "Pesanan akan dibatalkan?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{route('ticket.cancel', ':id')}}".replace(':id', $ticket);
            }
        });
    }

</script>

@include('partials.toast')
@endsection