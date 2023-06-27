<?php

namespace App\Http\Controllers;
use App\Models\LaporanModel;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $title = 'laporan | Dashboard';
        $laporan = LaporanModel::all();
        return view('admin.laporan.index',[
            'title'=>$title,
            'laporan'=>$laporan,
        ]);
    }
    public function userindex()
    {
        $title = 'laporan | Dashboard';
        $laporan = LaporanModel::all();
        return view('user.laporan.index',[
            'title'=>$title,
            'laporan'=>$laporan,
        ]);
    }

    public function create()
    {
        $title='laporan | Dashboard';
        return view('admin.laporan.create',[
            'title'=>$title,
          
        ]);
        
    }
    public function store(Request $request)
    {
        $validate=$request->validate(
            [
               'bulan' => 'required',
               'tahun' => 'required',
               'jumlah_pasien' => 'required',
        ]); 
        
        LaporanModel::create($validate);
        return redirect('/laporan')->with('sucess','data telah disimpan');
          
    }
    public function edit($id)
    {

        $title='laporan | Dashboard';
        $laporan=LaporanModel::where('id',$id)->first();
        return view('admin.laporan.edit',[
            'title'=>$title,
            'laporan'=>$laporan,
        ]);
        
    }
    public function update(Request $request,$id)
    {
        $validate=$request->validate(
            [
                'bulan' => 'required',
                'tahun' => 'required',
                'jumlah_pasien' => 'required',
        ]); 
        
        LaporanModel::find($id)
           ->update($validate); 
        return redirect('/laporan')->with('sucess','data telah disimpan');
          
          
                
    }
    public function destroy($id)
    {
       LaporanModel::find($id)
       ->delete();
       return redirect('/laporan')->with('sucess','data telah disimpan');

       
        
    }
}
