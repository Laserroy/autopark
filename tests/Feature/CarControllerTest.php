<?php

namespace Tests\Feature;

use App\Car;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\Console\Input\Input;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp():void
    {
        parent::setUp();

        $this->user = factory(User::class)->make(['role' => 'driver']);
        $this->car = factory(Car::class)->create();
        $this->actingAs($this->user);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('cars.index'));
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $response = $this->get(route('cars.show', $this->car));
        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->get(route('cars.create'));
        $response->assertStatus(200);
    }

    public function testEdit()
    {
        $response = $this->get(route('cars.edit', $this->car));
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $input = ['number' => '123456', 'driver' => 'driver'];
        $response = $this->post(route('cars.store'), $input);
        $response->assertRedirect(route('cars.index'));
        $this->assertDatabaseHas('cars', $input);
    }

    public function testUpdate()
    {
        $input = ['number' => '000000', 'driver' => 'driver'];
        $car = Car::create(['number' => '654321', 'driver' => 'driver']);
        $response = $this->patch(route('cars.update', $car), $input);
        $this->assertDatabaseHas('cars', $input);
        $this->assertDatabaseMissing('cars', ['number' => $car->number]);
        $response->assertRedirect(route('cars.index'));
    }
}
