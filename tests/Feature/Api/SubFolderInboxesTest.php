<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Inbox;
use App\Models\SubFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubFolderInboxesTest extends TestCase
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
    public function it_gets_sub_folder_inboxes(): void
    {
        $subFolder = SubFolder::factory()->create();
        $inboxes = Inbox::factory()
            ->count(2)
            ->create([
                'sub_folder_id' => $subFolder->id,
            ]);

        $response = $this->getJson(
            route('api.sub-folders.inboxes.index', $subFolder)
        );

        $response->assertOk()->assertSee($inboxes[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_folder_inboxes(): void
    {
        $subFolder = SubFolder::factory()->create();
        $data = Inbox::factory()
            ->make([
                'sub_folder_id' => $subFolder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sub-folders.inboxes.store', $subFolder),
            $data
        );

        $this->assertDatabaseHas('inboxes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $inbox = Inbox::latest('id')->first();

        $this->assertEquals($subFolder->id, $inbox->sub_folder_id);
    }
}
