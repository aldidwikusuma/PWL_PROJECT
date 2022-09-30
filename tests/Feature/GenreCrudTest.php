<?php

namespace Tests\Feature;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenreCrudTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public const URL_TEST = '/dashboard/genres';

    public function test_load_page()
    {
        $response = $this->actingAs(LoginTest::createUser())->get(GenreCrudTest::URL_TEST);

        $response->assertStatus(200);
    }

    public function test_check_dashboard_genre_when_not_null()
    {
        $response = $this->actingAs(LoginTest::createUser())->get(GenreCrudTest::URL_TEST);
        $response->assertSee("title");
        if (Genre::all()->count() > 0){
            $response->assertSeeText("Genre Name");
            $response->assertSeeText("Action");
        }
    }

    public function test_check_dashboard_genre_when_null()
    {
        $response = $this->actingAs(LoginTest::createUser())->get(GenreCrudTest::URL_TEST);
        if (Genre::all()->count() == 0){
            $response->assertSeeText("No Data");
        }
    }

    public function test_read_data_in_dashboard_genre()
    {
        Genre::create([
            "genre_name" => "Test Genre"
        ]);

        $response = $this->actingAs(LoginTest::createUser())->get(GenreCrudTest::URL_TEST);
        $response->assertSeeText("Genre Name");
        $response->assertSeeText("Test Genre");
    }


    public function test_create_data_genre_valid()
    {
        $response = $this->actingAs(LoginTest::createUser())->post(GenreCrudTest::URL_TEST, [
            "genre_name" => "Action Genre"
        ]); 

        $response->assertSessionHas("success", "Genre has been added");
    }

    public function test_create_data_genre_unvalid_or_wrong()
    {
        $response = $this->actingAs(LoginTest::createUser())->post(GenreCrudTest::URL_TEST, [
            "genre_name" => ""
        ]); 

        $response->assertSessionHasErrors("genre_name");
    }

    public function test_update_data_genre_valid()
    {
        $data_genre = Genre::create([
            "genre_name" => "Test Edit Genre"
        ]);

        $response = $this->actingAs(LoginTest::createUser())->put(GenreCrudTest::URL_TEST . "/" . $data_genre->id, [
            "genre_name" => "Test Edit Genre After Edit"
        ]); 

        $response->assertSessionHas("success", "Genre has been updated");
    }

    public function test_update_data_genre_unvalid_or_wrong()
    {
        $data_genre = Genre::create([
            "genre_name" => "Test Edit Genre"
        ]);

        $response = $this->actingAs(LoginTest::createUser())->put(GenreCrudTest::URL_TEST . "/" . $data_genre->id, [
            "genre_name" => ""
        ]); 

        $response->assertSessionHasErrors("genre_name");
    }

    public function test_delete_data_genre_valid(){
        $data_genre = Genre::create([
            "genre_name" => "Test Delete Genre"
        ]);

        $response = $this->actingAs(LoginTest::createUser())->delete(GenreCrudTest::URL_TEST . "/" . $data_genre->id, [
            '_method' => "DELETE"
        ]); 

        $response->assertSessionHas("success", "Genre has been deleted");
    }

    public function test_delete_data_genre_unvalid_or_wrong_id(){
        Genre::create([
            "genre_name" => "Test Delete Genre Wrong"
        ]);

        $response = $this->actingAs(LoginTest::createUser())->post(GenreCrudTest::URL_TEST . "/wrong", [
            '_method' => "DELETE"
        ]); 

        $response->assertStatus(404);
    }
}
