<?php

namespace Database\Seeders;


use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str; 


class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($x=0; $x < 20; $x++){
            DB::table('tasks')->insert([
                'title' => Str::random(10),
                'description' => Str::random(20),
                'completed' => rand(0,1),
                'priority' => rand(0,3),
                'deadline' => now()->addDays(rand(1,10)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
