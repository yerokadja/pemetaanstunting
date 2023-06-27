<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Kecamatanseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'kode_kecamatan' => '53.02.01',
                'nama_kecamatan' => 'Kota Soe',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],
            [
                'kode_kecamatan' => '53.02.02',
                'nama_kecamatan' => 'Mollo Selatan',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],
            [
                'kode_kecamatan' => '53.02.03',
                'nama_kecamatan' => 'Mollo Utara',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.04',
                'nama_kecamatan' => 'Amanuban Timur',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],
            [
                'kode_kecamatan' => '53.02.05',
                'nama_kecamatan' => 'Amanuban Tengah',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],
            [
                'kode_kecamatan' => '53.02.06',
                'nama_kecamatan' => 'Amanuban Selatan',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.09',
                'nama_kecamatan' => 'Amanatun Utara',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.10',
                'nama_kecamatan' => 'Kie',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],
            [
                'kode_kecamatan' => '53.02.11',
                'nama_kecamatan' => 'Kuanfatu',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.12',
                'nama_kecamatan' => 'Fatumnasi',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.13',
                'nama_kecamatan' => 'Polen',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.14',
                'nama_kecamatan' => 'Batu Putih',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.15',
                'nama_kecamatan' => 'Boking',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.16',
                'nama_kecamatan' => 'Toianas',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.17',
                'nama_kecamatan' => 'Nunkolo',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.18',
                'nama_kecamatan' => 'Oenino',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.19',
                'nama_kecamatan' => 'Kolbano',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.20',
                'nama_kecamatan' => 'Kotolin',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],


            [
                'kode_kecamatan' => '53.02.21',
                'nama_kecamatan' => 'Kualin',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.22',
                'nama_kecamatan' => 'Mollo Barat',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.23',
                'nama_kecamatan' => 'Kokbaun',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.24',
                'nama_kecamatan' => 'Noebana',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.25',
                'nama_kecamatan' => 'Santian',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.26',
                'nama_kecamatan' => 'Noebeba',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.27',
                'nama_kecamatan' => 'Kuatnana',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.28',
                'nama_kecamatan' => 'Fautmolo',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.29',
                'nama_kecamatan' => 'Fatukopa',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.30',
                'nama_kecamatan' => 'Mollo Tengah',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.31',
                'nama_kecamatan' => 'Tobu',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],

            [
                'kode_kecamatan' => '53.02.32',
                'nama_kecamatan' => 'Nunbena',
                'file_geo_json' => '',
                'warna' => $this->warnaacak(),
            ],
        ];

        $kecamatan = [];

        foreach ($data as $item) {
            $item['warna'] = $this->warnaacak();
            $kecamatan[] = $item;
        }

        DB::table('kecamatans')->insert($kecamatan);
    }

    /**
     * Generate a random color.
     *
     * @return string
     */
    private function warnaacak()
    {
        $characters = '0123456789ABCDEF';
        $color = '#';
        for ($i = 0; $i < 6; $i++) {
            $color .= $characters[rand(0, 15)];
        }
        return $color;
    }
}
