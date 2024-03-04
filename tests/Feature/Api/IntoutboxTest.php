<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Intoutbox;

use App\Models\SubFolder;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IntoutboxTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_intoutboxes_list(): void
    {
        $intoutboxes = Intoutbox::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.intoutboxes.index'));

        $response->assertOk()->assertSee($intoutboxes[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_intoutbox(): void
    {
        $data = Intoutbox::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.intoutboxes.store'), $data);

        $this->assertDatabaseHas('intoutboxes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_intoutbox(): void
    {
        $intoutbox = Intoutbox::factory()->create();

        $mainFolder = MainFolder::factory()->create();
        $subFolder = SubFolder::factory()->create();

        $data = [
            'number' => $this->faker->text(255),
            'registered_at' => $this->faker->dateTime(),
            'issued_at' => $this->faker->dateTime(),
            'sender' => $this->faker->text(255),
            'receiver' => $this->faker->text(255),
            'subject' => $this->faker->text(),
            'main_folder_id' => $mainFolder->id,
            'sub_folder_id' => $subFolder->id,
        ];

        $response = $this->putJson(
            route('api.intoutboxes.update', $intoutbox),
            $data
        );

        $data['id'] = $intoutbox->id;

        $this->assertDatabaseHas('intoutboxes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_intoutbox(): void
    {
        $intoutbox = Intoutbox::factory()->create();

        $response = $this->deleteJson(
            route('api.intoutboxes.destroy', $intoutbox)
        );

        $this->assertModelMissing($intoutbox);

        $response->assertNoContent();
    }
}
