@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">Data Kecamatan</h5>
                <div class="col-sm-4">
                    <a class="btn btn-primary m-3" href="/dashboard/kecamatan/create">Tambah Data</a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table" id="tenun">
                        <thead class="table-light">
                            <tr>
                                <th style="width:30px">No</th>
                                <th style="width:40px">Kode Kecamtan</th>
                                <th style="width:20px">Nama Kecamtan</th>
                                <th>Warna</th>
                                <th>Geo Json</th>
                                <th style="width:20px">#</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                @forelse ($kecamatan as $p)
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->kode_kecamatan }}</td>
                                    <td>{{ $p->nama_kecamatan }} </td>
                                    <td>
                                        <div style="width: 70px; height: 30px; background-color: {{ $p->warna }};">
                                        </div>
                                    </td>
                                    <td>{{ $p->file_geo_json }}</td>
                                    <td>
                                        <form action="/dashboard/kecamatan/{{ $p->id_kecamatan }}" method="POST">
                                            <a
                                                href="/dashboard/kecamatan/{{ $p->id_kecamatan }}/edit"class="btn btn-success btn-sm">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" href="{{ $p->id_kecamatan }} </a>"
                                                class="btn btn-danger btn-sm"> <i class="bx bx-trash"></i></button>
                                        </form>
                                    </td>
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
