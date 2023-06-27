<?php

namespace App\Http\Controllers;

use App\Models\ProfileModel;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'Profile | Dashboard';
        $data = ProfileModel::all();
        return view('admin.profile.index', [
            'title' => $title,
            'data' => $data,
        ]);
    }
    public function userindex()
    {
        $title = 'Profile | Dashboard';
        $data = ProfileModel::all();
        return view('user.profile.index', [
            'title' => $title,
            'data' => $data,
        ]);
    }


    public function create()
    {
        $title = 'profile | Dashboard';
        return view('admin.profile.create', [
            'title' => $title,

        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'nama_profile' => 'required',
            ]
        );

        ProfileModel::create($validate);
        return redirect('/profile')->with('sucess', 'data telah disimpan');
    }

    public function edit($id)
    {

        $title = 'profile | Dashboard';
        $data = ProfileModel::where('id', $id)->first();
        return view('admin.profile.edit', [
            'title' => $title,
            'data' => $data,
        ]);
    }
    public function update(Request $request, $id)
    {
        $validate = $request->validate(
            [
                'profile' => 'required',
            ]
        );

        ProfileModel::find($id)
            ->update($validate);
        return redirect('/profile')->with('sucess', 'data telah disimpan');
    }
    public function destroy($id)
    {
        ProfileModel::find($id)
            ->delete();
        return redirect('/profile')->with('sucess', 'data telah disimpan');
    }
}
