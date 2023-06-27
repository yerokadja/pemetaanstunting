@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">Dataset yang akan dihitung</h5>
                <div class="card-body">
                    <div class="col-lg">
                        <table class="table" id="tenun">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kecamtan</th>
                                    <th>tinggi_badan</th>
                                    <th>Berat Badan</th>
                                    <th style="width:20px">#</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    @forelse ($data as $p)
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->nama_kecamatan }} </td>
                                        <td>{{ $p->tinggi_badan }} </td>
                                        <td>{{ $p->berat_badan }}</td>
                                </tr>
                            @empty
                                <td colspan="10" class="text-center"> Tidak ada data .. </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary m-3" id="tombol-perhitungan" onclick="togglePerhitungan()">
                Mulai Hitung</button>
            <div class="col-lg">
                <div id="hitung" class="card">
                    <div class="card-header">
                        <h5 class="mt-2"></h5>
                        <h5>Hasil Normalisasi Model Min Max</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped mb-2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kecamatan</th>
                                    <th>Tinggi Badan</th>
                                    <th>Berat Badan</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @php
                                    $tinggiBadanTotal = 0;
                                    $beratBadanTotal = 0;
                                @endphp
                                @foreach ($normalizedData as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data['nama_kecamatan'] }}</td>
                                        <td>{{ round($data['tinggi_badan']) }}</td>
                                        <td>{{ round($data['berat_badan']) }}</td>
                                    </tr>
                                    @php
                                        $tinggiBadanTotal += $data['tinggi_badan'];
                                        $beratBadanTotal += $data['berat_badan'];
                                    @endphp
                                @endforeach
                                <tr>
                                    <td colspan="2"><b>Jumlah<b></td>
                                    <td>{{ round($tinggiBadanTotal) }}</td>
                                    <td>{{ round($beratBadanTotal) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-header">
                        <h5 class="mt-2"></h5>
                        <h5>Centroid Awal</h5>
                    </div>

                    <table class="table table-striped mb-2">
                        <thead>
                            <tr>
                                <th>Centroid</th>
                                <th>Tinggi Badan</th>
                                <th>Berat Badan</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($centroids as $index => $centroid)
                                <tr>
                                    <td>Centroid {{ $index + 1 }}</td>
                                    <td>{{ round($centroid['tinggi_badan']) }}</td>
                                    <td>{{ round($centroid['berat_badan']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-header">
                        <h5 class="mt-2"></h5>
                        <h5>Jarak Terdekat</h5>
                    </div>
                    <table class="table table-striped mb-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kecamatan</th>
                                <th>Tinggi Badan</th>
                                <th>Berat Badan</th>
                                <th>Centroid Terdekat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jarakTerdekat as $index => $jarak)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $jarak['data']['nama_kecamatan'] }}</td>
                                    <td>{{ round($jarak['data']['tinggi_badan']) }}</td>
                                    <td>{{ round($jarak['data']['berat_badan']) }}</td>
                                    <td>K{{ $jarak['centroid'] + 1 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-header">
                        <h5 class="mt-2"></h5>
                        <h5>Pengelompokan Objek Iterasi 1</h5>
                    </div>
                    <table class="table table-striped mb-2">
                        <thead>
                            <tr>
                                {{-- <th>No</th> --}}
                                <th>Kecamatan</th>
                                <th>Tinggi Badan</th>
                                <th>Berat Badan</th>
                                <th>Cluster</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clusters as $index => $cluster)
                                @foreach ($cluster as $item)
                                    <tr>
                                        <td>{{ $item['nama_kecamatan'] }}</td>
                                        <td>{{ round($item['tinggi_badan']) }}</td>
                                        <td>{{ round($item['berat_badan']) }}</td>
                                        <td>K{{ $index + 1 }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            {{-- <tr>
                                <td colspan="2"><b>Jumlah<b></td>
                                <td>{{ round($tinggiBadanTotal) }}</td>
                                <td>{{ round($beratBadanTotal) }}</td>
                                <td></td>
                            </tr> --}}
                        </tbody>
                    </table>
                    <div class="card-header">
                        <h5 class="mt-2"></h5>
                        <h5>Penentu Cluster Baru Iterasi 2</h5>
                    </div>
                    @foreach ($newClusters as $index => $cluster)
                        <div class="card-header">
                            <h5 class="mt-2"></h5>
                            <h5>K {{ $index + 1 }}</h5>
                        </div>
                        <table class="table table-striped mb-2">
                            <thead>
                                <tr>
                                    <th>Nama Kecamatan</th>
                                    <th>Tinggi Badan</th>
                                    <th>Berat Badan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cluster as $item)
                                    <tr>
                                        <td>{{ $item['nama_kecamatan'] }}</td>
                                        <td>{{ round($item['tinggi_badan']) }}</td>
                                        <td>{{ round($item['berat_badan']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach

                    <div class="card-header">
                        <h5 class="mt-2"></h5>
                        <h5>Pengelompokan Objek Iterasi 2</h5>
                    </div>
                    @foreach ($newClusters as $index => $cluster)
                        <div class="card-header">
                            <h5 class="mt-2"></h5>
                            <h5>K {{ $index + 1 }}</h5>
                        </div>
                        <table class="table table-striped mb-2">
                            <thead>
                                <tr>
                                    <th>Tinggi Badan</th>
                                    <th>Berat Badan</th>
                                    <th>Kecamatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cluster as $item)
                                    <tr>
                                        <td>{{ round($item['tinggi_badan']) }}</td>
                                        <td>{{ round($item['berat_badan']) }}</td>
                                        <td>{{ $item['nama_kecamatan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach

                    <div class="card-header">
                        <h5 class="mt-2"></h5>
                        <h5>Penentu Objek Iterasi 3</h5>
                    </div>
                    @foreach ($newClusters2 as $index => $cluster)
                        <div class="card-header">
                            <h5 class="mt-2"></h5>
                            <h5>K {{ $index + 1 }}</h5>
                        </div>
                        {{-- <p>Centroid: Tinggi Badan = {{ $newCentroids2[$index]['tinggi_badan'] }}, Berat Badan =
                            {{ $newCentroids2[$index]['berat_badan'] }}</p> --}}
                        <table class="table table-striped mb-2">
                            <thead>
                                <tr>
                                    <th>Tinggi Badan</th>
                                    <th>Berat Badan</th>
                                    <th>Kecamatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cluster as $item)
                                    <tr>
                                        <td>{{ round($item['tinggi_badan']) }}</td>
                                        <td>{{ round($item['berat_badan']) }}</td>
                                        <td>{{ $item['nama_kecamatan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach

                    <div class="card-header">
                        <h5 class="mt-2"></h5>
                        <h5>Pengelompokan Objek Iterasi 3</h5>
                    </div>
                    @foreach ($newClusters2 as $index => $cluster)
                        <div class="card-header">
                            <h5 class="mt-2"></h5>
                            <h5>K {{ $index + 1 }}</h5>
                        </div>
                        <table class="table table-striped mb-2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tinggi Badan</th>
                                    <th>Berat Badan</th>
                                    <th>Kecamatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cluster as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item['tinggi_badan'] }}</td>
                                        <td>{{ $item['berat_badan'] }}</td>
                                        <td>{{ $item['nama_kecamatan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach

                    <div class="card-header">
                        <h5 class="mt-2"></h5>
                        <h5>Penentuan Objek Iterasi 4</h5>
                    </div>

                    @foreach ($newClusters4 as $index => $cluster)
                        <div class="card-header">
                            <h5 class="mt-2"></h5>
                            <h5>K {{ $index + 1 }}</h5>
                        </div>
                        <table class="table table-striped mb-2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tinggi Badan</th>
                                    <th>Berat Badan</th>
                                    <th>Kecamatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cluster as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item['tinggi_badan'] }}</td>
                                        <td>{{ $item['berat_badan'] }}</td>
                                        <td>{{ $item['nama_kecamatan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach

                    <div class="card-header">
                        <h5 class="mt-2"></h5>
                        <h5>Pengelompokan Objek Iterasi 4</h5>
                    </div>
                    @foreach ($newClusters4 as $index => $cluster)
                        <div class="card-header">
                            <h5 class="mt-2"></h5>
                            <h5>K {{ $index + 1 }}</h5>
                        </div>
                        <table class="table table-striped mb-2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tinggi Badan</th>
                                    <th>Berat Badan</th>
                                    <th>Kecamatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cluster as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item['tinggi_badan'] }}</td>
                                        <td>{{ $item['berat_badan'] }}</td>
                                        <td>{{ $item['nama_kecamatan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                    <div class="card-header">
                        <h5 class="mt-2"></h5>
                        <h5>Penentuan Objek Iterasi 5</h5>
                    </div>
                    @foreach ($newClusters5 as $index => $cluster)
                        <div class="card-header">
                            <h5 class="mt-2"></h5>
                            <h5>K {{ $index + 1 }}</h5>
                        </div>
                        <table class="table table-striped mb-2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tinggi Badan</th>
                                    <th>Berat Badan</th>
                                    <th>Kecamatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cluster as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item['tinggi_badan'] }}</td>
                                        <td>{{ $item['berat_badan'] }}</td>
                                        <td>{{ $item['nama_kecamatan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach

                    <div class="card-header">
                        <h5 class="mt-2"></h5>
                        <h5>Pengelompokan Objek Iterasi 5</h5>
                    </div>
                    @foreach ($newClusters5 as $index => $cluster)
                        <div class="card-header">
                            <h5 class="mt-2"></h5>
                            <h5>K {{ $index + 1 }}</h5>
                        </div>
                        <table class="table table-striped mb-2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tinggi Badan</th>
                                    <th>Berat Badan</th>
                                    <th>Kecamatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cluster as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item['tinggi_badan'] }}</td>
                                        <td>{{ $item['berat_badan'] }}</td>
                                        <td>{{ $item['nama_kecamatan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                    <div class="card-header">
                        <h5 class="mt-2"></h5>
                        <h5>Hasil Final Pengelompokan Iterasi 4 dan 5</h5>
                    </div>

                    <table class="table table-striped mb-2">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kelompok 4</th>
                                <th scope="col">Kelompok 5</th>
                                <th scope="col">Kecamatan</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($newClusters4 as $key => $cluster4)
                                @foreach ($cluster4 as $item4)
                                    <tr>
                                        <th scope="row">{{ $index++ }}</th>
                                        <td>{{ 'K' . ($key + 1) }}</td>
                                        <td>{{ isset($newClusters5[$key]) ? 'K' . ($key + 1) : '' }}</td>
                                        <td>{{ $item4['nama_kecamatan'] }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            @foreach ($newClusters5 as $key => $cluster5)
                                @foreach ($cluster5 as $item5)
                                    <tr>
                                        <th scope="row">{{ $index++ }}</th>
                                        <td>{{ isset($newClusters4[$key]) ? 'K' . ($key + 1) : '' }}</td>
                                        <td>{{ 'K' . ($key + 1) }}</td>
                                        <td>{{ $item5['nama_kecamatan'] }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
    <style>
        #hitung {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </script>
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
            $('#tenun').DataTable({});
        });
    </script>

    <script>
        var isHitungShown = false;

        function togglePerhitungan() {
            if (!isHitungShown) {
                Swal.fire({
                    title: 'Tunggu Sebentar',
                    html: 'Sedang <b></b> menghitung.',
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        setTimeout(() => {
                            if (!isHitungShown) {
                                $('#hitung').show();
                                isHitungShown = true;
                                document.getElementById('tombol-perhitungan').innerHTML =
                                    'Tutup Langkah Perhitungan';
                            }
                        }, 0);
                    }
                });
            } else {
                $('#hitung').hide();
                isHitungShown = false;
                document.getElementById('tombol-perhitungan').innerHTML = 'Tampilkan Langkah Perhitungan';
            }
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
