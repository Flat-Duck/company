<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SubFolder;

use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubFolderTest extends TestCase
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
    public function it_gets_sub_folders_list(): void
    {
        $subFolders = SubFolder::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sub-folders.index'));

        $response->assertOk()->assertSee($subFolders[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_folder(): void
    {
        $data = SubFolder::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.sub-folders.store'), $data);

        $this->assertDatabaseHas('sub_folders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_sub_folder(): void
    {
        $subFolder = SubFolder::factory()->create();

        $mainFolder = MainFolder::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'main_folder_id' => $mainFolder->id,
        ];

        $response = $this->putJson(
            route('api.sub-folders.update', $subFolder),
            $data
        );

        $data['id'] = $subFolder->id;

        $this->assertDatabaseHas('sub_folders', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sub_folder(): void
    {
        $subFolder = SubFolder::factory()->create();

        $response = $this->deleteJson(
            route('api.sub-folders.destroy', $subFolder)
        );

        $this->assertModelMissing($subFolder);

        $response->assertNoContent();
    }
}
