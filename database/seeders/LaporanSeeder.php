<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LaporanModel;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataseed= [

            [
                'bulan'=>'januari',
            ] ,  
            [
                'tahun'=>'2020',
            ] , 
            [
                'jumlah_pasien'=>'20',
            ] , 
           
          
                ];

        foreach ($dataseed as $key =>$v){
            LaporanModel::create($v);
        }
    }
}
