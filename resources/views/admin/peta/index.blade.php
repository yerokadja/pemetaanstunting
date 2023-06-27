@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

                <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md-12">
                                <h5 class="card-header m-0 me-2 pb-3">Peta Lokasi Stunting Di Kabupaten Timor Tengah Selatan
                                </h5>
                                <div id="map" style="height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .legend {
            padding: 6px 8px;
            font: 14px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
            /*border-radius: 5px;*/
            line-height: 24px;
            color: #555;
        }

        .legend h4 {
            text-align: center;
            font-size: 16px;
            margin: 2px 12px 8px;
            color: #777;
        }

        .legend span {
            position: relative;
            bottom: 3px;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin: 0 8px 0 0;
            opacity: 0.7;
        }

        .legend i.icon {
            background-size: 18px;
            background-color: rgba(255, 255, 255, 1);
        }

        /*  */

        .kecamatan {
            padding: 6px 8px;
            font: 14px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
            /*border-radius: 5px;*/
            line-height: 24px;
            color: #555;
        }

        .kecamatan h4 {
            text-align: center;
            font-size: 16px;
            margin: 2px 12px 8px;
            color: #777;
        }

        .kecamatan span {
            position: relative;
            bottom: 3px;
        }

        .kecamatan i {
            width: 18px;
            height: 18px;
            float: left;
            margin: 0 8px 0 0;
            opacity: 0.7;
        }

        .kecamatan i.icon {
            background-size: 18px;
            background-color: rgba(255, 255, 255, 1);
        }

        .kecamatan-list {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>

    <script>
        var map = L.map('map', {
            center: [-9.8111485, 124.1608588],
            zoom: 9,
            scrollWheelZoom: false,
            doubleClickZoom: false,
            boxZoom: false,
            touchZoom: false
        });

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var legend = L.control({
            position: "bottomleft"
        });

        legend.onAdd = function(map) {
            var div = L.DomUtil.create("div", "legend");
            div.innerHTML += "<h4>Warna Tingkat Stunting</h4>";
            div.innerHTML += '<i style="background: yellow"></i><span>Ringan</span><br>';
            div.innerHTML += '<i style="background: green"></i><span>Sedang</span><br>';
            div.innerHTML += '<i style="background: red"></i><span>Parah</span><br>';
            return div;
        };

        legend.addTo(map);

        function popUp(f, l) {
            var out = [];
            if (f.properties) {
                for (key in f.properties) {
                    out.push(key + ": " + f.properties[key]);
                }
                l.bindPopup(out.join("<br />"));
            }
        }

        var kecamatan = L.control({
            position: "topright"
        });

        kecamatan.onAdd = function(map) {
            var div = L.DomUtil.create("div", "kecamatan");
            div.innerHTML += "<h4>Daftar Kecamatan</h4>";

            var kecamatanList = L.DomUtil.create("div", "kecamatan-list");

            // Perulangan kecamatan dari database
            @foreach ($kecamatan as $k)
                kecamatanList.innerHTML +=
                    '<i style="background: {{ $k->warna }}"></i><span>{{ $k->nama_kecamatan }}</span><br>';
            @endforeach

            div.appendChild(kecamatanList);

            return div;
        };

        kecamatan.addTo(map);

        function popUp(f, l) {
            var out = [];
            if (f.properties) {
                for (key in f.properties) {
                    out.push(key + ": " + f.properties[key]);
                }
                l.bindPopup(out.join("<br />"));
            }
        }
        // peta kecamatan
        var jsonTest = new L.GeoJSON.AJAX("{{ asset('assets/peta/bataskecamatan.geojson') }}", {}).addTo(map);
        // akhir


        @foreach ($stunting as $p)
            var geojson{{ $p->id_stunting }} = new L.GeoJSON.AJAX("{{ asset('assets/peta/' . $p->file_geo_json) }}", {
                style: function(feature) {
                    return {
                        fillColor: '{{ $p->warna }}',
                        weight: 2,
                        opacity: 1,
                        color: '',
                        dashArray: '3',
                        fillOpacity: 0.7
                    };
                },
                onEachFeature: function(feature, layer) {
                    var kecamatanPopupContent =
                        "Kode Kecamatan: <b>{{ $p->kode_kecamatan }}</b><br>" +
                        "Kecamatan: <b>{{ $p->nama_kecamatan }}</b><br>";
                    @if ($p->jumlah_stunting)
                        kecamatanPopupContent +=
                            "Total stunting: <b>{{ $p->jumlah_stunting }} orang</b> </br>" +
                            // "Tingkat Stunting:<b>{{ $p->tingkat_stunting }} </b> " +
                            "Kelompok Cluster: <b>K{{ $p->cluster_id }}&nbsp";

                        @if ($p->cluster_id == 1)
                            kecamatanPopupContent += "(Parah)";
                        @elseif ($p->cluster_id == 2)
                            kecamatanPopupContent += "(Sedang)";
                        @elseif ($p->cluster_id == '3')
                            kecamatanPopupContent += '(ringan)';
                        @endif
                        kecamatanPopupContent += "</b>";
                    @endif

                    layer.bindPopup(kecamatanPopupContent);

                    // Tambahkan marker di tengah kecamatan
                    var center = layer.getBounds().getCenter();
                    var tingkatStunting = '{{ $p->cluster_id }}';
                    var markerColor = '';

                    if (tingkatStunting === '3') {
                        markerColor = 'yellow';
                    } else if (tingkatStunting === '2') {
                        markerColor = 'green';
                    } else if (tingkatStunting === '1') {
                        markerColor = 'red';
                    }

                    var iconUrl =
                        'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-' +
                        markerColor + '.png';

                    var marker = L.marker(center, {
                        icon: L.icon({
                            iconUrl: iconUrl,
                            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
                            iconSize: [25, 41],
                            iconAnchor: [12, 41],
                            popupAnchor: [1, -34],
                            shadowSize: [41, 41]
                        })
                    }).addTo(map);

                    marker.on('click', function() {
                        layer.openPopup();
                    });
                }
            }).addTo(map);
        @endforeach
    </script>
@endsection
