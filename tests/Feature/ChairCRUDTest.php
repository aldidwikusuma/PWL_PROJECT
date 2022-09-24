<?php

namespace Tests\Feature;

use App\Models\Chair;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChairCRUDTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public const URL_TEST = '/dashboard/chairs';

    public function test_load_page()
    {
        $response = $this->actingAs(LoginTest::createUser())->get(ChairCRUDTest::URL_TEST);

        $response->assertStatus(200);
    }

    public function test_check_dashboard_chair_when_not_null()
    {
        $response = $this->actingAs(LoginTest::createUser())->get(ChairCRUDTest::URL_TEST);
        $response->assertSee("title");
        if (Chair::all()->count() > 0){
            $response->assertSeeText("Chair Name");
            $response->assertSeeText("A01");
        }
    }

    public function test_check_dashboard_chair_when_null()
    {
        $response = $this->actingAs(LoginTest::createUser())->get(ChairCRUDTest::URL_TEST);
        if (Chair::all()->count() == 0){
            $response->assertSeeText("No Data");
        }
    }

    public function test_create_data_chair_valid()
    {
        $response = $this->actingAs(LoginTest::createUser())->post(ChairCRUDTest::URL_TEST, [
            "name" => "A01"
        ]); 

        $response->assertSessionHas("success", "Chair has been added");
        $response->assertRedirect(ChairCRUDTest::URL_TEST);
    }

    public function test_read_data_in_dashboard_chair()
    {
        Chair::create([
            "name" => "Test Chair"
        ]);

        $response = $this->actingAs(LoginTest::createUser())->get(ChairCRUDTest::URL_TEST);
        $response->assertSeeText("Chair Name");
        $response->assertSeeText("Test Chair");
    }

    public function test_create_data_chair_unvalid_or_wrong()
    {
        $response = $this->actingAs(LoginTest::createUser())->post(ChairCRUDTest::URL_TEST, [
            "name" => ""
        ]); 

        $response->assertSessionHasErrors("name");
    }

    public function test_update_data_chair_valid()
    {
        $data_chair = Chair::create([
            "name" => "Test Edit Chair"
        ]);

        $response = $this->actingAs(LoginTest::createUser())->post(ChairCRUDTest::URL_TEST . "/" . $data_chair->id, [
            '_method' => 'PUT',
            "name" => "Test Edit Chair After Edit"
        ]); 

        $response->assertSessionHas("success", "Chair has been updated");
    }

    public function test_update_data_chair_unvalid_or_wrong()
    {
        $data_chair = Chair::create([
            "name" => "Test Edit Chair"
        ]);

        $response = $this->actingAs(LoginTest::createUser())->put(ChairCRUDTest::URL_TEST . "/" . $data_chair->id, [
            "name" => ""
        ]); 

        $response->assertSessionHasErrors("name");
    }

    public function test_delete_data_chair_valid(){
        $data_chair = Chair::create([
            "name" => "Test Delete Chair"
        ]);

        $response = $this->actingAs(LoginTest::createUser())->post(ChairCRUDTest::URL_TEST . "/" . $data_chair->id, [
            '_method' => 'DELETE',
        ]); 

        $response->assertSessionHas("success", "Chair Category has been deleted");
    }

    public function test_delete_data_chair_unvalid_or_wrong_id(){
        $data_chair = Chair::create([
            "name" => "Test Delete Chair Wrong"
        ]);

        $response = $this->actingAs(LoginTest::createUser())->post(ChairCRUDTest::URL_TEST . "/wrong", [
            '_method' => 'DELETE',
        ]); 

        $response->assertStatus(404);
    }
}
