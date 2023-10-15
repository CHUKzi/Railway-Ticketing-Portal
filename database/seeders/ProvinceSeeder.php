<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provinces')->insert([
            ['name' => 'Western'],
            ['name' => 'Central'],
            ['name' => 'Southern'],
            ['name' => 'Northern'],
            ['name' => 'Eastern'],
            ['name' => 'North Western'],
            ['name' => 'North Central'],
            ['name' => 'Uva'],
            ['name' => 'Sabaragamuwa'],
        ]);
    }
}
