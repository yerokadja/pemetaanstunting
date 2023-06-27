@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">Hasil Penilian Metode K-means</h5>
                <div class="col-sm-4">
                </div>
                @foreach ($clusters as $index => $cluster)
                    <h2>K {{ $index + 1 }}</h2>
                    <table class="table ml-5" id="k{{ $index + 1 }}">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Data Ke</th>
                                {{-- <th>Jumlah Stunting</th>
                                <th>Usia</th> --}}
                                <th>Tinggi Badan</th>
                                <th>Berat Badan</th>
                                <th style="width: 210px">Pusat Cluster Terdekat</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($cluster as $record)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $record->id_stunting }}</td>
                                    {{-- <td>{{ $record->jumlah_stunting }}</td>
                                    <td>{{ $record->usia }}</td> --}}
                                    <td>{{ $record->tinggi_badan }}</td>
                                    <td>{{ $record->berat_badan }}</td>
                                    <td style="width: 60px" id="{{ $record->id_stunting }}">
                                        @php
                                            $distances = [];
                                            foreach ($centroids as $centroid) {
                                                $distance = sqrt(pow($record->jumlah_stunting - $centroid->jumlah_stunting, 2) + pow($record->usia - $centroid->usia, 2) + pow($record->tinggi_badan - $centroid->tinggi_badan, 2) + pow($record->berat_badan - $centroid->berat_badan, 2));
                                                $distances[] = $distance;
                                            }

                                            $closestCluster = array_keys($distances, min($distances))[0];
                                            echo 'K ' . ($closestCluster + 1);
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                @endforeach
            </div>

            <button type="button" class="btn btn-primary m-3" id="tombol-perhitungan"
                onclick="togglePerhitungan()">Tampilkan Langkah Perhitungan</button>


            <div class="col-lg">
                <div id="hitung" class="card">
                    <div class="card-header">
                        <h5 class="mt-2">Iterasi: 1</h5>
                        <h4>Centroids Awal</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped mb-2">
                            <tr>
                                <th>Centroid</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($centroids as $index => $centroid)
                                <tr>
                                    <td>K{{ $index + 1 }}</td>
                                    <td>{{ round($centroid->tinggi_badan) }}</td>
                                    <td>{{ round($centroid->berat_badan) }}</td>
                                </tr>
                            @endforeach
                        </table>

                        <table class="table table-striped">
                            <tr>
                                <th>Cluster</th>
                                <th>Tinggi Badan</th>
                                <th>Berat Badan</th>
                                <th>Jarak ke Centroid</th>
                                <th>Jarak Terdekat</th>
                            </tr>
                            @foreach ($clusters as $clusterIndex => $cluster)
                                @foreach ($cluster as $record)
                                    <tr>
                                        <td>K {{ $clusterIndex + 1 }}</td>
                                        <td>{{ $record->tinggi_badan }}</td>
                                        <td>{{ $record->berat_badan }}</td>
                                        <td>{{ round($record->jarak_ke_centroid) }}</td>
                                        <td>{{ round($record->jarak_terdekat['tinggi_badan'], 2) }},
                                            {{ round($record->jarak_terdekat['berat_badan'], 2) }}</td>

                                    </tr>
                                @endforeach
                            @endforeach
                        </table>
                        <h4 class="m-3">Centroids Baru</h4>
                        <table class="table table-striped">
                            <tr>
                                <th>Cluster</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($centroidss as $index => $centroid)
                                <tr>
                                    <td>K{{ $index + 1 }}</td>
                                    <td>{{ round($centroid->tinggi_badan, 2) }}</td>
                                    <td>{{ round($centroid->berat_badan, 2) }}</td>
                                </tr>
                            @endforeach
                        </table>
                        <h3 class="mt-2">Iterasi: 2 </h3>
                        <h5 class="m-3">Centroids awal</h5>
                        <table class="table table-striped">
                            <tr>
                                <th>Cluster</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($centroidss as $index => $centroid)
                                <tr>
                                    <td>K{{ $index + 1 }}</td>
                                    <td>{{ round($centroid->tinggi_badan, 2) }}</td>
                                    <td>{{ round($centroid->berat_badan, 2) }}</td>
                                </tr>
                            @endforeach
                        </table>
                        <h5 class="m-3">Centroids Baru</h5>
                        <table class="table table-striped">
                            <tr>
                                <th>Cluster</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($centroidss as $index => $centroid)
                                <tr>
                                    <td>K{{ $index + 1 }}</td>
                                    <td>{{ round($centroid->tinggi_badan, 2) }}</td>
                                    <td>{{ round($centroid->berat_badan, 2) }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #hitung {
            display: none;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#hitung').hide();
            $('[data-target="#hitung"]').click(function() {
                $($(this).data('target')).show();
                $('html, body').animate({
                    scrollTop: $($(this).data('target')).offset().top
                }, 800);
            });
        });
    </script>
    <script>
        $.noConflict();
        jQuery(document).ready(function($) {
            $('#k1').DataTable({});
            $('#k2').DataTable({});
            $('#k3').DataTable({});
        });
    </script>
    <script>
        function togglePerhitungan() {
            var button = document.getElementById('tombol-perhitungan');
            var card = document.getElementById('hitung');

            if (card.style.display === 'none') {
                card.style.display = 'block';
                button.innerHTML = 'Tutup Langkah Perhitungan';
            } else {
                card.style.display = 'none';
                button.innerHTML = 'Tampilkan Langkah Perhitungan';
            }
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
