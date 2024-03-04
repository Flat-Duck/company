<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SubFolder;

use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubFolderControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_sub_folders(): void
    {
        $subFolders = SubFolder::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sub-folders.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_folders.index')
            ->assertViewHas('subFolders');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sub_folder(): void
    {
        $response = $this->get(route('sub-folders.create'));

        $response->assertOk()->assertViewIs('app.sub_folders.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sub_folder(): void
    {
        $data = SubFolder::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sub-folders.store'), $data);

        $this->assertDatabaseHas('sub_folders', $data);

        $subFolder = SubFolder::latest('id')->first();

        $response->assertRedirect(route('sub-folders.edit', $subFolder));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sub_folder(): void
    {
        $subFolder = SubFolder::factory()->create();

        $response = $this->get(route('sub-folders.show', $subFolder));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_folders.show')
            ->assertViewHas('subFolder');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sub_folder(): void
    {
        $subFolder = SubFolder::factory()->create();

        $response = $this->get(route('sub-folders.edit', $subFolder));

        $response
            ->assertOk()
            ->assertViewIs('app.sub_folders.edit')
            ->assertViewHas('subFolder');
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

        $response = $this->put(route('sub-folders.update', $subFolder), $data);

        $data['id'] = $subFolder->id;

        $this->assertDatabaseHas('sub_folders', $data);

        $response->assertRedirect(route('sub-folders.edit', $subFolder));
    }

    /**
     * @test
     */
    public function it_deletes_the_sub_folder(): void
    {
        $subFolder = SubFolder::factory()->create();

        $response = $this->delete(route('sub-folders.destroy', $subFolder));

        $response->assertRedirect(route('sub-folders.index'));

        $this->assertModelMissing($subFolder);
    }
}
