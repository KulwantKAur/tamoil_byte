<?php

namespace Database\Seeders;

use App\Models\LabelDrucker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelDruckerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LabelDrucker::truncate();
         DB::table('label_druckers')->insert([
            [
                'Ausgabedienst' => 'Avatar',
                'Druckername' => 'Label Lager03',
                'Druckernummer01' => '7658',
                'Druckernummer02' => '7657',
            ],
         ]);
    }
}
