<?php

namespace Database\Seeders;

use App\Models\A4Drucker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class A4DruckerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        A4Drucker::truncate();
         DB::table('a4_druckers')->insert([

             [
                'Ausgabedienst' => 'Avatar',
                'Druckername' => 'Kyocera Lager01',
                'Druckernummer01' => '7661',
                'Druckernummer02' => '7662',
            ],
            [
                'Ausgabedienst' => 'Avatar',
                'Druckername' => 'Kyocera Lager03',
                'Druckernummer01' => '7659',
                'Druckernummer02' => '7660',
            ],
               [
                'Ausgabedienst' => 'KerbholzDruckerWolke',
                'Druckername' => 'Drucker im Keller',
                'Druckernummer01' => '4103',
                'Druckernummer02' => '4104',
            ],
               [
                'Ausgabedienst' => 'Maren Test Neu',
                'Druckername' => 'Print to Pdf',
                'Druckernummer01' => '6099',
                'Druckernummer02' => '6100',
            ],

        ]);
    }
}
