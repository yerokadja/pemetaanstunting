<?php

namespace App\Http\Controllers;

use App\Models\kecamatan;
use App\Models\PasienModel;
use App\Models\stunting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Dashboard | Administrator';
        $kecamatan = kecamatan::count();
        $totalStunting = DB::table('stuntings')->sum('jumlah_stunting');
        $stunting = DB::table('stuntings')
            ->join('kecamatans', 'stuntings.kecamatan_id', '=', 'kecamatans.id_kecamatan')
            ->join('hasil_clusters', 'kecamatans.id_kecamatan', '=', 'hasil_clusters.kecamatan_id')
            ->select('stuntings.*', 'kecamatans.*', 'hasil_clusters.cluster_id')
            ->get();
        return view('admin.index', compact('title', 'kecamatan', 'totalStunting'));
    }

    public function map(Request $request)
    {
        $title = 'Dashboard | Administrator';
        $kecamatan = kecamatan::all();
        $stunting = DB::table('stuntings')
            ->join('kecamatans', 'stuntings.kecamatan_id', '=', 'kecamatans.id_kecamatan')
            ->join('hasil_clusters', 'kecamatans.id_kecamatan', '=', 'hasil_clusters.kecamatan_id')
            ->select('stuntings.*', 'kecamatans.*', 'hasil_clusters.cluster_id')
            ->get();
        return view('admin.peta.index', compact('title', 'kecamatan', 'stunting'));
    }
}
