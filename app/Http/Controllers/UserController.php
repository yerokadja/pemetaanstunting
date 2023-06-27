<?php

namespace App\Http\Controllers;

use App\Models\PasienModel;
use App\Models\Pengunjung;
use App\Models\ProfileModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Home';
        return view('user.berita', [
            'title' => $title,
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate(

            [
                'email'     => 'required',
                'password'  => 'required'
            ],

            [
                'email.required'     => 'Email tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
            ]

        );


        if (Auth::guard('pengunjung')->attempt($credentials)) {
            $request->session()->regenerate();
            Session::forget('accessing_pasien');
            return redirect('/')->with('success', 'Kamu Berhasil Login');
        }
        return redirect()->back()->withInput()->with('error', 'Periksa Kembali Email atau password anda');
    }

    public function logout(Request $request)
    {
        auth()->guard('pengunjung')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Kamu Berhasil Logout');
    }

    public function pasien()
    {
        if (Auth()->guard('pengunjung')->check()) {
            $title = 'Data Pasien';
            $data_pasien = PasienModel::all();
            return view('user.pasien', [
                'title' => $title,
                'pasien' => $data_pasien,
            ]);
        } else {
            session(['accessing_pasien' => true]);
            return redirect('/')->with('error', ' Kamu harus login terlebih dahulu');
        }
    }

    public function grafik()
    {
        $title = 'Grafik';
        $pasien = PasienModel::select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), 'status', DB::raw('count(*) as total'))
            ->groupBy('month', 'year', 'status')
            ->get();
        $data = array();

        foreach ($pasien as $key => $value) {
            $data[$value->year][$value->month][$value->status] = $value->total;
        }

        return view('user.grafik', compact('title', 'data'));
    }
    public function visimisi()
    {
        $title = 'Data Pasien';
        $visimisi = ProfileModel::all();
        foreach ($visimisi as $key => $value) {
            $value->visi;
            $value->misi;
        }
        // dd($value);
        return view('user.visimisi', [
            'title' => $title,
            'visimisi' => $value,
        ]);
    }
    public function beritadetail()
    {
        $title = 'Berita Detail';
        return view('user.berita-detail', [
            'title' => $title,
        ]);
    }

    public function hapusseesion()
    {
        Session::forget('accessing_pasien');
        return response()->json(['message' => 'Session dihapus'], 200);
    }
}
