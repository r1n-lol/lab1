<?php

namespace Database\Seeders;

use App\Models\PlantSpecies;
use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        PlantSpecies::insert([
            ['name' => 'Монстера', 'care_level' => 'Средний'],
            ['name' => 'Фикус', 'care_level' => 'Средний'],
            ['name' => 'Суккулент', 'care_level' => 'Простой'],
            ['name' => 'Папоротник', 'care_level' => 'Сложный'],
        ]);

        Room::insert([
            ['name' => 'Гостиная', 'lighting' => 'Яркое рассеянное'],
            ['name' => 'Кухня', 'lighting' => 'Умеренное'],
            ['name' => 'Спальня', 'lighting' => 'Полутень'],
            ['name' => 'Офис', 'lighting' => 'Яркое'],
        ]);
    }
}
