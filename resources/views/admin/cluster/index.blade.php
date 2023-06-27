@extends('layouts.master')
@section('content')
    <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">Data Cluster</h5>
                <div class="col-sm-4">
                    <a class="btn btn-primary m-3" href="/dashboard/cluster/create"> Tambah Data</a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" id="tenun">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px">No.</th>
                                <th>Data Cluster </th>
                                <th style="width:10px"># </th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                @foreach ($cluster as $p)
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->nama_cluster }}</td>
                                    <td>
                                        <form action="/dashboard/cluster/{{ $p->id_cluster }}" method="POST">

                                            <a
                                                href="/dashboard/cluster/{{ $p->id_cluster }}/edit"class="btn btn-success btn-sm">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"> <i
                                                    class="bx bx-trash"></i></button>
                                        </form>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $.noConflict();
        jQuery(document).ready(function($) {
            $('#tenun').DataTable({
                dom: 'Bftrip',
                button: [
                    'copy', 'pdf', 'csv', 'excel', 'print'
                ]
            });
        });
    </script>
@endsection
