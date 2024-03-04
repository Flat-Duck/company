<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Inbox;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainFolderInboxesTest extends TestCase
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
    public function it_gets_main_folder_inboxes(): void
    {
        $mainFolder = MainFolder::factory()->create();
        $inboxes = Inbox::factory()
            ->count(2)
            ->create([
                'main_folder_id' => $mainFolder->id,
            ]);

        $response = $this->getJson(
            route('api.main-folders.inboxes.index', $mainFolder)
        );

        $response->assertOk()->assertSee($inboxes[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_main_folder_inboxes(): void
    {
        $mainFolder = MainFolder::factory()->create();
        $data = Inbox::factory()
            ->make([
                'main_folder_id' => $mainFolder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.main-folders.inboxes.store', $mainFolder),
            $data
        );

        $this->assertDatabaseHas('inboxes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $inbox = Inbox::latest('id')->first();

        $this->assertEquals($mainFolder->id, $inbox->main_folder_id);
    }
}
