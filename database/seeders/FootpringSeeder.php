<?php

namespace Database\Seeders;

use App\Models\Footprint;
use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FootpringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Footprint::factory(10)
            ->has(Media::factory()->count(7))
            ->create();
    }
}
