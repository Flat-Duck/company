<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SubFolder;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainFolderSubFoldersTest extends TestCase
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
    public function it_gets_main_folder_sub_folders(): void
    {
        $mainFolder = MainFolder::factory()->create();
        $subFolders = SubFolder::factory()
            ->count(2)
            ->create([
                'main_folder_id' => $mainFolder->id,
            ]);

        $response = $this->getJson(
            route('api.main-folders.sub-folders.index', $mainFolder)
        );

        $response->assertOk()->assertSee($subFolders[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_main_folder_sub_folders(): void
    {
        $mainFolder = MainFolder::factory()->create();
        $data = SubFolder::factory()
            ->make([
                'main_folder_id' => $mainFolder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.main-folders.sub-folders.store', $mainFolder),
            $data
        );

        $this->assertDatabaseHas('sub_folders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $subFolder = SubFolder::latest('id')->first();

        $this->assertEquals($mainFolder->id, $subFolder->main_folder_id);
    }
}
