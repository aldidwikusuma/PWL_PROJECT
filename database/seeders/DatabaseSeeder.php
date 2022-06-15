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

        DB::table('rooms')->insert([
            [
                'room_name' => "Room 1",
                'chair_row' => 1,
                'chair_col' => 14,
            ],
            [
                'room_name' => "Room 2",
                'chair_row' => 2,
                'chair_col' => 14,
            ],
        ]);

        DB::table('chair_categories')->insert([
            [
                'category' => "Regular",
                'price' => 30000
            ], [
                'category' => "VIP",
                'price' => 50000
            ]
        ]);

        DB::table('chairs')->insert([
            [
                'name' => "A01",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "A02",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "A03",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "A04",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "A05",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "A06",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "A07",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "A08",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "A09",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "A10",
                'fk_id_chair_category' => 1,
            ], [
                'name' => "B01",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "B02",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "B03",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "B04",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "B05",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "B06",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "B07",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "B08",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "B09",
                'fk_id_chair_category' => 1,
            ],[
                'name' => "B10",
                'fk_id_chair_category' => 1,
            ]
        ]);

        // DB::table('chairs_rooms')->insert([
        //     [
        //         'fk_id_room' => 1,
        //         'fk_id_chair' => 1,
        //     ], [
        //         'fk_id_room' => 1,
        //         'fk_id_chair' => 2,
        //     ], [
        //         'fk_id_room' => 1,
        //         'fk_id_chair' => 3,
        //     ]
        // ]);
    }
}
