@extends('user.layouts.layouts')
@section('content')
    <section class="m-5" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!-- SECTION TITLE -->
                    <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                        <h2>Data Pasien</h2>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12">
                    <div class="about-info">
                        <div class="table-responsive text-nowrap">
                            <table class="table" id="tenun">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Tinggi badan</th>
                                        <th>Berat Badan</th>
                                        <th>Lingkar Badan</th>
                                        <th>Lingkar Perut</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        @foreach ($pasien as $p)
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->nama }}</td>
                                            <td>{{ $p->jenis_kelamin }} </td>
                                            <td>{{ $p->alamat }}</td>
                                            <td>{{ $p->tinggi_badan }} {{ $p->tinggi_badan_satuan }}</td>
                                            <td>{{ $p->berat_badan }} {{ $p->berat_badan_satuan }}</td>
                                            <td>{{ $p->lingkar_badan }}</td>
                                            <td>{{ $p->lingkar_perut }}</td>
                                            <td>
                                                @if ($p->status == 'Stunting')
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm">{{ $p->status }}</button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-primary btn-sm">{{ $p->status }}</button>
                                                @endif
                                            </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        $.noConflict();
        jQuery(document).ready(function($) {
            $('#tenun').DataTable({

            });
            $('#searchInput').on('keyup', function() {
                $('#myTable').DataTable().columns(2).search(this.value).draw();
            });
        });
    </script>
@endsection
