<?php

namespace App\Http\Controllers;

use App\Models\kecamatan as ModelsKecamatan;
use Illuminate\Http\Request;

class kecamatan extends Controller
{

    public function index()
    {
        $title = 'Kecamatan | Dashboard';
        $kecamatan = ModelsKecamatan::all();
        return view('admin.Kecamatan.index', [
            'title' => $title,
            'kecamatan' => $kecamatan,
        ]);
    }

    public function create()
    {
        $title = 'Tambah Kecamatan | Dashboard';
        return view('admin.kecamatan.create', [
            'title' => $title,
        ]);
    }


    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'kode_kecamatan' => 'required|unique:kecamatans,kode_kecamatan',
                'kecamatan'      => 'required|unique:kecamatans,nama_kecamatan',
                'file_geo_json'  => 'required',
                'warna'          => 'required',
            ], [
                'kode_kecamatan.required' => 'Kode Kecamatan harus diisi.',
                'kode_kecamatan.unique'   => 'Kode Kecamatan sudah digunakan.',
                'kecamatan.unique'        => 'Nama Kecamatan sudah digunakan.',
                'kecamatan.required'      => 'Nama Kecamatan harus diisi.',
                'file_geo_json.required'  => 'File GeoJSON harus diunggah.',
                'warna.required'          => 'Warna harus diisi.',
            ]);

            $temp = $request->file('file_geo_json')->getPathname();
            $fileName = $request->kecamatan . "-" . date("Ymdhis") . "." . $request->file('file_geo_json')->extension();
            $folder = public_path('assets/peta/') . $fileName;
            move_uploaded_file($temp, $folder);
            $kecamatan = new ModelsKecamatan;
            $kecamatan->kode_kecamatan = $request->kode_kecamatan;
            $kecamatan->nama_kecamatan = $request->kecamatan;
            $kecamatan->warna = $request->warna;
            $kecamatan->file_geo_json = $fileName;
            $kecamatan->save();
            return redirect('/dashboard/kecamatan')->with('success', 'Data Kecamatan telah disimpan');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $title = 'Edit Kecamatan | Dashboard';
        $kecamatan = ModelsKecamatan::where('id_kecamatan', $id)->first();
        return view('admin.kecamatan.edit', [
            'title' => $title,
            'kecamatan' => $kecamatan,
        ]);
    }


    public function update(Request $request, $id)
    {
        try {
            $validate = $request->validate([
                'kode_kecamatan' => 'required|unique:kecamatans,kode_kecamatan,' . $id . ',id_kecamatan',
                'kecamatan'      => 'required|unique:kecamatans,nama_kecamatan,' . $id . ',id_kecamatan',
                'file_geo_json'  => 'required',
                'warna'          => 'required',
            ], [

                'kode_kecamatan.required'  => 'Kode Kecamatan harus diisi.',
                'kode_kecamatan.unique'    => 'Kode Kecamatan sudah digunakan.',
                'kecamatan.unique'         => 'Nama Kecamatan sudah digunakan.',
                'kecamatan.required'       => 'Nama Kecamatan harus diisi.',
                'file_geo_json.required'   => 'File GeoJSON harus diunggah.',
                'warna.required'           => 'Warna harus diisi.',
            ]);

            $kecamatan = ModelsKecamatan::findOrFail($id);
            $kecamatan->kode_kecamatan = $request->kode_kecamatan;
            $kecamatan->nama_kecamatan = $request->kecamatan;
            $kecamatan->warna = $request->warna;

            if ($request->hasFile('file_geo_json')) {
                $temp = $request->file('file_geo_json')->getPathname();
                $fileName = $request->kecamatan . "-" . date("Ymdhis") . "." . $request->file('file_geo_json')->extension();
                $folder = public_path('assets/peta/') . $fileName;
                move_uploaded_file($temp, $folder);
                $kecamatan->file_geo_json = $fileName;
            }

            $kecamatan->save();
            return redirect('/dashboard/kecamatan')->with('success', 'Data Kecamatan telah disimpan');
        } catch (\Exception $e) {
            return redirect('/dashboard/kecamatan')->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $kecamatan = ModelsKecamatan::findOrFail($id);
            $imagePath = public_path('assets/peta/') . $kecamatan->file_geo_json;
            if ($kecamatan->file_geo_json && file_exists($imagePath)) {
                unlink($imagePath);
            }
            $kecamatan->delete();
            return redirect('/dashboard/kecamatan')->with('success', 'Data Kecamatan telah dihapus');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
