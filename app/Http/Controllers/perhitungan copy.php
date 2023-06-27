<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Stunting;
use Illuminate\Http\Request;
use App\Services\KMeansClustering;

class Perhitungan extends Controller
{
    public function show()
    {
        $dataCount = Stunting::count();

        if ($dataCount == 0) {
            return redirect()->back()->with('error', 'Tidak ada data Stunting yang tersedia.');
        } else {

            if (session()->has('centroids')) {
                $centroids = session('centroids');
            } else {
                $k = $this->determineOptimalClusterCount();

                $centroids = $this->initializeCentroids($k);

                session(['centroids' => $centroids]);
            }

            $reassign = true;
            while ($reassign) {
                $clusters = $this->assignDataToCentroids($centroids);
                $newCentroids = $this->calculateNewCentroids($clusters);
                if ($this->centroidsAreEqual($centroids, $newCentroids)) {
                    $reassign = false;
                } else {
                    $centroids = $newCentroids;
                }
            }
            $title = 'Perhitungan Stunting';
            return view('admin.alur.index', compact('clusters', 'title'));
        }
    }

    private function determineOptimalClusterCount()
    {
        $maxClusters = 10;
        $inertias = [];

        for ($k = 1; $k <= $maxClusters; $k++) {
            $centroids = $this->initializeCentroids($k);
            $clusters = $this->assignDataToCentroids($centroids);
            $inertia = $this->calculateInertia($clusters);
            $inertias[$k] = $inertia;
        }

        $differences = [];
        for ($i = 2; $i <= $maxClusters; $i++) {
            $difference = $inertias[$i - 1] - $inertias[$i];
            $differences[$i] = $difference;
        }

        $elbowPoint = 3;
        $maxDifference = 0;
        foreach ($differences as $k => $difference) {
            if ($difference > $maxDifference) {
                $maxDifference = $difference;
                $elbowPoint = $k;
            }
        }

        return $elbowPoint;
    }

    private function initializeCentroids($k)
    {
        $centroids = [];

        $data = Stunting::inRandomOrder()->limit($k)->get();

        foreach ($data as $item) {
            $centroid = [
                'jumlah_stunting' => $item->jumlah_stunting,
                'usia' => $item->usia,
                'tinggi_badan' => $item->tinggi_badan,
                'berat_badan' => $item->berat_badan,
            ];

            $centroids[] = $centroid;
        }

        return $centroids;
    }

    private function assignDataToCentroids($centroids)
    {
        $clusters = [];

        $data = Stunting::all();
        foreach ($data as $item) {
            $minDistance = PHP_FLOAT_MAX;
            $nearestCentroidIndex = null;
            for ($i = 0; $i < count($centroids); $i++) {
                $distance = $this->calculateEuclideanDistance($item, $centroids[$i]);

                // Memperbarui centroid terdekat jika jarak lebih kecil
                if ($distance < $minDistance) {
                    $minDistance = $distance;
                    $nearestCentroidIndex = $i;
                }
            }
            $clusters[$nearestCentroidIndex][] = $item;
        }

        return $clusters;
    }

    private function calculateEuclideanDistance($pointA, $pointB)
    {
        // Menghitung jarak Euclidean antara dua titik dalam ruang atribut
        $distance = sqrt(
            pow($pointA->jumlah_stunting - $pointB['jumlah_stunting'], 2) +
                pow($pointA->usia - $pointB['usia'], 2) +
                pow($pointA->tinggi_badan - $pointB['tinggi_badan'], 2) +
                pow($pointA->berat_badan - $pointB['berat_badan'], 2)
        );

        return $distance;
    }

    private function calculateNewCentroids($clusters)
    {
        $newCentroids = [];

        foreach ($clusters as $cluster) {
            $centroid = [];
            $jumlahStuntingSum = 0;
            $usiaSum = 0;
            $tinggiBadanSum = 0;
            $beratBadanSum = 0;

            foreach ($cluster as $item) {
                $jumlahStuntingSum += $item->jumlah_stunting;
                $usiaSum += $item->usia;
                $tinggiBadanSum += $item->tinggi_badan;
                $beratBadanSum += $item->berat_badan;
            }

            $centroid['jumlah_stunting'] = $jumlahStuntingSum / count($cluster);
            $centroid['usia'] = $usiaSum / count($cluster);
            $centroid['tinggi_badan'] = $tinggiBadanSum / count($cluster);
            $centroid['berat_badan'] = $beratBadanSum / count($cluster);

            $newCentroids[] = $centroid;
        }

        return $newCentroids;
    }

    private function centroidsAreEqual($centroids, $newCentroids)
    {
        // Memeriksa apakah centroid baru sama dengan centroid sebelumnya
        for ($i = 0; $i < count($centroids); $i++) {
            if (
                $centroids[$i]['jumlah_stunting'] != $newCentroids[$i]['jumlah_stunting'] ||
                $centroids[$i]['usia'] != $newCentroids[$i]['usia'] ||
                $centroids[$i]['tinggi_badan'] != $newCentroids[$i]['tinggi_badan'] ||
                $centroids[$i]['berat_badan'] != $newCentroids[$i]['berat_badan']
            ) {
                return false;
            }
        }

        return true;
    }

    private function calculateInertia($clusters)
    {
        $inertia = 0;

        foreach ($clusters as $cluster) {
            $centroid = $this->calculateCentroid($cluster);

            foreach ($cluster as $item) {
                $distance = $this->calculateEuclideanDistance($item, $centroid);
                $inertia += pow($distance, 2);
            }
        }

        return $inertia;
    }

    private function calculateCentroid($cluster)
    {
        $centroid = [];

        $jumlahStuntingSum = 0;
        $usiaSum = 0;
        $tinggiBadanSum = 0;
        $beratBadanSum = 0;

        foreach ($cluster as $item) {
            $jumlahStuntingSum += $item->jumlah_stunting;
            $usiaSum += $item->usia;
            $tinggiBadanSum += $item->tinggi_badan;
            $beratBadanSum += $item->berat_badan;
        }

        $centroid['jumlah_stunting'] = $jumlahStuntingSum / count($cluster);
        $centroid['usia'] = $usiaSum / count($cluster);
        $centroid['tinggi_badan'] = $tinggiBadanSum / count($cluster);
        $centroid['berat_badan'] = $beratBadanSum / count($cluster);

        return $centroid;
    }
}
