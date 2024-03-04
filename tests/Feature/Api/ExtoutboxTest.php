<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Extoutbox;

use App\Models\SubFolder;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExtoutboxTest extends TestCase
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
    public function it_gets_extoutboxes_list(): void
    {
        $extoutboxes = Extoutbox::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.extoutboxes.index'));

        $response->assertOk()->assertSee($extoutboxes[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_extoutbox(): void
    {
        $data = Extoutbox::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.extoutboxes.store'), $data);

        $this->assertDatabaseHas('extoutboxes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_extoutbox(): void
    {
        $extoutbox = Extoutbox::factory()->create();

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
            route('api.extoutboxes.update', $extoutbox),
            $data
        );

        $data['id'] = $extoutbox->id;

        $this->assertDatabaseHas('extoutboxes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_extoutbox(): void
    {
        $extoutbox = Extoutbox::factory()->create();

        $response = $this->deleteJson(
            route('api.extoutboxes.destroy', $extoutbox)
        );

        $this->assertModelMissing($extoutbox);

        $response->assertNoContent();
    }
}
