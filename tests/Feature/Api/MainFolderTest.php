<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainFolderTest extends TestCase
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
    public function it_gets_main_folders_list(): void
    {
        $mainFolders = MainFolder::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.main-folders.index'));

        $response->assertOk()->assertSee($mainFolders[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_main_folder(): void
    {
        $data = MainFolder::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.main-folders.store'), $data);

        $this->assertDatabaseHas('main_folders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_main_folder(): void
    {
        $mainFolder = MainFolder::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.main-folders.update', $mainFolder),
            $data
        );

        $data['id'] = $mainFolder->id;

        $this->assertDatabaseHas('main_folders', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_main_folder(): void
    {
        $mainFolder = MainFolder::factory()->create();

        $response = $this->deleteJson(
            route('api.main-folders.destroy', $mainFolder)
        );

        $this->assertModelMissing($mainFolder);

        $response->assertNoContent();
    }
}
