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

        DB::table('room_categories')->insert([
            [
                'category' => "Regular",
                'price' => 30000
            ], [
                'category' => "VIP",
                'price' => 50000
            ]
        ]);

        DB::table('rooms')->insert([
            [
                'name' => "Room 1",
                'chair_row' => 1,
                'chair_col' => 10,
                'fk_id_room_category' => 1
            ],
        ]);

        DB::table('chairs')->insert([
            [
                'name' => "A01",
            ],[
                'name' => "A02",
            ],[
                'name' => "A03",
            ],[
                'name' => "A04",
            ],[
                'name' => "A05",
            ],[
                'name' => "A06",
            ],[
                'name' => "A07",
            ],[
                'name' => "A08",
            ],[
                'name' => "A09",
            ],[
                'name' => "A10",
            ], [
                'name' => "A11",
            ],[
                'name' => "A12",
            ],[
                'name' => "A13",
            ],[
                'name' => "A14",
            ],[
                'name' => "A15",
            ],[
                'name' => "A16",
            ],[
                'name' => "A17",
            ],[
                'name' => "A18",
            ],[
                'name' => "A19",
            ],[
                'name' => "A20",
            ],[
                'name' => "B01",
            ],[
                'name' => "B02",
            ],[
                'name' => "B03",
            ],[
                'name' => "B04",
            ],[
                'name' => "B05",
            ],[
                'name' => "B06",
            ],[
                'name' => "B07",
            ],[
                'name' => "B08",
            ],[
                'name' => "B09",
            ],[
                'name' => "B10",
            ], [
                'name' => "B11",
            ],[
                'name' => "B12",
            ],[
                'name' => "B13",
            ],[
                'name' => "B14",
            ],[
                'name' => "B15",
            ],[
                'name' => "B16",
            ],[
                'name' => "B17",
            ],[
                'name' => "B18",
            ],[
                'name' => "B19",
            ],[
                'name' => "B20",
            ],

            [
                'name' => "C01",
            ],[
                'name' => "C02",
            ],[
                'name' => "C03",
            ],[
                'name' => "C04",
            ],[
                'name' => "C05",
            ],[
                'name' => "C06",
            ],[
                'name' => "C07",
            ],[
                'name' => "C08",
            ],[
                'name' => "C09",
            ],[
                'name' => "C10",
            ], [
                'name' => "C11",
            ],[
                'name' => "C12",
            ],[
                'name' => "C13",
            ],[
                'name' => "C14",
            ],[
                'name' => "C15",
            ],[
                'name' => "C16",
            ],[
                'name' => "C17",
            ],[
                'name' => "C18",
            ],[
                'name' => "C19",
            ],[
                'name' => "C20",
            ],

            [
                'name' => "D01",
            ],[
                'name' => "D02",
            ],[
                'name' => "D03",
            ],[
                'name' => "D04",
            ],[
                'name' => "D05",
            ],[
                'name' => "D06",
            ],[
                'name' => "D07",
            ],[
                'name' => "D08",
            ],[
                'name' => "D09",
            ],[
                'name' => "D10",
            ], [
                'name' => "D11",
            ],[
                'name' => "D12",
            ],[
                'name' => "D13",
            ],[
                'name' => "D14",
            ],[
                'name' => "D15",
            ],[
                'name' => "D16",
            ],[
                'name' => "D17",
            ],[
                'name' => "D18",
            ],[
                'name' => "D19",
            ],[
                'name' => "D20",
            ],

            [
                'name' => "E01",
            ],[
                'name' => "E02",
            ],[
                'name' => "E03",
            ],[
                'name' => "E04",
            ],[
                'name' => "E05",
            ],[
                'name' => "E06",
            ],[
                'name' => "E07",
            ],[
                'name' => "E08",
            ],[
                'name' => "E09",
            ],[
                'name' => "E10",
            ], [
                'name' => "E11",
            ],[
                'name' => "E12",
            ],[
                'name' => "E13",
            ],[
                'name' => "E14",
            ],[
                'name' => "E15",
            ],[
                'name' => "E16",
            ],[
                'name' => "E17",
            ],[
                'name' => "E18",
            ],[
                'name' => "E19",
            ],[
                'name' => "E20",
            ],

            [
                'name' => "F01",
            ],[
                'name' => "F02",
            ],[
                'name' => "F03",
            ],[
                'name' => "F04",
            ],[
                'name' => "F05",
            ],[
                'name' => "F06",
            ],[
                'name' => "F07",
            ],[
                'name' => "F08",
            ],[
                'name' => "F09",
            ],[
                'name' => "F10",
            ], [
                'name' => "F11",
            ],[
                'name' => "F12",
            ],[
                'name' => "F13",
            ],[
                'name' => "F14",
            ],[
                'name' => "F15",
            ],[
                'name' => "F16",
            ],[
                'name' => "F17",
            ],[
                'name' => "F18",
            ],[
                'name' => "F19",
            ],[
                'name' => "F20",
            ],

            [
                'name' => "G01",
            ],[
                'name' => "G02",
            ],[
                'name' => "G03",
            ],[
                'name' => "G04",
            ],[
                'name' => "G05",
            ],[
                'name' => "G06",
            ],[
                'name' => "G07",
            ],[
                'name' => "G08",
            ],[
                'name' => "G09",
            ],[
                'name' => "G10",
            ], [
                'name' => "G11",
            ],[
                'name' => "G12",
            ],[
                'name' => "G13",
            ],[
                'name' => "G14",
            ],[
                'name' => "G15",
            ],[
                'name' => "G16",
            ],[
                'name' => "G17",
            ],[
                'name' => "G18",
            ],[
                'name' => "G19",
            ],[
                'name' => "G20",
            ],

            [
                'name' => "H01",
            ],[
                'name' => "H02",
            ],[
                'name' => "H03",
            ],[
                'name' => "H04",
            ],[
                'name' => "H05",
            ],[
                'name' => "H06",
            ],[
                'name' => "H07",
            ],[
                'name' => "H08",
            ],[
                'name' => "H09",
            ],[
                'name' => "H10",
            ], [
                'name' => "H11",
            ],[
                'name' => "H12",
            ],[
                'name' => "H13",
            ],[
                'name' => "H14",
            ],[
                'name' => "H15",
            ],[
                'name' => "H16",
            ],[
                'name' => "H17",
            ],[
                'name' => "H18",
            ],[
                'name' => "H19",
            ],[
                'name' => "H20",
            ],

            [
                'name' => "I01",
            ],[
                'name' => "I02",
            ],[
                'name' => "I03",
            ],[
                'name' => "I04",
            ],[
                'name' => "I05",
            ],[
                'name' => "I06",
            ],[
                'name' => "I07",
            ],[
                'name' => "I08",
            ],[
                'name' => "I09",
            ],[
                'name' => "I10",
            ], [
                'name' => "I11",
            ],[
                'name' => "I12",
            ],[
                'name' => "I13",
            ],[
                'name' => "I14",
            ],[
                'name' => "I15",
            ],[
                'name' => "I16",
            ],[
                'name' => "I17",
            ],[
                'name' => "I18",
            ],[
                'name' => "I19",
            ],[
                'name' => "I20",
            ],

            [
                'name' => "J01",
            ],[
                'name' => "J02",
            ],[
                'name' => "J03",
            ],[
                'name' => "J04",
            ],[
                'name' => "J05",
            ],[
                'name' => "J06",
            ],[
                'name' => "J07",
            ],[
                'name' => "J08",
            ],[
                'name' => "J09",
            ],[
                'name' => "J10",
            ], [
                'name' => "J11",
            ],[
                'name' => "J12",
            ],[
                'name' => "J13",
            ],[
                'name' => "J14",
            ],[
                'name' => "J15",
            ],[
                'name' => "J16",
            ],[
                'name' => "J17",
            ],[
                'name' => "J18",
            ],[
                'name' => "J19",
            ],[
                'name' => "J20",
            ]
        ]);

        // DB::table('chair_room')->insert([
        //     [
        //         'fk_id_room' => 1,
        //         'fk_id_chair' => 1,
        //         'number_chair' => 1
        //     ], [
        //         'fk_id_room' => 1,
        //         'fk_id_chair' => 2,
        //         'number_chair' => 2
        //     ], [
        //         'fk_id_room' => 1,
        //         'fk_id_chair' => 3,
        //         'number_chair' => 3
        //     ], [
        //         'fk_id_room' => 1,
        //         'fk_id_chair' => 4,
        //         'number_chair' => 4
        //     ], [
        //         'fk_id_room' => 1,
        //         'fk_id_chair' => 4,
        //         'number_chair' => 4
        //     ], [
        //         'fk_id_room' => 1,
        //         'fk_id_chair' => 5,
        //         'number_chair' => 5
        //     ], [
        //         'fk_id_room' => 1,
        //         'fk_id_chair' => 6,
        //         'number_chair' => 6
        //     ], [
        //         'fk_id_room' => 1,
        //         'fk_id_chair' => 7,
        //         'number_chair' => 7
        //     ], [
        //         'fk_id_room' => 1,
        //         'fk_id_chair' => 8,
        //         'number_chair' => 8
        //     ], [
        //         'fk_id_room' => 1,
        //         'fk_id_chair' => 9,
        //         'number_chair' => 9
        //     ], 
        // ]);
    }
}
