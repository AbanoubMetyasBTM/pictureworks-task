<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_user_endpoint_is_200()
    {
        $response = $this->get('/user/1');

        $response->assertStatus(200);
    }

    public function test_false_user_endpoint_is_404()
    {
        $response = $this->get('/user/10');

        $response->assertStatus(404);
    }

    public function test_edit_user_endpoint_invalid_data()
    {
        $response = $this->post('/user/1/update-comments', [
            "id"       => "1",
        ]);

        $response->assertSeeText('Missing key/value');
    }

    public function test_edit_user_endpoint_is_404()
    {
        $response = $this->post('/user/1/update-comments', [
            "password" => "720DF6C2482218518FA20FDC52D4DED7ECC043AB",
            "id"       => "10",
            "comments" => "47"
        ]);

        $response->assertSeeText("No such user (1)");
    }

    public function test_edit_user_endpoint_invalid_password()
    {
        $response = $this->post('/user/1/update-comments', [
            "password" => "wrong password",
            "id"       => "1",
            "comments" => "47"
        ]);

        $response->assertSeeText("Invalid password");
    }

    public function test_edit_user_endpoint_not_required_password()
    {
        $response = $this->post('/user/1/update-comments', [
            "password" => "not required",
            "id"       => "1",
            "comments" => "47"
        ]);

        $response->assertSeeText("OK");
    }

    public function test_edit_user_endpoint_everything_is_fine()
    {
        $response = $this->post('/user/1/update-comments', [
            "password" => "720DF6C2482218518FA20FDC52D4DED7ECC043AB",
            "id"       => "1",
            "comments" => "47"
        ]);

        $response->assertStatus(200);
        $response->assertSeeText("OK");

    }



}
