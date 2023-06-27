<?php

namespace Database\Seeders;

use App\Models\PasienModel;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PasienSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $tinggi_badan = $faker->randomFloat(2, 1.50, 2.50);
            $berat_badan = $faker->randomFloat(1, 30, 70);
            $lingkar_perut = $faker->randomFloat(1, 40, 90);
            $lingkar_badan = $faker->randomFloat(1, 60, 120);

            if ($tinggi_badan < 2.1 && $berat_badan < 50) {
                $status = 'Stunting';
            } elseif ($lingkar_perut > 90 || $lingkar_badan > 120) {
                $status = 'Obesitas';
            } else {
                $status = 'Normal';
            }

            $patient = new PasienModel([
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'alamat' => $faker->address,
                'tinggi_badan' => $tinggi_badan,
                'berat_badan' => $berat_badan,
                'lingkar_perut' => $lingkar_perut,
                'lingkar_badan' => $lingkar_badan,
                'status' => $status
            ]);
            $patient->save();
        }
    }
}
