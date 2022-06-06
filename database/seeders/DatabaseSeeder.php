<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)->create();
        DB::table('genres')->insert([
            [ 'genre_name' => "Action" ], 
            [ 'genre_name' => "Sci-Fi"],
            [ 'genre_name' => "Fantasy"],
            [ 'genre_name' => "Thriler"],
            [ 'genre_name' => "Romance"]
        ]);
    }
}
