<?php

namespace App\Http\Controllers;
use App\Models\WortelModel;
use Illuminate\Http\Request;

class WortelController extends Controller
{
    public function index()
    {
        $title = 'Wortel | Dashboard';
        $data_wortel = WortelModel::all();
        return view('admin.wortel.index',[
            'title'=>$title,
            'data_wortel'=>$data_wortel,
        ]);
    }

    public function create()
    {
        $title='wortel | Dashboard';
        return view('admin.wortel.create',[
            'title'=>$title,
          
        ]);
        
    }
    public function store(Request $request)
    {
        $validate=$request->validate(
            [
               'data_wortel' => 'required',
        ]); 
        
        WortelModel::create($validate);
        return redirect('/wortel')->with('sucess','data telah disimpan');
          
    }
    public function edit($id)
    {

        $title='Wortel | Dashboard';
        $data_wortel=WortelModel::where('id',$id)->first();
        return view('admin.wortel.edit',[
            'title'=>$title,
            'data_wortel'=>$data_wortel,
        ]);
        
    }
    public function update(Request $request,$id)
    {
        $validate=$request->validate(
            [
               'data_wortel' => 'required',
        ]); 
        
        WortelModel::find($id)
           ->update($validate); 
        return redirect('/wortel')->with('sucess','data telah disimpan');
          
          
                
    }
    public function destroy($id)
    {
       WortelModel::find($id)
       ->delete();
       return redirect('/wortel')->with('sucess','data telah disimpan');

       
        
    }
}
