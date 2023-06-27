<?php

namespace Database\Seeders;

use App\Models\Pengunjung;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengunjungSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'nama' => 'Stefania Roslinda Daiman',
                'tempat_lahir' => 'stefania@gmail.com',
                'tanggal_lahir' => '2023-05-05',
                'email' => 'stefania@gmail.com',
                'password' => bcrypt('12345678'),
            ],
        ];

        foreach ($user as $key => $value) {
            Pengunjung::create($value);
        }
    }
}
