<?php

namespace App\Http\Controllers;

use App\Models\kecamatan;
use App\Models\stunting as ModelsStunting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class stunting extends Controller
{

    public function index()
    {
        $title = 'Stunting | Dashboard';
        $stunting = DB::table('stuntings')
            ->join('kecamatans', 'stuntings.kecamatan_id', '=', 'kecamatans.id_kecamatan')
            ->select('stuntings.*', 'kecamatans.nama_kecamatan')
            ->get();
        // dd($stunting);
        return view('admin.stunting.index', [
            'title' => $title,
            'data_stunting' => $stunting,
        ]);
    }

    public function create()
    {
        $title = 'Tambah Stunting | Dashboard';
        $kecamatan = kecamatan::all();
        return view('admin.stunting.create', [
            'title' => $title,
            'kecamatan' => $kecamatan,
        ]);
    }
    public function store(Request $request)
    {
        try {

            $validate = $request->validate([
                'id_kecamatan'      => 'required',
                'jumlah_stunting'   => 'required',
                'usia'              => 'required',
                'berat'             => 'required',
                'tinggi'            => 'required',
            ], [
                'id_kecamatan.required'    => 'Kecamatan harus diisi.',
                'jumlah_stunting.required' => 'Data Jumlah Stunting harus diisi.',
                'usia.required'            => 'Data Usia harus diisi.',
                'berat.required'           => 'Data Berat Badan harus diisi.',
                'tinggi.required'          => 'Data Tinggi Badan harus diisi.',
            ]);

            // dd($request->all());

            $berat = str_replace(',', '.', $request->berat);
            $tinggi = str_replace(',', '.', $request->tinggi);

            $stunting = new ModelsStunting();

            $stunting->kecamatan_id        = $request->id_kecamatan;
            $stunting->jumlah_stunting     = $request->jumlah_stunting;
            $stunting->usia                = $request->usia;
            $stunting->berat_badan         = $berat;
            $stunting->tinggi_badan        = $tinggi;

            if ($stunting->usia == 1) {
                if ($stunting->berat_badan < 7 || $stunting->berat_badan > 11.5 || $stunting->tinggi_badan < 68.9 || $stunting->tinggi_badan > 79.2) {
                    $stunting->tingkat_stunting = 'Parah';
                } elseif ($stunting->berat_badan >= 7 && $stunting->berat_badan <= 11.5 && $stunting->tinggi_badan >= 68.9 && $stunting->tinggi_badan <= 79.2) {
                    $stunting->tingkat_stunting = 'Sedang';
                } else {
                    $stunting->tingkat_stunting = 'Ringan';
                }
            } elseif ($stunting->usia == 2) {
                if ($stunting->berat_badan < 9 || $stunting->berat_badan > 14.8 || $stunting->tinggi_badan < 80 || $stunting->tinggi_badan > 92.9) {
                    $stunting->tingkat_stunting = 'Parah';
                } elseif ($stunting->berat_badan >= 9 && $stunting->berat_badan <= 14.8 && $stunting->tinggi_badan >= 80 && $stunting->tinggi_badan <= 92.9) {
                    $stunting->tingkat_stunting = 'Sedang';
                } else {
                    $stunting->tingkat_stunting = 'Ringan';
                }
            } elseif ($stunting->usia == 3) {
                if ($stunting->berat_badan < 10.8 || $stunting->berat_badan > 18.1 || $stunting->tinggi_badan < 87.4 || $stunting->tinggi_badan > 101.7) {
                    $stunting->tingkat_stunting = 'Parah';
                } elseif ($stunting->berat_badan >= 10.8 && $stunting->berat_badan <= 18.1 && $stunting->tinggi_badan >= 87.4 && $stunting->tinggi_badan <= 101.7) {
                    $stunting->tingkat_stunting = 'Sedang';
                } else {
                    $stunting->tingkat_stunting = 'Ringan';
                }
            } elseif ($stunting->usia == 4) {
                if ($stunting->berat_badan < 12.3 || $stunting->berat_badan > 21.5 || $stunting->tinggi_badan < 94.1 || $stunting->tinggi_badan > 111.3) {
                    $stunting->tingkat_stunting = 'Parah';
                } elseif ($stunting->berat_badan >= 12.3 && $stunting->berat_badan <= 21.5 && $stunting->tinggi_badan >= 94.1 && $stunting->tinggi_badan <= 111.3) {
                    $stunting->tingkat_stunting = 'Sedang';
                } else {
                    $stunting->tingkat_stunting = 'Ringan';
                }
            } elseif ($stunting->usia == 5) {
                if ($stunting->berat_badan < 13.7 || $stunting->berat_badan > 24.9 || $stunting->tinggi_badan < 99.9 || $stunting->tinggi_badan > 118.9) {
                    $stunting->tingkat_stunting = 'Parah';
                } elseif ($stunting->berat_badan >= 13.7 && $stunting->berat_badan <= 24.9 && $stunting->tinggi_badan >= 99.9 && $stunting->tinggi_badan <= 118.9) {
                    $stunting->tingkat_stunting = 'Sedang';
                } else {
                    $stunting->tingkat_stunting = 'Ringan';
                }
            } else {
                $stunting->tingkat_stunting = 'Tidak diketahui';
            }

            $stunting->save();
            return redirect('/dashboard/stunting')->with('success', 'Data Stunting telah disimpan');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function show($id)
    {
    }



    public function edit($id)
    {
        $title = 'Edit Data Stunting | Dashboard';
        $kecamatan = kecamatan::all();
        $stunting = DB::table('stuntings')
            ->join('kecamatans', 'stuntings.kecamatan_id', '=', 'kecamatans.id_kecamatan')
            ->where('id_stunting', $id)
            ->select('stuntings.*', 'kecamatans.nama_kecamatan')
            ->first();

        return view('admin.stunting.edit', [
            'title' => $title,
            'stunting' => $stunting,
            'kecamatan' => $kecamatan,
        ]);
    }


    public function update(Request $request, $id)
    {
        try {
            $validate = $request->validate([
                'id_kecamatan'      => 'required',
                'jumlah_stunting'   => 'required',
                'usia'              => 'required',
                'berat'             => 'required',
                'tinggi'            => 'required',
            ], [
                'id_kecamatan.required'    => 'Kecamatan harus diisi.',
                'jumlah_stunting.required' => 'Data Jumlah Stunting harus diisi.',
                'usia.required'            => 'Data Usia harus diisi.',
                'berat.required'           => 'Data Berat Badan harus diisi.',
                'tinggi.required'          => 'Data Tinggi Badan harus diisi.',
            ]);

            $berat = str_replace(',', '.', $request->berat);
            $tinggi = str_replace(',', '.', $request->tinggi);

            $stunting = ModelsStunting::findOrFail($id);

            $stunting->kecamatan_id     = $request->id_kecamatan;
            $stunting->jumlah_stunting  = $request->jumlah_stunting;
            $stunting->usia             = $request->usia;
            $stunting->berat_badan      = $berat;
            $stunting->tinggi_badan     = $tinggi;

            if ($request->usia == 1) {
                if ($stunting->berat_badan < 7 || $stunting->berat_badan > 11.5 || $stunting->tinggi_badan < 68.9 || $stunting->tinggi_badan > 79.2) {
                    $stunting->tingkat_stunting = 'Parah';
                } elseif ($stunting->berat_badan >= 7 && $stunting->berat_badan <= 11.5 && $stunting->tinggi_badan >= 68.9 && $stunting->tinggi_badan <= 79.2) {
                    $stunting->tingkat_stunting = 'Sedang';
                } else {
                    $stunting->tingkat_stunting = 'Ringan';
                }
            } elseif ($request->usia == 2) {
                if ($stunting->berat_badan < 9 || $stunting->berat_badan > 14.8 || $stunting->tinggi_badan < 80 || $stunting->tinggi_badan > 92.9) {
                    $stunting->tingkat_stunting = 'Parah';
                } elseif ($stunting->berat_badan >= 9 && $stunting->berat_badan <= 14.8 && $stunting->tinggi_badan >= 80 && $stunting->tinggi_badan <= 92.9) {
                    $stunting->tingkat_stunting = 'Sedang';
                } else {
                    $stunting->tingkat_stunting = 'Ringan';
                }
            } elseif ($request->usia == 3) {
                if ($stunting->berat_badan < 10.8 || $stunting->berat_badan > 18.1 || $stunting->tinggi_badan < 87.4 || $stunting->tinggi_badan > 101.7) {
                    $stunting->tingkat_stunting = 'Parah';
                } elseif ($stunting->berat_badan >= 10.8 && $stunting->berat_badan <= 18.1 && $stunting->tinggi_badan >= 87.4 && $stunting->tinggi_badan <= 101.7) {
                    $stunting->tingkat_stunting = 'Sedang';
                } else {
                    $stunting->tingkat_stunting = 'Ringan';
                }
            } elseif ($request->usia == 4) {
                if ($stunting->berat_badan < 12.3 || $stunting->berat_badan > 21.5 || $stunting->tinggi_badan < 94.1 || $stunting->tinggi_badan > 111.3) {
                    $stunting->tingkat_stunting = 'Parah';
                } elseif ($stunting->berat_badan >= 12.3 && $stunting->berat_badan <= 21.5 && $stunting->tinggi_badan >= 94.1 && $stunting->tinggi_badan <= 111.3) {
                    $stunting->tingkat_stunting = 'Sedang';
                } else {
                    $stunting->tingkat_stunting = 'Ringan';
                }
            } elseif ($request->usia == 5) {
                if ($stunting->berat_badan < 13.7 || $stunting->berat_badan > 24.9 || $stunting->tinggi_badan < 99.9 || $stunting->tinggi_badan > 118.9) {
                    $stunting->tingkat_stunting = 'Parah';
                } elseif ($stunting->berat_badan >= 13.7 && $stunting->berat_badan <= 24.9 && $stunting->tinggi_badan >= 99.9 && $stunting->tinggi_badan <= 118.9) {
                    $stunting->tingkat_stunting = 'Sedang';
                } else {
                    $stunting->tingkat_stunting = 'Ringan';
                }
            } else {
                $stunting->tingkat_stunting = 'Tidak Diket';
            }

            $stunting->save();
            return redirect('/dashboard/stunting')->with('success', 'Data Stunting telah diperbaharui');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $stunting = ModelsStunting::findOrFail($id);
            $stunting->delete();

            return redirect('/dashboard/stunting')->with('success', 'Data Stunting telah dihapus');
        } catch (\Exception $e) {
            return redirect('/dashboard/stunting')->with('error', $e->getMessage());
        }
    }
}
