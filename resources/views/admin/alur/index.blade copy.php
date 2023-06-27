@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">Hasil Penilian Metode K-means</h5>
                <div class="col-sm-4">
                </div>
                @foreach ($clusters as $clusterIndex => $cluster)
                    <h2 class="ml-2">K {{ $clusterIndex + 1 }}</h2>
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="k{{ $clusterIndex + 1 }}">
                            <thead class="table-light">
                                <tr>
                                    <th>Data Ke </th>
                                    <th style="width: 20px">jumlah_stunting</th>
                                    <th>Usia</th>
                                    <th>Tinggi Badan</th>
                                    <th>Berat Badan</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($cluster as $data)
                                    <tr>
                                        <td>{{ $data->id_stunting }}</td>
                                        <td>{{ $data->jumlah_stunting }}</td>
                                        <td>{{ $data->usia }}</td>
                                        <td>{{ $data->tinggi_badan }}</td>
                                        <td>{{ $data->berat_badan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                @endforeach
            </div>
        </div>
        <button class="btn btn-primary sm ml-5" id="next-step-btn">Tampilkan Perhitungan</button>
    </div>

    <script>
        $.noConflict();
        jQuery(document).ready(function($) {
            $('#k1').DataTable({});
            $('#k2').DataTable({});
            $('#k3').DataTable({});
        });
    </script>
@endsection
