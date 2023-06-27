<?php

namespace App\Http\Controllers;

use App\Models\ProfileModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class Profilcontroller extends Controller
{

    public function index()

    {
        $title = 'Profil | Dashboard';
        $data = ProfileModel::all();
        $count = ProfileModel::count();
        return view('admin.profile.index', [
            'title' => $title,
            'data' => $data,
            'count' => $count,
        ]);
    }


    public function create()
    {
        $title = 'Profile | Dashboard';
        return view('admin.profile.create', [
            'title' => $title,
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'visi'       => 'required',
            'misi'       => 'required',
        ]);
        $visimisi =
            [
                'visi'       => $request->input('visi'),
                'misi'       =>  $request->input('misi')
            ];

        $visimisi =  ProfileModel::create($visimisi);
        return redirect('/dashboard/profil')->with('success', 'data berhasil di tambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'Profile | Dashboard';
        $data = ProfileModel::where('id_profile', $id)->first();
        return view('admin.profile.edit', [
            'title' => $title,
            'data'  => $data,
        ]);
    }


    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'visi'       => 'required',
            'misi'       => 'required',
        ]);

        $VM = ProfileModel::find($id);
        $VM->visi        = $validate['visi'];
        $VM->misi        = $validate['misi'];
        $VM->save();
        return redirect('/dashboard/profil')->with('success', 'data berhasil di Ubah');
    }

    public function destroy($id)
    {
        $vm = ProfileModel::findOrFail($id);
        $vm->delete();
        return redirect('/dashboard/profil')->with('success', 'data berhasil di hapus');
    }
}
