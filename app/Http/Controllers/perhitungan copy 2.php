<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\hasil_cluster;
use App\Models\Stunting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Perhitungan extends Controller
{
    public function show()
    {
        $dataCount = Stunting::count();

        if ($dataCount === 0) {
            return redirect()->back()->with('error', 'Tidak ada data Stunting yang tersedia.');
        }

        $k = Config::get('kmeans.k');
        $maxIterations = Config::get('kmeans.max_iterations');
        $dataset = Stunting::all();
        $centroids = $this->initializeCentroids($dataset, $k);
        $iterations = 0;
        while ($iterations < $maxIterations) {
            $clusters = [];

            foreach ($dataset as $record) {
                $distances = [];

                foreach ($centroids as $centroid) {
                    $distance = $this->euclideanDistance($record, $centroid);
                    $distances[] = $distance;
                }

                $closestClusterIndex = array_keys($distances, min($distances))[0];
                $closestCluster = $centroids[$closestClusterIndex];
                $record->jarak_ke_centroid = min($distances);
                $record->jarak_terdekat = $closestCluster;
                $clusters[$closestClusterIndex][] = $record;
            }

            $newCentroids = [];

            foreach ($clusters as $cluster) {
                $clusterSize = count($cluster);
                $sumRecord = $this->sumRecords($cluster);

                $newCentroid = $this->calculateCentroid($sumRecord, $clusterSize);
                $newCentroids[] = $newCentroid;
            }

            if ($this->areCentroidsEqual($centroids, $newCentroids)) {
                break;
            }

            $centroids = $newCentroids;
            $iterations++;

            if ($iterations == 4) {
                break;
            }
        }

        foreach ($clusters as $cluster) {
            foreach ($cluster as $record) {
                if ($record->tingkat_stunting == '') {
                    $closestCluster = $record->jarak_terdekat;
                    $usia = $record->usia;
                    if ($usia == 1) {
                        if ($closestCluster->berat_badan < 7 || $closestCluster->berat_badan > 11.5 || $closestCluster->tinggi_badan < 68.9 || $closestCluster->tinggi_badan > 79.2) {
                            $record->tingkat_stunting = 'Parah';
                        } elseif ($closestCluster->berat_badan >= 7 && $closestCluster->berat_badan <= 11.5 && $closestCluster->tinggi_badan >= 68.9 && $closestCluster->tinggi_badan <= 79.2) {
                            $record->tingkat_stunting = 'Sedang';
                        } else {
                            $record->tingkat_stunting = 'Ringan';
                        }
                    } elseif ($usia == 2) {
                        if ($closestCluster->berat_badan < 9 || $closestCluster->berat_badan > 14.8 || $closestCluster->tinggi_badan < 80 || $closestCluster->tinggi_badan > 92.9) {
                            $record->tingkat_stunting = 'Parah';
                        } elseif ($closestCluster->berat_badan >= 9 && $closestCluster->berat_badan <= 14.8 && $closestCluster->tinggi_badan >= 80 && $closestCluster->tinggi_badan <= 92.9) {
                            $record->tingkat_stunting = 'Sedang';
                        } else {
                            $record->tingkat_stunting = 'Ringan';
                        }
                    } elseif ($usia == 3) {
                        if ($closestCluster->berat_badan < 10.8 || $closestCluster->berat_badan > 18.1 || $closestCluster->tinggi_badan < 87.4 || $closestCluster->tinggi_badan > 101.7) {
                            $record->tingkat_stunting = 'Parah';
                        } elseif ($closestCluster->berat_badan >= 10.8 && $closestCluster->berat_badan <= 18.1 && $closestCluster->tinggi_badan >= 87.4 && $closestCluster->tinggi_badan <= 101.7) {
                            $record->tingkat_stunting = 'Sedang';
                        } else {
                            $record->tingkat_stunting = 'Ringan';
                        }
                    } elseif ($usia == 4) {
                        if ($closestCluster->berat_badan < 12.3 || $closestCluster->berat_badan > 21.5 || $closestCluster->tinggi_badan < 94.1 || $closestCluster->tinggi_badan > 111.3) {
                            $record->tingkat_stunting = 'Parah';
                        } elseif ($closestCluster->berat_badan >= 12.3 && $closestCluster->berat_badan <= 21.5 && $closestCluster->tinggi_badan >= 94.1 && $closestCluster->tinggi_badan <= 111.3) {
                            $record->tingkat_stunting = 'Sedang';
                        } else {
                            $record->tingkat_stunting = 'Ringan';
                        }
                    } elseif ($usia == 5) {
                        if ($closestCluster->berat_badan < 13.7 || $closestCluster->berat_badan > 24.9 || $closestCluster->tinggi_badan < 99.9 || $closestCluster->tinggi_badan > 118.9) {
                            $record->tingkat_stunting = 'Parah';
                        } elseif ($closestCluster->berat_badan >= 13.7 && $closestCluster->berat_badan <= 24.9 && $closestCluster->tinggi_badan >= 99.9 && $closestCluster->tinggi_badan <= 118.9) {
                            $record->tingkat_stunting = 'Sedang';
                        } else {
                            $record->tingkat_stunting = 'Ringan';
                        }
                    } else {
                        $record->tingkat_stunting = 'Tidak Diketahui';
                    }
                }
            }
        }

        foreach ($clusters as $clusterIndex => $cluster) {
            foreach ($cluster as $record) {
                $clusterResult = new hasil_cluster();
                $clusterResult->cluster_id = $clusterIndex + 1;
                $clusterResult->kecamatan_id = $record->kecamatan_id;
                $clusterResult->save();
            }
        }

        $this->updateHasilClusters($clusters, $dataset);
        $this->deleteHasilClusters($clusters);

        $centroidHistory = [];
        $centroidss = $newCentroids;
        $centroidHistory[] = $centroids;
        $centroidsAwal = $centroids;
        $title = 'Hasil K-means';
        $centroidsAwal = $centroids;
        return view('admin.alur.index', compact('clusters', 'title', 'centroids', 'iterations', 'centroidHistory', 'dataset', 'centroidss', 'centroidsAwal'));
    }

    private function initializeCentroids($dataset, $k)
    {
        $centroids = [];
        $randomIndex = rand(0, count($dataset) - 1);
        $centroids[] = $dataset[$randomIndex];

        for ($i = 1; $i < $k; $i++) {
            $distances = [];
            $sumDistances = 0;

            foreach ($dataset as $record) {
                $minDistance = INF;
                foreach ($centroids as $centroid) {
                    $distance = $this->euclideanDistance($record, $centroid);
                    $minDistance = min($minDistance, $distance);
                }
                $distances[] = $minDistance;
                $sumDistances += $minDistance;
            }

            $probabilities = [];

            if ($sumDistances != 0) {
                $probabilities = array_map(function ($distance) use ($sumDistances) {
                    return $distance / $sumDistances;
                }, $distances);
            } else {
                // Penanganan jika $sumDistances adalah nol
                $probabilities = array_fill(0, count($dataset), 1 / count($dataset));
                // atau tampilkan pesan kesalahan
                // echo "Error: Division by zero. Unable to calculate probabilities.";
                // exit;
            }

            $randomValue = mt_rand() / mt_getrandmax();
            $cumulativeProbability = 0;
            for ($j = 0; $j < count($dataset); $j++) {
                $cumulativeProbability += $probabilities[$j];
                if ($cumulativeProbability >= $randomValue) {
                    $centroids[] = $dataset[$j];
                    break;
                }
            }
        }

        return $centroids;
    }

    private function euclideanDistance($record1, $record2)
    {
        $distance = sqrt(pow(($record1->berat_badan - $record2->berat_badan), 2) + pow(($record1->tinggi_badan - $record2->tinggi_badan), 2));
        return $distance;
    }

    private function sumRecords($cluster)
    {
        $sumRecord = new Stunting();
        $sumRecord->berat_badan = 0;
        $sumRecord->tinggi_badan = 0;

        foreach ($cluster as $record) {
            $sumRecord->berat_badan += $record->berat_badan;
            $sumRecord->tinggi_badan += $record->tinggi_badan;
        }

        return $sumRecord;
    }

    private function calculateCentroid($sumRecord, $clusterSize)
    {
        $newCentroid = new Stunting();
        $newCentroid->berat_badan = $sumRecord->berat_badan / $clusterSize;
        $newCentroid->tinggi_badan = $sumRecord->tinggi_badan / $clusterSize;

        return $newCentroid;
    }

    private function areCentroidsEqual($centroids, $newCentroids)
    {
        if (count($centroids) !== count($newCentroids)) {
            return false;
        }

        foreach ($centroids as $index => $centroid) {
            if ($centroid->berat_badan != $newCentroids[$index]->berat_badan || $centroid->tinggi_badan != $newCentroids[$index]->tinggi_badan) {
                return false;
            }
        }

        return true;
    }

    public function updateHasilClusters($clusters, $dataset)
    {
        $existingDataIds = hasil_cluster::pluck('kecamatan_id')->toArray();
        hasil_cluster::whereIn('kecamatan_id', collect($dataset)->pluck('kecamatan_id'))->delete();

        foreach ($clusters as $clusterIndex => $cluster) {
            foreach ($cluster as $record) {
                $clusterResult = new hasil_cluster();
                $clusterResult->cluster_id = $clusterIndex + 1;
                $clusterResult->kecamatan_id = $record->kecamatan_id;
                $clusterResult->save();
            }
        }

        $newDataIds = hasil_cluster::pluck('kecamatan_id')->toArray();
        $hasChanges = array_diff($existingDataIds, $newDataIds);

        if (!empty($hasChanges)) {
            $this->resetAutoIncrement();
        }
    }

    public function deleteHasilClusters($dataset)
    {
        $existingDataIds = hasil_cluster::pluck('kecamatan_id')->toArray();

        $datasetIds = collect($dataset)->pluck('kecamatan_id')->toArray();
        $recordsToDelete = hasil_cluster::whereNotIn('kecamatan_id', $datasetIds)->get();
        foreach ($recordsToDelete as $record) {
            $record->delete();
        }

        $newDataIds = hasil_cluster::pluck('kecamatan_id')->toArray();
        $hasChanges = array_diff($existingDataIds, $newDataIds);

        if (!empty($hasChanges)) {
            $this->resetAutoIncrement();
        }
    }

    public function resetAutoIncrement()
    {
        // DB::statement('TRUNCATE hasil_clusters');
        DB::statement('ALTER TABLE hasil_clusters AUTO_INCREMENT = 1');
    }
}
