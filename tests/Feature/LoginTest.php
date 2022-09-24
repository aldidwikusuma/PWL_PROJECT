<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public const URL_TEST = "/login";

    public static function createUser()
    {
        return User::create([
            "username" => "testdata",
            "email" => "testdata@gmail.com",
            "password" => bcrypt("testdata")
        ]);
    }

    public function test_page_load()
    {
        $response = $this->get(LoginTest::URL_TEST);

        $response->assertStatus(200);
    }
    public function test_login_with_valid_account()
    {
        $user_data = LoginTest::createUser();

        $this->actingAs($user_data)->get('/login');

        $this->assertAuthenticatedAs($user_data);
    }

    public function test_login_with_unvalid_account()
    {
        $response = $this->post(LoginTest::URL_TEST ,[
            "username" => "testdatafailed",
            "password" => "testdatafailed"
        ]);

        $response->assertSessionHasErrors('username');
    }
}
