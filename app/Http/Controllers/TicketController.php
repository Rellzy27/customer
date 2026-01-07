<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Pesanan;
use App\Models\Pesanan_Detail;
use App\Models\Pesanan_Jasa;
use App\Models\Pesanan_Progress;
use App\Models\PesananBarang;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Tiket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::where('kd_pelanggan', Auth::guard('pelanggan')->user()->kd_pelanggan)->latest()->get();
        return view('ticket.ticket', compact('pesanan'));
    }

    public function create()
    {
        return view('ticket.create');
    }

    public function detail($ticket)
    {
        $tiket = Tiket::find($ticket);
        $pesanan = Pesanan::where('kd_tiket', $tiket->kd_tiket)->first();
        // $surat_perintah = SuratPerintahKerja::where('kd_pesanan', $pesanan->kd_pesanan)->get();

        $currentUrl = url()->current();
        $normalizedUrl = rtrim($currentUrl, '/');

        $backUrl = dirname($normalizedUrl);

        if ($pesanan->jenis == 'Quotation') {
            $billing = Quotation::where('kd_tiket', $pesanan->kd_tiket)->first();
            $billing_barang = QuotationItem::where('kd_quotation', $billing->kd_quotation)->where('kd_barang', '!=', null)->get();
            $billing_jasa = QuotationItem::where('kd_quotation', $billing->kd_quotation)->where('kd_jasa', '!=', null)->get();
        } elseif ($pesanan->jenis == 'Invoice') {
            $quotation = Quotation::where('kd_tiket', $pesanan->kd_tiket)->first();
            $billing = Invoice::where('kd_quotation', $quotation->kd_quotation)->first();
            $billing_barang = InvoiceItem::where('kd_invoice', $billing->kd_invoice)->where('kd_barang', '!=', null)->get();
            $billing_jasa = InvoiceItem::where('kd_invoice', $billing->kd_invoice)->where('kd_jasa', '!=', null)->get();
        } else {
            Quotation::create([
                'kd_tiket' => $pesanan->kd_tiket,
                'dibuat_oleh' => $pesanan->dibuat_oleh
            ]);
            $pesanan->update([
                'jenis' => 'Quotation'
            ]);
            $billing = Quotation::where('kd_tiket', $pesanan->kd_tiket)->first();
            $billing_barang = QuotationItem::where('kd_quotation', $billing->kd_quotation)->where('kd_barang', '!=', null)->get();
            $billing_jasa = QuotationItem::where('kd_quotation', $billing->kd_quotation)->where('kd_jasa', '!=', null)->get();
        }
        
        return view('ticket.detail', compact('pesanan', 'billing', 'billing_barang', 'billing_jasa', 'backUrl'));
    }

    public function progress($ticket)
    {
        $pesanan = Pesanan::find($ticket);
        if ($pesanan->progres <= '2') {
            return redirect()->route('ticket.detail', $pesanan->kd_pesanan);
        }
        $progress = Pesanan_Progress::where('kd_pesanan', $pesanan->kd_pesanan)->get();
        return view('ticket.progress', compact('pesanan', 'progress'));
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'deskripsi_pesanan' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'string'],
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $appointmentDate = Carbon::createFromFormat('d/m/Y', $request->tanggal);
        if ($appointmentDate->isPast() && !$appointmentDate->isToday()) {
            return redirect()->back()
                ->with('toast_error', 'Tanggal temu tidak boleh kurang dari hari ini.')
                ->withInput();
        }

        $tiket = Tiket::create([
            'kd_pelanggan' => Auth::guard('pelanggan')->user()->kd_pelanggan,
            'deskripsi' => $request->deskripsi_pesanan,
            'tanggal' => Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d'),
            'jenis' => $request->jenis,
            'via' => 'Web',
            'prioritas' => '1',
            'dibuat_oleh' => 'Pelanggan',
        ]);

        if ($tiket) {
            return redirect()->route('dashboard')->with('toast_success', 'Pesanan berhasil dibuat.');
        }
        return redirect()->route('ticket.create')->with('error', 'Pesanan gagal dibuat.');
    }

    public function edit(Request $request, $ticket)
    {
        $validated = Validator::make($request->all(), [
            'deskripsi_pesanan' => 'required|string',
            'tanggal' => 'required|date_format:d/m/Y',
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $appointmentDate = Carbon::createFromFormat('d/m/Y', $request->tanggal);
        if ($appointmentDate->isPast() && !$appointmentDate->isToday()) {
            return redirect()->back()
                ->with('toast_error', 'Tanggal temu tidak boleh kurang dari hari ini.')
                ->withInput();
        }

        $pesanan = Pesanan::find($ticket);
        $pesanan->deskripsi_pesanan = $request->deskripsi_pesanan;
        $pesanan->tanggal = $request->tanggal;
        $pesanan->save();
        return redirect()->route('dashboard')->with('toast_success', 'Pesanan berhasil diubah.');
    }

    public function cancel($ticket)
    {
        $pesanan = Pesanan::find($ticket);
        $pesanan->status = '2';
        $pesanan->save();
        return redirect()->route('dashboard')->with('toast_success', 'Pesanan berhasil dibatalkan.');
    }

}
