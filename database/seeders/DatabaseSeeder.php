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
        DB::table('users')->insert([
            [ 
                "username" => "aldi",
                "email" => "aldi@gmail.com",
                "password" => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"
            ]
        ]);
        DB::table('genres')->insert([
            [ 'genre_name' => "Action" ], 
            [ 'genre_name' => "Sci-Fi"],
            [ 'genre_name' => "Fantasy"],
            [ 'genre_name' => "Thriler"],
            [ 'genre_name' => "Romance"]
        ]);
    }
}
