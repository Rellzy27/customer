<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     */

    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required|string|max:255',
            'telp_pelanggan' => 'nullable|string|max:20|unique:pelanggan,telp_pelanggan|unique:karyawan,telp',
            'alamat_pelanggan' => 'required|string|max:255',
            'nama_perusahaan' => 'nullable|string|max:255',
            'nik' => 'nullable|string|max:20',
            'username' => 'required|string|max:255|unique:pelanggan,username|unique:karyawan,username',
            'email' => 'required|string|email|max:255|unique:pelanggan,email|unique:karyawan,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nama_pelanggan.required' => 'Nama lengkap wajib diisi.',
            'telp_pelanggan.unique' => 'Nomor telepon sudah terdaftar pada akun lain.',
            'alamat_pelanggan.required' => 'Alamat wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username ini sudah digunakan oleh akun lain.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email yang Anda masukkan tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar pada akun lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus terdiri dari :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput($request->all());
        }


        $user = Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'telp_pelanggan' => $request->telp_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'nama_perusahaan' => $request->nama_perusahaan,
            'nik' => $request->nik,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        Auth::guard('pelanggan')->login($user);

    }
}