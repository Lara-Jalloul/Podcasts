<?php

namespace Database\Seeders;

use App\Models\Podcast;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<=10;$i++){
            Podcast::create([
                'title'=>"On Purpose".$i,
                'author'=>"Jay Shetty".$i,
                'description'=>"desc".$i,
            ]);
        }
    }
}
