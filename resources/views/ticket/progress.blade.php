@extends('layouts.page')

@section('title', 'Detail Progress Pesanan')

@section('css')
<style>
    .timeline {
        position: relative;
        padding: 20px 0;
        list-style: none;
    }

    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 40px;
        width: 2px;
        background-color: #e9ecef;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 20px;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-icon {
        position: absolute;
        left: 40px;
        top: 0;
        transform: translateX(-50%);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #adb5bd;
        /* Default color */
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        z-index: 1;
    }

    .timeline-item.success .timeline-icon {
        background-color: #28a745;    }

    .timeline-item.info .timeline-icon {
        background-color: #17a2b8;
    }

    .timeline-item.warning .timeline-icon {
        background-color: #ffc107;
    }

    .timeline-content {
        margin-left: 75px;
        background-color: #f8f9fa;
        border-radius: 6px;
        padding: 15px;
        position: relative;
    }

    .timeline-content:before {
        content: ' ';
        height: 0;
        position: absolute;
        top: 15px;
        right: 100%;
        width: 0;
        border: medium solid #f8f9fa;
        border-width: 10px 10px 10px 0;
        border-color: transparent #f8f9fa transparent transparent;
    }

    .timeline-time {
        font-size: 0.85rem;
        color: #6c757d;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Progress Pesanan #{{ $pesanan->kd_pesanan ?? 'N/A' }}</h3>
                <div class="card-tools float-end">
                    <a href="{{ route('ticket.detail', $pesanan) }}" class="btn btn-primary">
                        <svg class="icon icon-xs me-1" fill="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                            <path
                                d="M6.707 5.293a1 1 0 010 1.414L4.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <ul class="timeline">
                    @forelse ($progress as $progress)
                        <li
                            class="timeline-item 
                                        @if(Str::contains(strtolower($progress->keterangan), 'selesai')) success @else info @endif">
                            <div class="timeline-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <div class="timeline-content">
                                <p class="font-weight-bold mb-1">Update dari {{ $progress->dibuat_oleh }}</p>
                                <p class="mb-1">{{ $progress->keterangan }}</p>
                                <span class="timeline-time">{{ $progress->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </li>
                    @empty
                        <li class="timeline-item warning">
                            <div class="timeline-icon">
                                <i class="fas fa-hourglass-start"></i>
                            </div>
                            <div class="timeline-content">
                                <p>Belum ada progress yang ditambahkan. Menunggu update dari petugas.</p>
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection