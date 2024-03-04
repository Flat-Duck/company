<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainFolderControllerTest extends TestCase
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
    public function it_displays_index_view_with_main_folders(): void
    {
        $mainFolders = MainFolder::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('main-folders.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.main_folders.index')
            ->assertViewHas('mainFolders');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_main_folder(): void
    {
        $response = $this->get(route('main-folders.create'));

        $response->assertOk()->assertViewIs('app.main_folders.create');
    }

    /**
     * @test
     */
    public function it_stores_the_main_folder(): void
    {
        $data = MainFolder::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('main-folders.store'), $data);

        $this->assertDatabaseHas('main_folders', $data);

        $mainFolder = MainFolder::latest('id')->first();

        $response->assertRedirect(route('main-folders.edit', $mainFolder));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_main_folder(): void
    {
        $mainFolder = MainFolder::factory()->create();

        $response = $this->get(route('main-folders.show', $mainFolder));

        $response
            ->assertOk()
            ->assertViewIs('app.main_folders.show')
            ->assertViewHas('mainFolder');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_main_folder(): void
    {
        $mainFolder = MainFolder::factory()->create();

        $response = $this->get(route('main-folders.edit', $mainFolder));

        $response
            ->assertOk()
            ->assertViewIs('app.main_folders.edit')
            ->assertViewHas('mainFolder');
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

        $response = $this->put(
            route('main-folders.update', $mainFolder),
            $data
        );

        $data['id'] = $mainFolder->id;

        $this->assertDatabaseHas('main_folders', $data);

        $response->assertRedirect(route('main-folders.edit', $mainFolder));
    }

    /**
     * @test
     */
    public function it_deletes_the_main_folder(): void
    {
        $mainFolder = MainFolder::factory()->create();

        $response = $this->delete(route('main-folders.destroy', $mainFolder));

        $response->assertRedirect(route('main-folders.index'));

        $this->assertModelMissing($mainFolder);
    }
}
