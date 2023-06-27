<?php

namespace App\Http\Controllers;

use App\Models\stunting;
use App\Models\variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class variablecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Variable Stunting | Dashboard';
        $variable = DB::table('variables')
            ->join('stuntings', 'variables.desa_id', '=', 'stuntings.id_stunting')
            ->get();
        return view('admin.variable.index', [
            'title' => $title,
            'variable' => $variable,
        ]);
    }


    public function create()
    {
        $title = 'Tambah Variable Stunting | Dashboard';
        // $variable = DB::table('variables')
        // ->join('stuntings', 'variables.desa_id', '=', 'stuntings.id_stunting')
        // ->get();
        $desa = stunting::all();
        return view('admin.variable.create', [
            'title' => $title,
            'desa' => $desa,
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'desa_id'   => 'required',
            'berat'     => 'required',
            'tinggi'    => 'required'
        ], [
            'desa_id.required'  => 'Data Desa harus diisi.',
            'berat.required'    => 'Berat harus diisi.',
            'tinggi.required'   => 'Tinggi harus diisi.'
        ]);

        $stunting = new Variable();

        $stunting->desa_id          = $request->desa_id;
        $stunting->berat_badan      = $request->berat;
        $stunting->tinggi_badan     = $request->tinggi;
        $stunting->save();

        return redirect('/dashboard/variable')->with('success', 'Data variable telah disimpan');
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
