<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProfileModel;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dataseed= [
            
           
                ];

        foreach ($dataseed as $key =>$v){
            ProfileModel::create($v);
        }
        

    }
}
