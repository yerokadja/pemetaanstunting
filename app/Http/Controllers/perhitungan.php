<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\hasil_cluster;
use App\Models\HasilCluster;
use App\Models\Stunting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Perhitungan extends Controller
{
    public function show()
    {
        $data = DB::table('stuntings')
            ->select('stuntings.kecamatan_id', 'stuntings.tinggi_badan', 'stuntings.berat_badan', 'kecamatans.nama_kecamatan')
            ->join('kecamatans', 'stuntings.kecamatan_id', '=', 'kecamatans.id_kecamatan')
            ->get();

        $Stunting = Stunting::count();

        if ($Stunting == 0) {
            return redirect()->back()->with('error', 'Tidak ada data Stunting yang tersedia.');
        }

        $normalizedData = $this->minMaxNormalization($data);

        $k = 3;

        $centroids = $this->hitungCentroidAwal($normalizedData, $k);
        $jarakTerdekat = $this->hitungJarakTerdekat($normalizedData, $centroids);

        $clusters = $this->pengelompokanObjekIterasi1($normalizedData, $centroids, $jarakTerdekat);

        list($newClusters, $newCentroids) = $this->penentuClusterBaruIterasi2($normalizedData, $centroids, $clusters);

        $newClusters = $this->pengelompokanObjekIterasi2($normalizedData, $newCentroids);

        list($newClusters2, $newCentroids2) = $this->penentuClusterBaruIterasi3($normalizedData, $newCentroids, $newClusters);


        $newClusters3 = $this->pengelompokanObjekIterasi3($normalizedData, $newCentroids2);
        list($newClusters4, $newCentroids4) = $this->penentuClusterBaruIterasi3($normalizedData, $newCentroids2, $newClusters3);

        // Pengelompokan Objek Iterasi 4
        $newClusters4 = $this->pengelompokanObjekIterasi4($normalizedData, $newCentroids4);

        // Pengelompokan Objek Iterasi 5
        $newClusters5 = $this->pengelompokanObjekIterasi5($normalizedData, $newCentroids4);
        list($newClusters5, $newCentroids5) = $this->penentuClusterBaruIterasi5($normalizedData, $newCentroids4, $newClusters5);
        // dd($newClusters5);

        DB::table('hasil_clusters')->truncate(); // Mengosongkan tabel
        DB::statement('ALTER TABLE hasil_clusters AUTO_INCREMENT = 1');
        foreach ($newClusters5 as $index => $cluster) {
            foreach ($cluster as $key => $item) {
                $clusterResult = new hasil_cluster();
                $clusterResult->cluster_id   = $index + 1;
                $clusterResult->kecamatan_id = $item['kecamatan_id'];
                $clusterResult->save();
            }
        }


        $title = 'Penilaian K-means';
        return view('admin.alur.index', compact('data', 'normalizedData', 'centroids', 'jarakTerdekat', 'clusters', 'newClusters', 'newCentroids', 'newClusters2', 'newCentroids2', 'newClusters3', 'newCentroids4', 'newClusters4', 'newClusters5', 'newCentroids5', 'title'));
    }

    private function minMaxNormalization($data)
    {
        $normalizedData = [];

        $minTinggiBadan = $data->min('tinggi_badan');
        $maxTinggiBadan = $data->max('tinggi_badan');
        $minBeratBadan = $data->min('berat_badan');
        $maxBeratBadan = $data->max('berat_badan');

        foreach ($data as $item) {
            $normalizedTinggiBadan = ($item->tinggi_badan - $minTinggiBadan) / ($maxTinggiBadan - $minTinggiBadan);
            $normalizedBeratBadan = ($item->berat_badan - $minBeratBadan) / ($maxBeratBadan - $minBeratBadan);

            $normalizedData[] = [
                'tinggi_badan'   => $normalizedTinggiBadan,
                'berat_badan'    => $normalizedBeratBadan,
                'nama_kecamatan' => $item->nama_kecamatan,
                'kecamatan_id'  => $item->kecamatan_id,
            ];
        }
        return $normalizedData;
    }


    private function hitungCentroidAwal($normalizedData, $k)
    {
        $centroids = [];

        $totalData = count($normalizedData);
        $randomIndexes = array_rand($normalizedData, $k);

        if (!is_array($randomIndexes)) {
            $randomIndexes = [$randomIndexes];
        }

        foreach ($randomIndexes as $index) {
            $centroids[] = [
                'tinggi_badan' => $normalizedData[intval($index)]['tinggi_badan'],
                'berat_badan' => $normalizedData[intval($index)]['berat_badan'],
                'nama_kecamatan' => $normalizedData[intval($index)]['nama_kecamatan'],
            ];
        }

        return $centroids;
    }


    private function hitungJarakTerdekat($data, $centroids)
    {
        $jarakTerdekat = [];

        foreach ($data as $item) {
            $jarakMin = INF;
            $nearestCentroid = null;

            foreach ($centroids as $index => $centroid) {
                $jarak = sqrt(pow($item['tinggi_badan'] - $centroid['tinggi_badan'], 2) + pow($item['berat_badan'] - $centroid['berat_badan'], 2));

                if ($jarak < $jarakMin) {
                    $jarakMin = $jarak;
                    $nearestCentroid = $index;
                }
            }
            $jarakTerdekat[] = [
                'data' => $item,
                'centroid' => $nearestCentroid,
            ];
        }

        return $jarakTerdekat;
    }

    private function pengelompokanObjekIterasi1($data, $centroids, $jarakTerdekat)
    {
        $clusters = [];

        foreach ($jarakTerdekat as $item) {
            $centroidIndex = $item['centroid'];

            if (!isset($clusters[$centroidIndex])) {
                $clusters[$centroidIndex] = [];
            }

            $clusters[$centroidIndex][] = [
                'tinggi_badan' => $item['data']['tinggi_badan'],
                'berat_badan' => $item['data']['berat_badan'],
                'nama_kecamatan' => $item['data']['nama_kecamatan'],
            ];
        }

        return $clusters;
    }

    private function penentuClusterBaruIterasi2($normalizedData, $centroids, $clusters)
    {
        $newClusters = [];
        $newCentroids = [];

        foreach ($clusters as $index => $cluster) {
            $newCluster = [];

            foreach ($cluster as $item) {
                $newCluster[] = [
                    'tinggi_badan' => $item['tinggi_badan'],
                    'berat_badan' => $item['berat_badan'],
                    'nama_kecamatan' => $item['nama_kecamatan'],
                ];
            }
            $newCentroid = $this->hitungCentroidAwal($newCluster, 1); // Menggunakan hitungCentroidAwal dengan k=1

            $newClusters[$index] = $newCluster;
            $newCentroids[$index] = $newCentroid[0]; // Mengambil centroid pertama dari hitungCentroidAwal

        }

        return [$newClusters, $newCentroids];
    }

    private function pengelompokanObjekIterasi2($normalizedData, $newCentroids)
    {
        $clusters = [];

        foreach ($normalizedData as $item) {
            $jarakMin = INF;
            $nearestCentroid = null;

            foreach ($newCentroids as $index => $centroid) {
                $jarak = sqrt(pow($item['tinggi_badan'] - $centroid['tinggi_badan'], 2) + pow($item['berat_badan'] - $centroid['berat_badan'], 2));

                if ($jarak < $jarakMin) {
                    $jarakMin = $jarak;
                    $nearestCentroid = $index;
                }
            }

            if (!isset($clusters[$nearestCentroid])) {
                $clusters[$nearestCentroid] = [];
            }

            $clusters[$nearestCentroid][] = [
                'tinggi_badan' => $item['tinggi_badan'],
                'berat_badan' => $item['berat_badan'],
                'nama_kecamatan' => $item['nama_kecamatan'],
            ];
        }

        return $clusters;
    }

    private function penentuClusterBaruIterasi3($normalizedData, $centroids, $clusters)
    {
        $newClusters = [];
        $newCentroids = [];

        foreach ($clusters as $index => $cluster) {
            $newCluster = [];

            foreach ($cluster as $item) {
                $newCluster[] = [
                    'tinggi_badan' => $item['tinggi_badan'],
                    'berat_badan' => $item['berat_badan'],
                    'nama_kecamatan' => $item['nama_kecamatan'],
                ];
            }

            $newCentroid = $this->hitungCentroid($newCluster); // Menggunakan hitungCentroid() tanpa parameter k

            $newClusters[$index] = $newCluster;
            $newCentroids[$index] = $newCentroid;
        }

        return [$newClusters, $newCentroids];
    }
    private function pengelompokanObjekIterasi3($normalizedData, $newCentroids)
    {
        $clusters = [];

        foreach ($normalizedData as $item) {
            $jarakMin = INF;
            $nearestCentroid = null;

            foreach ($newCentroids as $index => $centroid) {
                $jarak = sqrt(pow($item['tinggi_badan'] - $centroid['tinggi_badan'], 2) + pow($item['berat_badan'] - $centroid['berat_badan'], 2));

                if ($jarak < $jarakMin) {
                    $jarakMin = $jarak;
                    $nearestCentroid = $index;
                }
            }

            if (!isset($clusters[$nearestCentroid])) {
                $clusters[$nearestCentroid] = [];
            }

            $clusters[$nearestCentroid][] = [
                'tinggi_badan' => $item['tinggi_badan'],
                'berat_badan' => $item['berat_badan'],
                'nama_kecamatan' => $item['nama_kecamatan'],
            ];
        }

        return $clusters;
    }

    private function penentuClusterBaruIterasi4($normalizedData, $centroids, $clusters)
    {
        $newClusters = [];
        $newCentroids = [];

        foreach ($clusters as $index => $cluster) {
            $newCluster = [];

            foreach ($cluster as $item) {
                $newCluster[] = [
                    'tinggi_badan' => $item['tinggi_badan'],
                    'berat_badan' => $item['berat_badan'],
                    'nama_kecamatan' => $item['nama_kecamatan'],
                ];
            }

            $newCentroid = $this->hitungCentroid($newCluster);

            $newClusters[$index] = $newCluster;
            $newCentroids[$index] = $newCentroid;
        }

        return [$newClusters, $newCentroids];
    }
    private function pengelompokanObjekIterasi4($data, $centroids)
    {
        $clusters = [];

        foreach ($data as $objek) {
            $jarakTerdekat = PHP_FLOAT_MAX;
            $clusterIndex = null;

            foreach ($centroids as $index => $centroid) {
                $jarak = $this->hitungJarakEuclidean($objek, $centroid);
                if ($jarak < $jarakTerdekat) {
                    $jarakTerdekat = $jarak;
                    $clusterIndex = $index;
                }
            }

            $clusters[$clusterIndex][] = $objek;
        }

        return $clusters;
    }

    private function penentuClusterBaruIterasi5($normalizedData, $centroids, $clusters)
    {
        $newClusters = [];
        $newCentroids = [];

        foreach ($clusters as $index => $cluster) {
            $newCluster = [];

            foreach ($cluster as $item) {
                $newCluster[] = [
                    'tinggi_badan' => $item['tinggi_badan'],
                    'berat_badan' => $item['berat_badan'],
                    'nama_kecamatan' => $item['nama_kecamatan'],
                    'kecamatan_id' => $item['kecamatan_id'],
                ];
            }

            $newCentroid = $this->hitungCentroid($newCluster);

            $newClusters[$index] = $newCluster;
            $newCentroids[$index] = $newCentroid;
        }

        return [$newClusters, $newCentroids];
    }

    private function pengelompokanObjekIterasi5($normalizedData, $newCentroids)
    {
        $clusters = [];

        foreach ($normalizedData as $item) {
            $jarakMin = INF;
            $nearestCentroid = null;

            foreach ($newCentroids as $index => $centroid) {
                $jarak = sqrt(pow($item['tinggi_badan'] - $centroid['tinggi_badan'], 2) + pow($item['berat_badan'] - $centroid['berat_badan'], 2));

                if ($jarak < $jarakMin) {
                    $jarakMin = $jarak;
                    $nearestCentroid = $index;
                }
            }

            if (!isset($clusters[$nearestCentroid])) {
                $clusters[$nearestCentroid] = [];
            }

            $clusters[$nearestCentroid][] = [
                'tinggi_badan' => $item['tinggi_badan'],
                'berat_badan' => $item['berat_badan'],
                'nama_kecamatan' => $item['nama_kecamatan'],
                'kecamatan_id' => $item['kecamatan_id'],
            ];
        }

        return $clusters;
    }


    private function hitungJarakEuclidean($objek, $centroid)
    {
        $tinggiBadan = $objek['tinggi_badan'];
        $beratBadan = $objek['berat_badan'];
        $centroidTinggiBadan = $centroid['tinggi_badan'];
        $centroidBeratBadan = $centroid['berat_badan'];

        $jarak = sqrt(pow($tinggiBadan - $centroidTinggiBadan, 2) + pow($beratBadan - $centroidBeratBadan, 2));

        return $jarak;
    }
    private function hitungCentroid($cluster)
    {
        $totalData = count($cluster);
        $totalTinggiBadan = 0;
        $totalBeratBadan = 0;

        foreach ($cluster as $item) {
            $totalTinggiBadan += $item['tinggi_badan'];
            $totalBeratBadan += $item['berat_badan'];
        }

        $centroidTinggiBadan = $totalTinggiBadan / $totalData;
        $centroidBeratBadan = $totalBeratBadan / $totalData;

        return [
            'tinggi_badan' => $centroidTinggiBadan,
            'berat_badan' => $centroidBeratBadan,
        ];
    }

    public function hasil()
    {

        $data = DB::table('kecamatans')
            ->select('hasil_clusters.cluster_id', 'hasil_clusters.kecamatan_id', 'hasil_clusters.kecamatan_id', 'kecamatans.nama_kecamatan')
            ->join('hasil_clusters', 'hasil_clusters.kecamatan_id', '=', 'kecamatans.id_kecamatan')
            ->get();
        $title = 'Hasil Perhitungan';
        return view('admin.hasil.index', [
            'title' => $title,
            'hasil' => $data,
        ]);
    }
}
