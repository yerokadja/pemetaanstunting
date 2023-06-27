<?php

namespace App\Http\Controllers;

use App\Models\PasienModel;
use App\Models\stunting;
use App\Models\StuntingModel;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $title = 'Pasien | Dashboard';
        $data_pasien = stunting::all();
        return view('admin.stunting.index', [
            'title' => $title,
            'pasien' => $data_pasien,
        ]);
    }

    public function create()
    {
        $title = 'Pasien | Dashboard';
        return view('admin.pasien.create', [
            'title' => $title,

        ]);
    }
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'nama'          => 'required|unique:pasien,nama',
                'jenis_kelamin' => 'required',
                'alamat'        => 'required',
                'tinggi_badan'   => 'required',
                'berat_badan'   => 'required',
                'lingkar_badan' => 'required',
                'lingkar_perut' => 'required',
            ],

            [
                'nama.unique'               => 'Nama sudah digunakan.',
                'nama.required'             => 'Nama Harus diisi.',
                'jenis_kelamin.required'    => 'Jenis Kelamin Harus diisi.',
                'alamat.required'           => 'alamat Harus diisi.',
                'tinggi_badan.required'     => 'Tinggi Badan Harus diisi.',
                'berat_badan.required'      => 'Berat Badan Harus diisi.',
                'lingkar_badan.required'    => 'Lingkar Badan Harus diisi.',
                'lingkar_perut.required'    => 'Lingkar Perut Harus diisi.',
            ],
        );

        $bb = $request->berat_badan;
        $tb = $request->tinggi_badan;

        if (($tb < 2.1 && $bb < 50) || ($tb < 75 && $bb / $tb < 0.9)) {
            $status = 'Stunting';
        } else {
            $status = 'Normal';
        }
        // dd($request->all());
        // dd($status);
        $pasien = new PasienModel;
        $pasien->nama = $request->nama;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->alamat = $request->alamat;
        $pasien->berat_badan = $bb;
        $pasien->tinggi_badan = $tb;
        $pasien->lingkar_badan = $request->lingkar_badan;
        $pasien->lingkar_perut = $request->lingkar_perut;
        $pasien->status = $status;
        $pasien->save();

        return redirect('/dashboard/pasien')->with('success', 'Data Pasien telah disimpan');
    }
    public function edit($id_pasien)
    {
        $title = 'Pasien | Dashboard';
        $data_pasien = PasienModel::where('id_pasien', $id_pasien)->first();
        // dd($data_pasien);
        return view('admin.pasien.edit', [
            'title' => $title,
            'pasien' => $data_pasien,
        ]);
    }

    public function update(Request $request, $id_pasien)
    {
        $validate = $request->validate(
            [
                'nama'          => 'required|unique:pasien,nama,' . $id_pasien . ',id_pasien',
                'jenis_kelamin' => 'required',
                'alamat'        => 'required',
                'tinggi_badan'  => 'required',
                'berat_badan'   => 'required',
                'lingkar_badan' => 'required',
                'lingkar_perut' => 'required',
            ]
        );

        $stunting = StuntingModel::where('pasien_id', $id_pasien)->first();
        if ($stunting) {
            return redirect('/dashboard/pasien')->with('error', 'Data pasien sudah masuk ke dalam table stunting. Tidak dapat melakukan perubahan.');
            // $pasien = PasienModel::findOrFail($id_pasien);
            // $pasien->nama = $request->nama;
            // $pasien->tanggal_lahir = $request->tanggal_lahir;
            // $pasien->jenis_kelamin = $request->jenis_kelamin;
            // $pasien->alamat = $request->alamat;
            // $pasien->save();
        }

        $bb = $request->berat_badan;
        $tb = $request->tinggi_badan;

        if (($tb < 2.1 && $bb < 50)) {
            $status = 'Stunting';
        } else {
            $status = 'Normal';
        }
        // dd($request->all());
        // dd($status);
        $pasien = PasienModel::find($id_pasien);
        $pasien->nama = $request->nama;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->alamat = $request->alamat;
        $pasien->berat_badan = $bb;
        $pasien->tinggi_badan = $tb;
        $pasien->lingkar_badan = $request->lingkar_badan;
        $pasien->lingkar_perut = $request->lingkar_perut;
        $pasien->status = $status;
        $pasien->save();
        return redirect('/dashboard/pasien')->with('success', 'Data Pasien telah diupdate');
    }
    public function destroy($id_pasien)
    {

        $pasien = PasienModel::findOrFail($id_pasien);
        $stunting = StuntingModel::where('pasien_id', $id_pasien)->first();
        if ($stunting) {
            return redirect('/dashboard/pasien')->with('error', 'Data pasien sudah masuk ke dalam table stunting. Tidak dapat melakukan Penghapusan.');
        }

        PasienModel::find($id_pasien)
            ->delete();
        return redirect('/dashboard/pasien')->with('success', 'Data Pasien telah dihapus');
    }
}
