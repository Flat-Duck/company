<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Extoutbox;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainFolderExtoutboxesTest extends TestCase
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
    public function it_gets_main_folder_extoutboxes(): void
    {
        $mainFolder = MainFolder::factory()->create();
        $extoutboxes = Extoutbox::factory()
            ->count(2)
            ->create([
                'main_folder_id' => $mainFolder->id,
            ]);

        $response = $this->getJson(
            route('api.main-folders.extoutboxes.index', $mainFolder)
        );

        $response->assertOk()->assertSee($extoutboxes[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_main_folder_extoutboxes(): void
    {
        $mainFolder = MainFolder::factory()->create();
        $data = Extoutbox::factory()
            ->make([
                'main_folder_id' => $mainFolder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.main-folders.extoutboxes.store', $mainFolder),
            $data
        );

        $this->assertDatabaseHas('extoutboxes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $extoutbox = Extoutbox::latest('id')->first();

        $this->assertEquals($mainFolder->id, $extoutbox->main_folder_id);
    }
}
