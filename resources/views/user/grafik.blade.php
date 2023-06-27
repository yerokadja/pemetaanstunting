@extends('user.layouts.layouts')
@section('content')
    <section id="appointment" data-stellar-background-ratio="3">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-6">
                    <img src="/assets/user/images/appointment-image.jpg" class="img-responsive" alt="">
                </div>
                <div class="col-md-6 col-sm-12">
                    <!-- CONTACT FORM HERE -->
                    <form id="appointment-form" role="form" method="post" action="#">

                        <!-- SECTION TITLE -->
                        <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                            <h2>Grafik Data Pasien Stunting & Normal</h2>
                        </div>
                        <div class="wow fadeInUp" data-wow-delay="0.8s">
                            <canvas class="px-2" id="myChart"></canvas>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                    label: 'Stunting',
                    data: [
                        @foreach ($data as $key => $value)
                            @for ($i = 1; $i <= 12; $i++)
                                @if (isset($value[$i]['Stunting']))
                                    {{ $value[$i]['Stunting'] }},
                                @else
                                    0,
                                @endif
                            @endfor
                        @endforeach
                    ],
                    backgroundColor: 'rgba(255, 0, 0, 0.2)',
                    borderColor: 'rgba(255, 0, 0, 1)',
                    borderWidth: 2
                }, {
                    label: 'Normal',
                    data: [
                        @foreach ($data as $key => $value)
                            @for ($i = 1; $i <= 12; $i++)
                                @if (isset($value[$i]['Normal']))
                                    {{ $value[$i]['Normal'] }},
                                @else
                                    0,
                                @endif
                            @endfor
                        @endforeach
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
