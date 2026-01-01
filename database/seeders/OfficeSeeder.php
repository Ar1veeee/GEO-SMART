<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;
use MatanYadaev\EloquentSpatial\Objects\Point;

class OfficeSeeder extends Seeder
{
    public function run(): void
    {
        Office::create([
            'name' => 'PT. Tiga Serangkai Pustaka Mandiri',
            'address' => 'Jl. Prof. DR. Supomo No.23, Sriwedari, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57141',
            'geom' => new Point(-7.5652761, 110.8115654, 4326),
        ]);
    }
}
