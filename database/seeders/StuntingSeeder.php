<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StuntingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kecamatans = DB::table('kecamatans')->pluck('id_kecamatan')->toArray();
        $usedKecamatanIds = [];

        $stuntings = [];

        for ($i = 0; $i < 32; $i++) {
            $usia = rand(1, 5);
            $beratBadan = $this->generateBeratBadan($usia);
            $tinggiBadan = $this->generateTinggiBadan($usia);
            $tingkatStunting = $this->getTingkatStunting($usia, $beratBadan, $tinggiBadan);

            $availableKecamatanIds = array_diff($kecamatans, $usedKecamatanIds);
            $kecamatanId = $availableKecamatanIds[array_rand($availableKecamatanIds)];

            $usedKecamatanIds[] = $kecamatanId;

            $stuntings[] = [
                'kecamatan_id' => $kecamatanId,
                'jumlah_stunting' => rand(1, 50),
                'berat_badan' => $beratBadan,
                'tinggi_badan' => $tinggiBadan,
                'usia' => $usia,
                'tingkat_stunting' => $tingkatStunting,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('stuntings')->insert($stuntings);
    }
    private function generateBeratBadan($usia)
    {
        switch ($usia) {
            case 1:
                return round(rand(70, 115) / 10, 1);
            case 2:
                return round(rand(90, 148) / 10, 1);
            case 3:
                return round(rand(108, 181) / 10, 1);
            case 4:
                return round(rand(123, 215) / 10, 1);
            case 5:
                return round(rand(137, 249) / 10, 1);
            default:
                return 0.0;
        }
    }
    private function generateTinggiBadan($usia)
    {
        switch ($usia) {
            case 1:
                return round(rand(689, 792) / 10, 1);
            case 2:
                return round(rand(800, 929) / 10, 1);
            case 3:
                return round(rand(874, 1017) / 10, 1);
            case 4:
                return round(rand(941, 1113) / 10, 1);
            case 5:
                return round(rand(999, 1189) / 10, 1);
            default:
                return 0.0;
        }
    }
    private function getTingkatStunting($usia, $beratBadan, $tinggiBadan)
    {
        if ($usia == 1) {
            if ($beratBadan < 7 || $beratBadan > 11.5 || $tinggiBadan < 68.9 || $tinggiBadan > 79.2) {
                return 'Parah';
            } elseif ($beratBadan >= 7 && $beratBadan <= 11.5 && $tinggiBadan >= 68.9 && $tinggiBadan <= 79.2) {
                return 'Sedang';
            } else {
                return 'Ringan';
            }
        } elseif ($usia == 2) {
            if ($beratBadan < 9 || $beratBadan > 14.8 || $tinggiBadan < 80 || $tinggiBadan > 92.9) {
                return 'Parah';
            } elseif ($beratBadan >= 9 && $beratBadan <= 14.8 && $tinggiBadan >= 80 && $tinggiBadan <= 92.9) {
                return 'Sedang';
            } else {
                return 'Ringan';
            }
        } elseif ($usia == 3) {
            if ($beratBadan < 10.8 || $beratBadan > 18.1 || $tinggiBadan < 87.4 || $tinggiBadan > 101.7) {
                return 'Parah';
            } elseif ($beratBadan >= 10.8 && $beratBadan <= 18.1 && $tinggiBadan >= 87.4 && $tinggiBadan <= 101.7) {
                return 'Sedang';
            } else {
                return 'Ringan';
            }
        } elseif ($usia == 4) {
            if ($beratBadan < 12.3 || $beratBadan > 21.5 || $tinggiBadan < 94.1 || $tinggiBadan > 111.3) {
                return 'Parah';
            } elseif ($beratBadan >= 12.3 && $beratBadan <= 21.5 && $tinggiBadan >= 94.1 && $tinggiBadan <= 111.3) {
                return 'Sedang';
            } else {
                return 'Ringan';
            }
        } elseif ($usia == 5) {
            if ($beratBadan < 13.7 || $beratBadan > 24.9 || $tinggiBadan < 99.9 || $tinggiBadan > 118.9) {
                return 'Parah';
            } elseif ($beratBadan >= 13.7 && $beratBadan <= 24.9 && $tinggiBadan >= 99.9 && $tinggiBadan <= 118.9) {
                return 'Sedang';
            } else {
                return 'Ringan';
            }
        }

        return '';
    }
}
