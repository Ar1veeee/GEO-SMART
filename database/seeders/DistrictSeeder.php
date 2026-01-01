<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $districts = [
            // 1. Weru
            ['id' => 1, 'name' => 'Weru', 'area_sqkm' => 41.98,
                'geom' => new Polygon([new LineString([
                    new Point(-7.7650, 110.7100), new Point(-7.7650, 110.7600),
                    new Point(-7.8200, 110.7600), new Point(-7.8200, 110.7100),
                    new Point(-7.7650, 110.7100)
                ])], 4326)],

            // 2. Bulu (
            ['id' => 2, 'name' => 'Bulu', 'area_sqkm' => 43.86,
                'geom' => new Polygon([new LineString([
                    new Point(-7.7300, 110.7800), new Point(-7.7300, 110.8500),
                    new Point(-7.7900, 110.8500), new Point(-7.7900, 110.7800),
                    new Point(-7.7300, 110.7800)
                ])], 4326)],

            // 3. Tawangsari (
            ['id' => 3, 'name' => 'Tawangsari', 'area_sqkm' => 39.98,
                'geom' => new Polygon([new LineString([
                    new Point(-7.6900, 110.7700), new Point(-7.6900, 110.8200),
                    new Point(-7.7400, 110.8200), new Point(-7.7400, 110.7700),
                    new Point(-7.6900, 110.7700)
                ])], 4326)],

            // 4. Sukoharjo (
            ['id' => 4, 'name' => 'Sukoharjo', 'area_sqkm' => 44.58,
                'geom' => new Polygon([new LineString([
                    new Point(-7.6500, 110.8100), new Point(-7.6500, 110.8600),
                    new Point(-7.7000, 110.8600), new Point(-7.7000, 110.8100),
                    new Point(-7.6500, 110.8100)
                ])], 4326)],

            // 5. Nguter (
            ['id' => 5, 'name' => 'Nguter', 'area_sqkm' => 54.88,
                'geom' => new Polygon([new LineString([
                    new Point(-7.7000, 110.8500), new Point(-7.7000, 110.9200),
                    new Point(-7.7600, 110.9200), new Point(-7.7600, 110.8500),
                    new Point(-7.7000, 110.8500)
                ])], 4326)],

            // 6. Bendosari (
            ['id' => 6, 'name' => 'Bendosari', 'area_sqkm' => 52.99,
                'geom' => new Polygon([new LineString([
                    new Point(-7.6300, 110.8700), new Point(-7.6300, 110.9500),
                    new Point(-7.7000, 110.9500), new Point(-7.7000, 110.8700),
                    new Point(-7.6300, 110.8700)
                ])], 4326)],

            // 7. Polokarto (
            ['id' => 7, 'name' => 'Polokarto', 'area_sqkm' => 62.18,
                'geom' => new Polygon([new LineString([
                    new Point(-7.6000, 110.8500), new Point(-7.6000, 110.9400),
                    new Point(-7.6600, 110.9400), new Point(-7.6600, 110.8500),
                    new Point(-7.6000, 110.8500)
                ])], 4326)],

            // 8. Mojolaban (
            ['id' => 8, 'name' => 'Mojolaban', 'area_sqkm' => 35.54,
                'geom' => new Polygon([new LineString([
                    new Point(-7.5700, 110.8400), new Point(-7.5700, 110.9000),
                    new Point(-7.6200, 110.9000), new Point(-7.6200, 110.8400),
                    new Point(-7.5700, 110.8400)
                ])], 4326)],

            // 9. Grogol (
            ['id' => 9, 'name' => 'Grogol', 'area_sqkm' => 30.00,
                'geom' => new Polygon([new LineString([
                    new Point(-7.5700, 110.7900), new Point(-7.5700, 110.8400),
                    new Point(-7.6400, 110.8400), new Point(-7.6400, 110.7900),
                    new Point(-7.5700, 110.7900)
                ])], 4326)],

            // 10. Baki
            ['id' => 10, 'name' => 'Baki', 'area_sqkm' => 21.97,
                'geom' => new Polygon([new LineString([
                    new Point(-7.5900, 110.7600), new Point(-7.5900, 110.8000),
                    new Point(-7.6400, 110.8000), new Point(-7.6400, 110.7600),
                    new Point(-7.5900, 110.7600)
                ])], 4326)],

            // 11. Gatak
            ['id' => 11, 'name' => 'Gatak', 'area_sqkm' => 19.47,
                'geom' => new Polygon([new LineString([
                    new Point(-7.5600, 110.7100), new Point(-7.5600, 110.7600),
                    new Point(-7.6100, 110.7600), new Point(-7.6100, 110.7100),
                    new Point(-7.5600, 110.7100)
                ])], 4326)],

            // 12. Kartasura
            ['id' => 12, 'name' => 'Kartasura', 'area_sqkm' => 19.23,
                'geom' => new Polygon([new LineString([
                    new Point(-7.5300, 110.7200), new Point(-7.5300, 110.7800),
                    new Point(-7.5700, 110.7800), new Point(-7.5700, 110.7200),
                    new Point(-7.5300, 110.7200)
                ])], 4326)],

            // 13. Gumpang
            ['id' => 13, 'name' => 'Gumpang', 'area_sqkm' => 3.00,
                'geom' => new Polygon([new LineString([
                    new Point(-7.5580, 110.7450), new Point(-7.5580, 110.7650),
                    new Point(-7.5700, 110.7650), new Point(-7.5700, 110.7450),
                    new Point(-7.5580, 110.7450)
                ])], 4326)],

            // 14. Joho
            ['id' => 14, 'name' => 'Joho', 'area_sqkm' => 2.50,
                'geom' => new Polygon([new LineString([
                    new Point(-7.6800, 110.8300), new Point(-7.6800, 110.8500),
                    new Point(-7.6950, 110.8500), new Point(-7.6950, 110.8300),
                    new Point(-7.6800, 110.8300)
                ])], 4326)],
        ];

        foreach ($districts as $district) {
            District::updateOrCreate(['id' => $district['id']], $district + ['total_students' => 0]);
        }
    }
}
