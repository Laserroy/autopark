<?php

namespace Tests\Feature;

use App\Autopark;
use App\Car;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManagerCarTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp():void
    {
        parent::setUp();

        $this->user = factory(User::class)->make(['role' => User::ROLE_MANAGER]);
        $this->car = factory(Car::class)->create();
        $this->actingAs($this->user);
    }

    public function testCarIndex()
    {
        $response = $this->get(route('manager.cars.index'));
        $response->assertStatus(200);
    }

    public function testCarShow()
    {
        $response = $this->get(route('manager.cars.show', $this->car));
        $response->assertStatus(200);
    }

    public function testCreateCar()
    {
        $response = $this->get(route('manager.cars.create'));
        $response->assertStatus(200);
        $input = ['number' => '123456', 'driver' => 'driver'];
        $response = $this->post(route('manager.cars.store'), $input);
        $response->assertRedirect(route('manager.cars.index'));
        $this->assertDatabaseHas('cars', $input);
    }

    public function testEditCar()
    {
        $response = $this->get(route('manager.cars.edit', $this->car));
        $response->assertStatus(200);
        $input = ['number' => '000000', 'driver' => 'driver'];
        $car = Car::create(['number' => '654321', 'driver' => 'driver']);
        $response = $this->patch(route('manager.cars.update', $car), $input);
        $this->assertDatabaseHas('cars', $input);
        $this->assertDatabaseMissing('cars', ['number' => $car->number]);
        $response->assertRedirect(route('manager.cars.index'));
    }

    public function testAttachAutoparkToCar()
    {
        $autopark = factory(Autopark::class)->create();
        $input = ['number' => '000001', 'driver' => 'driver', 'autoparks' => [$autopark->id]];
        $response = $this->post(route('manager.cars.store'), $input);
        $response->assertRedirect(route('manager.cars.index'));
        $createdCar = Car::whereNumber('000001')->first();
        $carAutoparks = $createdCar->autoparks;
        $this->assertDatabaseHas('cars', ['number' => '000001']);
        $this->assertTrue($carAutoparks->contains($autopark));
    }

    public function testDetachAutoparkFromCar()
    {
        $autopark = factory(Autopark::class)->create();
        $this->car->autoparks()->sync($autopark->id);
        $input = ['number' => '000002', 'driver' => 'driver', 'autoparksToRemove' => [$autopark->id]];
        $response = $this->patch(route('manager.cars.update', $this->car), $input);
        $response->assertRedirect(route('manager.cars.index'));
        $carAutoparks = $this->car->autoparks;
        $this->assertDatabaseHas('cars', ['id' => $this->car->id]);
        $this->assertFalse($carAutoparks->contains($autopark));
    }

    public function testCarDelete()
    {
        $response = $this->delete(route('manager.cars.destroy', $this->car));
        $response->assertRedirect(route('manager.cars.index'));
        $this->assertDatabaseMissing('cars', ['id' => $this->car->id]);
    }
}
