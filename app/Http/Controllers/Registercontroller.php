<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;

class Registercontroller extends Controller
{
    public function registerstore(Request $request)
    {
        $validatedData = $request->validate(
            [
                'nama'                   => 'required',
                'tanggal_lahir'          => 'required',
                'tempat'                 => 'required',
                'email'                 => 'required|email|unique:pengunjungs',
                'password'              => 'required|min:8',
            ],

            [
                'nama.required'              => 'Nama harus diisi.',
                'tanggal_lahir.required'     => 'Tanggal lahir harus diisi.',
                'tempat.required'            => 'Tempat lahir harus diisi.',
                'email1.required'            => 'Email harus diisi.',
                'email1.email'               => 'Email tidak valid.',
                'email1.unique'              => 'Email sudah digunakan.',
                'password1.required'         => 'Password harus diisi.',
                'password1.min'              => 'Password minimal terdiri dari 8 karakter.',
            ]
        );

        $user = Pengunjung::create([
            'nama'           => $validatedData['nama'],
            'tanggal_lahir'  => $validatedData['tanggal_lahir'],
            'tempat_lahir'   => $validatedData['tempat'],
            'email'          => $validatedData['email'],
            'password'       => bcrypt($validatedData['password']),
        ]);

        if ($user) {
            return redirect('/')->with('success', 'Register berhasil silahkan login')->with('showLoginModal', true);
        } else {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat mendaftar. Silahkan coba lagi.'])->withInput();
        }
    }
}
