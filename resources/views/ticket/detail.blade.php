@extends('layouts.page')

@section('title', 'Detail Pesanan')

@section('css')
<style>
    .ticket-progress ul {
        display: flex;
        list-style-type: none;
        padding-left: 0;
        position: relative;
    }

    .ticket-progress li {
        flex: 1;
        position: relative;
        text-align: center;
        padding-top: 40px;
    }

    .ticket-progress li::before {
        content: '';
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: #ccc;
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
    }

    .ticket-progress li::after {
        content: '';
        width: 100%;
        height: 2px;
        background-color: #ccc;
        position: absolute;
        top: 9px;
        left: -50%;
        z-index: 1;
    }

    .ticket-progress li:first-child::after {
        content: none;
    }

    .ticket-progress li.completed::before {
        background-color: #28a745;
    }

    .ticket-progress li.completed::after {
        background-color: #28a745;
    }

    .ticket-progress li.active::before {
        background-color: #007bff;
    }

    .ticket-progress li.active::after {
        background-color: #007bff;
    }

    .step-label {
        font-weight: bold;
    }

    .step-info {
        font-size: 0.9em;
        color: #666;
        padding: 5px 10px;
    }
</style>
@endsection

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h3 class="card-title">Rincian Pesanan</h3>
    </div>
    <div class="card-body">
        @if ($pesanan->status == 2)
            <div class="alert alert-danger">
                Pesanan telah dibatalkan.
            </div>
        @else
        <div class="ticket-progress">
            @php
                $statuses = ['Pesanan Dibuat', 'Pesanan Diterima', 'Pesanan Diproses', 'Selesai'];
            @endphp
            <ul>
                @if ($pesanan->status == 2)
                    <li class="completed">
                        <div class="step-label">Batal</div>
                        <div class="step-info">Pesanan telah dibatalkan.</div>
                    </li>
                @else
                    @foreach ($statuses as $status)
                <li class="
                    @if ($loop->iteration < $pesanan->progres || $pesanan->status == 1)
                        completed
                    @elseif ($loop->iteration == $pesanan->progres)
                        active
                    @endif
                        ">
                        <div class="step-label">{{ $status }}</div>
                        <div class="step-info">
                            @switch($status)
                                @case('Pesanan Dibuat')
                                    Pesanan telah dibuat oleh @if ($pesanan->kd_karyawan == null) {{$pesanan->dibuat_oleh}} @else Staff @endif pada tanggal {{ $pesanan->created_at->format('d M Y') }}
                                    @break
                                @case('Pesanan Diterima')
                                    @if ($pesanan->progres >= 2) Pesanan telah diterima oleh Petugas pada tanggal {{ $pesanan->updated_at->format('d M Y') }}.
                                    @else Pesanan telah diterima.
                                    @endif
                                    @break
                                @case('Pesanan Diproses')
                                    @if ($pesanan->progres >= 3)
                                        Pesanan sedang diproses, <a href="{{ route('ticket.progress', $pesanan->kd_pesanan) }}">Lihat Progress</a>.
                                    @else
                                        Pesanan sedang diproses.
                                    @endif
                                    @break
                                @case('Selesai')
                                    Pesanan telah selesai.
                                    @break
                            @endswitch
                        </div>
                    </li>
                    @endforeach
                @endif
            </ul>
        </div>
        @endif
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
                                <th>Nama Barang</th>
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
                                    <td>{{$barang->barang->harga}}</td>
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
                                <th>Nama Jasa</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @forelse ($pesanan_jasa as $jasa)
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$jasa->nama_jasa}}</td>
                                    <td>{{$jasa->harga_jasa}}</td>
                                    <td>{{$jasa->jumlah}}</td>
                                    <td>{{number_format($jasa->subtotal, 2, ',', '.')}}</td>
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

<div class="row mb-3">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Subtotal</h3>
            </div>
            <div class="card-body">
                <p class="mb-0">
                    <span class="font-weight-bold">Subtotal Barang:</span> Rp. {{ number_format($pesanan_barang->sum('subtotal'), 2, ',', '.') }}<br>
                    <span class="font-weight-bold">Subtotal Jasa:</span> Rp. {{ number_format($pesanan_jasa->sum('subtotal'), 2, ',', '.') }}<br>
                    <span class="font-weight-bold">Total:</span> Rp. {{ number_format($pesanan_jasa->sum('subtotal') + $pesanan_barang->sum('subtotal'), 2, ',', '.') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

