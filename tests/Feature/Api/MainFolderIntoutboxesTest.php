<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Intoutbox;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainFolderIntoutboxesTest extends TestCase
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
    public function it_gets_main_folder_intoutboxes(): void
    {
        $mainFolder = MainFolder::factory()->create();
        $intoutboxes = Intoutbox::factory()
            ->count(2)
            ->create([
                'main_folder_id' => $mainFolder->id,
            ]);

        $response = $this->getJson(
            route('api.main-folders.intoutboxes.index', $mainFolder)
        );

        $response->assertOk()->assertSee($intoutboxes[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_main_folder_intoutboxes(): void
    {
        $mainFolder = MainFolder::factory()->create();
        $data = Intoutbox::factory()
            ->make([
                'main_folder_id' => $mainFolder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.main-folders.intoutboxes.store', $mainFolder),
            $data
        );

        $this->assertDatabaseHas('intoutboxes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $intoutbox = Intoutbox::latest('id')->first();

        $this->assertEquals($mainFolder->id, $intoutbox->main_folder_id);
    }
}
