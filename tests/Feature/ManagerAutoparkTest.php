<?php

namespace Tests\Feature;

use App\Autopark;
use App\Car;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManagerAutoparkTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    protected function setUp():void
    {
        parent::setUp();

        $this->user = factory(User::class)->make(['role' => User::ROLE_MANAGER]);
        $this->autopark = factory(Autopark::class)->create();
        $this->actingAs($this->user);
    }

    public function testAutoparkIndex()
    {
        $response = $this->get(route('manager.autoparks.index'));
        $response->assertStatus(200);
    }

    public function testCarShow()
    {
        $response = $this->get(route('manager.autoparks.show', $this->autopark));
        $response->assertStatus(200);
    }

    public function testCreateAutopark()
    {
        $response = $this->get(route('manager.autoparks.create'));
        $response->assertStatus(200);
        $input = ['name' => 'company', 'address' => 'country'];
        $response = $this->post(route('manager.autoparks.store'), $input);
        $response->assertRedirect(route('manager.autoparks.index'));
        $this->assertDatabaseHas('autoparks', $input);
    }

    public function testEditAutopark()
    {
        $response = $this->get(route('manager.autoparks.edit', $this->autopark));

        $response->assertStatus(200);

        $car = Car::create(['number' => '654321', 'driver' => 'driver']);
        $this->autopark->cars()->attach($car->id);
        $autoparkOldName = $this->autopark->name;
        $newCarInput = ['number' => '000000', 'driver' => 'driver'];
        $updateCarInput = ['id' => $car->id, 'number' => '123456', 'driver' => 'test'];
        $input = ['newCars' => [$newCarInput],
                  'updatedCars' => [$updateCarInput],
                  'name' => 'company',
                  'address' => 'country'];
        $response = $this->patch(route('manager.autoparks.update', $this->autopark), $input);

        $response->assertRedirect(route('manager.autoparks.index'));
        $this->assertDatabaseMissing('autoparks', ['name' => $autoparkOldName]);
        $this->assertDatabaseHas('autoparks', ['name' => 'company']);
    }


    public function testAutoparkDelete()
    {
        $response = $this->delete(route('manager.autoparks.destroy', $this->autopark));
        $response->assertRedirect(route('manager.autoparks.index'));
        $this->assertDatabaseMissing('cars', ['id' => $this->autopark->id]);
    }
}
