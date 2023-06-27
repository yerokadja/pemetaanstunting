@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">Hasil Perhitungan</h5>
                {{-- <div class="col-sm-4">
                    <a class="btn btn-primary m-3" href="/dashboard/kecamatan/create">Tambah Data</a>
                </div> --}}
                <div class="table-responsive text-nowrap">
                    <table class="table" id="tenun">
                        <thead class="table-light">
                            <tr>
                                <th style="width:30px">No</th>
                                <th>Data Ke</th>
                                <th>Nama Kecamtan</th>
                                <th>Cluster</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                @forelse ($hasil as $p)
                                    <td>{{ $loop->iteration }}</td>
                                    <td>Data Ke-{{ $p->kecamatan_id }}</td>
                                    <td>{{ $p->nama_kecamatan }} </td>
                                    <td>K{{ $p->cluster_id }}</td>
                            </tr>
                        @empty
                            <td colspan="10" class="text-center"> Tidak ada data .. </td>
                            @endforelse
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
