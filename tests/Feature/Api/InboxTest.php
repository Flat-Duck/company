<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Inbox;

use App\Models\SubFolder;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InboxTest extends TestCase
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
    public function it_gets_inboxes_list(): void
    {
        $inboxes = Inbox::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.inboxes.index'));

        $response->assertOk()->assertSee($inboxes[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_inbox(): void
    {
        $data = Inbox::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.inboxes.store'), $data);

        $this->assertDatabaseHas('inboxes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_inbox(): void
    {
        $inbox = Inbox::factory()->create();

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

        $response = $this->putJson(route('api.inboxes.update', $inbox), $data);

        $data['id'] = $inbox->id;

        $this->assertDatabaseHas('inboxes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_inbox(): void
    {
        $inbox = Inbox::factory()->create();

        $response = $this->deleteJson(route('api.inboxes.destroy', $inbox));

        $this->assertModelMissing($inbox);

        $response->assertNoContent();
    }
}
