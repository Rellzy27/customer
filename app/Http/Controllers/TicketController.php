<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
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

    public function detail($item)
    {
        $pesanan = Pesanan::find($item);
        return view('ticket.detail', compact('pesanan'));
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

        $pesanan = Pesanan::create([
            'kd_pelanggan' => Auth::guard('pelanggan')->user()->kd_pelanggan,
            'deskripsi_pesanan' => $request->deskripsi_pesanan,
            'tanggal' => $request->tanggal,
            'dibuat_oleh' => Auth::guard('pelanggan')->user()->nama_pelanggan
        ]);

        if ($pesanan) {
            return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dibuat.');
        }
        return redirect()->route('ticket.create')->with('error', 'Pesanan gagal dibuat.');
    }

    public function edit($id)
    {
        $pesanan = Pesanan::find($id);
        return view('ticket.edit', compact('pesanan'));
    }

}
