@extends('layouts.page')

@section('title', 'Detail Ticket')

@section('css')
<style>
    .ticket-progress ul {
    list-style-type: none;
    padding-left: 0;
    position: relative;
}

.ticket-progress li {
    padding-left: 40px;
    position: relative;
    padding-bottom: 20px;
}

.ticket-progress li::before {
    content: '';
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #ccc;
    position: absolute;
    left: 0;
    top: 0;
    z-index: 1;
}

.ticket-progress li::after {
    content: '';
    width: 2px;
    height: 100%;
    background-color: #ccc;
    position: absolute;
    left: 9px;
    top: 0;
}

.ticket-progress li.completed::before {
    background-color: #28a745; 
}

.ticket-progress li.active::before {
    background-color: #007bff; 
}

.ticket-progress li.completed::after {
    background-color: #28a745;
}

.ticket-progress li:last-child::after {
    display: none;
}

.step-label {
    font-weight: bold;
}

.step-info {
    font-size: 0.9em;
    color: #666;
}
</style>
@endsection

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Rincian Pesanan</h3>
    </div>
    <div class="card-body">
        <div class="ticket-progress">
            @php
                $statuses = ['Ticket Created', 'Ticket Received', 'In Progress', 'Done'];
            @endphp
            <ul>
                @foreach ($statuses as $status)
                <li class="
                    @if ($loop->iteration < $pesanan->progres)
                        completed
                    @elseif ($loop->iteration == $pesanan->progres)
                        active
                    @endif
                        ">
                        <div class="step-label">{{ $status }}</div>
                        <div class="step-info">
                            @switch($status)
                                @case('Ticket Created')
                                    Pesanan telah dibuat.
                                    @break
                                @case('Ticket Received')
                                    Pesanan telah diterima.
                                    @break
                                @case('In Progress')
                                    Pesanan sedang diproses.
                                    @break
                                @case('Done')
                                    Pesanan telah selesai.
                                    @break
                            @endswitch
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Barang</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama_barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @forelse ($pesanan_barang as $barang)
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$barang->barang->nama_barang}}</td>
                                    <td>{{$barang->barang->harga_jual}}</td>
                                    <td>{{$barang->jumlah}}</td>
                                    <td>{{$barang->subtotal}}</td>
                                @empty
                                    <td colspan="5" class="text-center">Data Kosong</td>
                                @endforelse
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Jasa</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0 rounded">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama_jasa</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @forelse ($pesanan_jasa as $jasa)
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$jasa->jasa->nama_jasa}}</td>
                                    <td>{{$jasa->jasa->harga_jasa}}</td>
                                    <td>{{$jasa->jumlah}}</td>
                                    <td>{{$jasa->subtotal}}</td>
                                @empty
                                    <td colspan="5" class="text-center">Data Kosong</td>
                                @endforelse
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

