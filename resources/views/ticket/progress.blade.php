@extends('layouts.page')

@section('title', 'Detail Progress Pesanan')

@section('css')
<style>
    /* General Timeline Styles */
    .timeline {
        position: relative;
        padding: 20px 0;
        list-style: none;
    }

    /* The vertical line */
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

    /* The circle icon on the timeline */
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
        background-color: #28a745;
        /* Green for success/completed */
    }

    .timeline-item.info .timeline-icon {
        background-color: #17a2b8;
        /* Blue for info/in-progress */
    }

    .timeline-item.warning .timeline-icon {
        background-color: #ffc107;
        /* Yellow for pending/warning */
    }

    /* The content box for each timeline item */
    .timeline-content {
        margin-left: 75px;
        background-color: #f8f9fa;
        border-radius: 6px;
        padding: 15px;
        position: relative;
    }

    /* The arrow pointing to the timeline */
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Progress Pesanan #{{ $pesanan->kd_pesanan ?? 'N/A' }}</h3>
            </div>
            <div class="card-body">
                <ul class="timeline">
                    <li class="timeline-item success">
                        <div class="timeline-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="timeline-content">
                            <p class="font-weight-bold mb-1">Pesanan Dibuat</p>
                            <p class="mb-1">Pesanan telah dibuat oleh {{ $pesanan->dibuat_oleh ?? 'Customer' }} dan
                                diterima oleh sistem.</p>
                            <span class="timeline-time">{{ $pesanan->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </li>
                    @if ($pesanan->progres >= 2)
                        <li class="timeline-item success">
                            <div class="timeline-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="timeline-content">
                                <p class="font-weight-bold mb-1">Pesanan Diterima</p>
                                <p>Pesanan telah diterima oleh petugas.</p>
                                <span class="timeline-time">{{ $pesanan->updated_at->format('d M Y, H:i') }}</span>
                            </div>
                        </li>
                    @else
                        <li class="timeline-item info">
                            <div class="timeline-icon">
                                <i class="fas fa-hourglass-start"></i>
                            </div>
                            <div class="timeline-content">
                                <p>Pesanan Belum Diterima</p>
                                <span class="timeline-time">-</span>
                            </div>
                        </li>
                    @endif

                    @if ($pesanan->progres >= 3)

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
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
    });
</script>
@endsection