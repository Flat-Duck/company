<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Extoutbox;

use App\Models\SubFolder;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExtoutboxControllerTest extends TestCase
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
    public function it_displays_index_view_with_extoutboxes(): void
    {
        $extoutboxes = Extoutbox::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('extoutboxes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.extoutboxes.index')
            ->assertViewHas('extoutboxes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_extoutbox(): void
    {
        $response = $this->get(route('extoutboxes.create'));

        $response->assertOk()->assertViewIs('app.extoutboxes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_extoutbox(): void
    {
        $data = Extoutbox::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('extoutboxes.store'), $data);

        $this->assertDatabaseHas('extoutboxes', $data);

        $extoutbox = Extoutbox::latest('id')->first();

        $response->assertRedirect(route('extoutboxes.edit', $extoutbox));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_extoutbox(): void
    {
        $extoutbox = Extoutbox::factory()->create();

        $response = $this->get(route('extoutboxes.show', $extoutbox));

        $response
            ->assertOk()
            ->assertViewIs('app.extoutboxes.show')
            ->assertViewHas('extoutbox');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_extoutbox(): void
    {
        $extoutbox = Extoutbox::factory()->create();

        $response = $this->get(route('extoutboxes.edit', $extoutbox));

        $response
            ->assertOk()
            ->assertViewIs('app.extoutboxes.edit')
            ->assertViewHas('extoutbox');
    }

    /**
     * @test
     */
    public function it_updates_the_extoutbox(): void
    {
        $extoutbox = Extoutbox::factory()->create();

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

        $response = $this->put(route('extoutboxes.update', $extoutbox), $data);

        $data['id'] = $extoutbox->id;

        $this->assertDatabaseHas('extoutboxes', $data);

        $response->assertRedirect(route('extoutboxes.edit', $extoutbox));
    }

    /**
     * @test
     */
    public function it_deletes_the_extoutbox(): void
    {
        $extoutbox = Extoutbox::factory()->create();

        $response = $this->delete(route('extoutboxes.destroy', $extoutbox));

        $response->assertRedirect(route('extoutboxes.index'));

        $this->assertModelMissing($extoutbox);
    }
}
