<?php

namespace Tests\Unit;

use App\Http\Services\CurrencyManager;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase as TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_user()
    {

        $currency = ['USD', 'GBP', 'EUR'];

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'hourly_rate' => rand(1, 200),
            'currency' => $currency[array_rand($currency, 1)],
        ];

        $this->post(route('users.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }

    public function test_can_update_user()
    {

        $user = factory(User::class)->create();
        $currency = ['USD', 'GBP', 'EUR'];

        $data = [
            'name' => $this->faker->name,
            'hourly_rate' => rand(1, 200),
            'currency' => $currency[array_rand($currency, 1)],
        ];

        $this->put(route('users.update', $user->id), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    public function test_can_show_user()
    {

        $user = factory(User::class)->create();

        $this->get(route('users.show', $user->id))
            ->assertStatus(200);
    }

    public function test_can_delete_user()
    {

        $user = factory(User::class)->create();

        $this->delete(route('users.destroy', $user->id))
            ->assertStatus(204);
    }

    public function test_can_list_users()
    {
        $users = factory(User::class, 2)->create()->map(function ($user) {
            return $user->only(['id', 'name', 'email', 'hourly_rate', 'currency', 'created_at', 'updated_at']);
        });

        $this->get(route('users.index'))
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'name', 'email', 'hourly_rate', 'currency', 'created_at', 'updated_at'],
            ]);
    }
}
