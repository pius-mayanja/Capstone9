<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Participant;

class ParticipantsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_participant()
    {
        $name = fake()->name();
        $email = fake()->safeEmail();
        $phone = fake()->phoneNumber();

        $response = $this->post('/participants', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('participants', ['email' => $email]);
    }

    /** @test */
    public function it_requires_a_name_to_create_a_participant()
    {
        $response = $this->post('/participants', [
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
        ]);

        $response->assertSessionHasErrors('name');
    }
}



test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
