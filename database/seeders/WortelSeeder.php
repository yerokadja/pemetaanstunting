<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WortelModel;

class WortelSeeder extends Seeder
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
                'data_wortel'=>'10',
            ] ,  
            [
                'data_wortel'=>'80',
            ] , 
            [
                'data_wortel'=>'20',
            ] , 
            [
                'data_wortel'=>'40',
            ] , 
          
                ];

        foreach ($dataseed as $key =>$v){
            WortelModel::create($v);
        }
    }
}
