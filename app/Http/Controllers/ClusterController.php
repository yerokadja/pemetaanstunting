<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use Illuminate\Http\Request;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Clusters | Dashboard';
        $cluster = Cluster::all();
        return view('admin.cluster.index', [
            'title' => $title,
            'cluster' => $cluster,
        ]);
    }


    public function create()
    {
        $title = 'Tambah Clusters | Dashboard';
        return view('admin.cluster.create', [
            'title' => $title,
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([

            'clusters'          => 'required',

        ], [
            'clusters.required' => 'Data Cluster harus diisi.',
        ]);

        $cluster = new Cluster();

        $cluster->nama_cluster = $request->clusters;
        $cluster->save();

        return redirect('/dashboard/cluster')->with('success', 'Data Cluster telah disimpan');
    }


    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $title = 'Edit Clusters | Dashboard';
        $cluster = Cluster::where('id_cluster', $id)->first();
        return view('admin.cluster.edit', [
            'title'     => $title,
            'cluster'   => $cluster
        ]);
    }


    public function update(Request $request, $id)
    {
        $validate = $request->validate([

            'clusters'          => 'required',

        ], [
            'clusters.required' => 'Data Cluster harus diisi.',
        ]);

        $cluster = Cluster::findOrFail($id);

        $cluster->nama_cluster = $request->clusters;
        $cluster->save();

        return redirect('/dashboard/cluster')->with('success', 'Data Cluster telah disimpan');
    }


    public function destroy($id)
    {
        try {

            $stunting = Cluster::findOrFail($id);
            $stunting->delete();

            return redirect('/dashboard/cluster')->with('success', 'Data Cluster telah dihapus');
        } catch (\Exception $e) {
            return redirect('/dashboard/cluster')->with('error', $e->getMessage());
        }
    }
}
