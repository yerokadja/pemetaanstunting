@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">Data Variable Stunting</h5>
                <div class="col-sm-4">
                    <a class="btn btn-primary m-3" href="/dashboard/variable/create"> Tambah Data</a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table" id="tenun">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Desa</th>
                                <th>Rata-Rata TB</th>
                                <th>Rata-Rata BB</th>
                                <th style="width:10px"># </th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                @forelse ($variable as $p)
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->lokasi_desa }}</td>
                                    <td>{{ $p->berat_badan }}</td>
                                    <td>{{ $p->tinggi_badan }} </td>
                                    <td>
                                        <form action="/dashboard/variable/{{ $p->id_variable }}" method="POST">
                                            <a
                                                href="/dashboard/variable/{{ $p->id_variable }}/edit"class="btn btn-success btn-sm">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"> <i
                                                    class="bx bx-trash"></i></button>
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
