<?php

namespace Tests\Feature;

use App\Models\Person;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PeopleTest extends TestCase
{
    // use RefreshDatabase;
    public function test_people_page_contains_empty_table(): void
    {
        // Assuming you have a User model and want to simulate a logged-in user
        $user = User::factory()->create();

        // Acting as the authenticated user
        $this->actingAs($user);
        $response = $this->get('/person');

        $response->assertStatus(200);
        $response->assertSee(__('No people found'));
    }

    public function test_people_page_contains_non_empty_table(): void
    {
        // Assuming you have a User model and want to simulate a logged-in user
        $user = User::factory()->create();

        $person = Person::create([
            'user_id' => $user->id,
            'firstname' => 'Maria',
            'lastname' => 'Lovecraft',
        ]);
        // Acting as the authenticated user
        $this->actingAs($user);
        $response = $this->get('/person');

        $response->assertStatus(200);
        $response->assertDontSee(__('No people found'));
        $response->assertSee('Maria');
        $response->assertSee('Lovecraft');
        $response->assertViewHas('people', function ($collection) use ($person) {
            return $collection->contains($person);
        });

    }
}
