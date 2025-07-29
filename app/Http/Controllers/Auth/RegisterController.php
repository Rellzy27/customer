<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest:pelanggan');
    }

    public function guard()
    {
        return Auth::guard('pelanggan');
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
            $validatedData = Validator::make($request->all(), [
                'nama_pelanggan' => ['required', 'string', 'max:255'],
                'nama_perusahaan' => ['nullable', 'string', 'max:255'],
                'alamat_pelanggan' => ['nullable', 'string', 'max:255'],
                'telp_pelanggan' => ['nullable', 'string', 'max:255', 'unique:pelanggan'],
                'username' => ['required', 'string', 'max:255', 'unique:pelanggan'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:pelanggan'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ], [
                'telp_pelanggan.unique' => 'Nomor telepon sudah terdaftar.',
                'username.unique' => 'Username sudah terdaftar.',
                'email.unique' => 'Email sudah terdaftar.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.confirmed' => 'Password tidak cocok.',
            ]);

            if ($validatedData->fails()) {
                return redirect()->back()->withErrors($validatedData)->withInput();
            }


        $user = Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'telp_pelanggan' => $request->telp_pelanggan,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        // event(new Registered($user));

        $this->guard()->login($user);

        // return $request->wantsJson()
        //             ? new JsonResponse([], 201)
        //             : redirect()->route('verification.notice');

    }
}