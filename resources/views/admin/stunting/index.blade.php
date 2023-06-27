@extends('layouts.master')
@section('content')
    <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">Data Pasien Stunting</h5>
                <div class="col-sm-4">
                    <a class="btn btn-primary m-3" href="/dashboard/stunting/create"> Tambah Data</a>
                </div>
                <div class="col-sm-4 m-3">
                    <p><Span>Note : <b>R</b> = <b>Rata-Rata</b></Span></p>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" id="tenun">
                        <thead class="table-light">
                            <tr>
                                <th style="width:20px">No.</th>
                                <th style="width:20px">Nama Kecamatan</th>
                                <th style="width:20px">Jumlah Stunting</th>
                                <th style="width:20px">R.Usia</th>
                                <th style="width:20px">R.Berat Badan</th>
                                <th style="width:20px">R.Tinggi Badan</th>
                                {{-- <th style="width:20px">ting</th> --}}
                                <th style="width:20px">#</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                @forelse ($data_stunting as $p)
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->nama_kecamatan }}</td>
                                    <td>{{ $p->jumlah_stunting }}</td>
                                    <td>{{ $p->usia }}</td>
                                    <td>{{ $p->berat_badan }}</td>
                                    <td>{{ $p->tinggi_badan }}</td>
                                    {{-- <td>{{ $p->tingkat_stunting }}</td> --}}

                                    <td>
                                        <form action="/dashboard/stunting/{{ $p->id_stunting }}" method="POST">
                                            <a
                                                href="/dashboard/stunting/{{ $p->id_stunting }}/edit"class="btn btn-success btn-sm">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" href="{{ $p->id_stunting }} </a>"
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
