<?php

namespace Tests\Feature;

use App\Car;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\Console\Input\Input;
use Tests\TestCase;

class DriverCarTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp():void
    {
        parent::setUp();

        $this->user = factory(User::class)->make(['role' => User::ROLE_DRIVER]);
        $this->car = factory(Car::class)->create();
        $this->actingAs($this->user);
    }

    public function testCarIndex()
    {
        $response = $this->get(route('cars.index'));
        $response->assertStatus(200);
    }

    public function testCarShow()
    {
        $response = $this->get(route('cars.show', $this->car));
        $response->assertStatus(200);
    }

    public function testCreateCar()
    {
        $response = $this->get(route('cars.create'));
        $response->assertStatus(200);
        $input = ['number' => '123456', 'driver' => 'driver'];
        $response = $this->post(route('cars.store'), $input);
        $response->assertRedirect(route('cars.index'));
        $this->assertDatabaseHas('cars', $input);
    }

    public function testEditCar()
    {
        $response = $this->get(route('cars.edit', $this->car));
        $response->assertStatus(200);
        $input = ['number' => '000000', 'driver' => 'driver'];
        $car = Car::create(['number' => '654321', 'driver' => 'driver']);
        $response = $this->patch(route('cars.update', $car), $input);
        $this->assertDatabaseHas('cars', $input);
        $this->assertDatabaseMissing('cars', ['number' => $car->number]);
        $response->assertRedirect(route('cars.index'));
    }
}
