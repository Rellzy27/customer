<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\Pesanan_Detail;
use App\Models\Pesanan_Jasa;
use App\Models\PesananBarang;
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
        $auth_check = Auth::guard('pelanggan')->user()->kd_pelanggan;

        if (Pesanan::find($ticket) == null || $auth_check != Pesanan::find($ticket)->kd_pelanggan) {
            abort(403, 'Unauthorized action.');
        }

        $pesanan = Pesanan::find($ticket);
        $pesanan_barang = PesananBarang::where('kd_pesanan_detail', $pesanan->kd_pesanan_detail)->get();
        $pesanan_jasa = Pesanan_Jasa::where('kd_pesanan_detail', $pesanan->kd_pesanan_detail)->get();
        foreach ($pesanan_barang as $barang) {
            $barang->barang = Barang::find($barang->kd_barang);
        }

        return view('ticket.detail', compact('pesanan', 'pesanan_barang', 'pesanan_jasa'));
    }
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'deskripsi_pesanan' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'string'],
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $appointmentDate = Carbon::createFromFormat('d/m/Y', $request->tanggal);
        if ($appointmentDate->isPast() && !$appointmentDate->isToday()) {
            return redirect()->back()
                ->with('toast_error', 'Tanggal appointment tidak boleh kurang dari hari ini.')
                ->withInput();
        }

        $pesanan = Pesanan::create([
            'kd_pelanggan' => Auth::guard('pelanggan')->user()->kd_pelanggan,
            'deskripsi_pesanan' => $request->deskripsi_pesanan,
            'tanggal' => $request->tanggal,
            'dibuat_oleh' => Auth::guard('pelanggan')->user()->nama_pelanggan
        ]);

        if ($pesanan) {
            Pesanan_Detail::create([
                'kd_pelanggan' => Auth::guard('pelanggan')->user()->kd_pelanggan,
                'kd_pesanan' => $pesanan->kd_pesanan,
                'dibuat_oleh' => Auth::guard('pelanggan')->user()->nama_pelanggan
            ]);
        }

        if ($pesanan) {
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
                ->with('toast_error', 'Tanggal appointment tidak boleh kurang dari hari ini.')
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
