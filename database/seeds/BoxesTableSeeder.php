<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Boxes;

class BoxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Boxes::truncate();
        Boxes::create([
            'EAN' => 9900000000001,
            'BoxShortName' => 'S',
            'BoxSize' => 10,
        ]);
        Boxes::create([
            'EAN' => 9900000000002,
            'BoxShortName' => 'M',
            'BoxSize' => 15,
        ]);
       Boxes::create([
            'EAN' => 9900000000003,
            'BoxShortName' => 'L',
            'BoxSize' => 20,
        ]);
        Boxes::create([
            'EAN' => 9900000000004,
            'BoxShortName' => 'XL',
            'BoxSize' => 25,
        ]);
        Boxes::create([
            'EAN' => 9900000000005,
            'BoxShortName' => 'XS',
            'BoxSize' => 5,
        ]);
    }
}
