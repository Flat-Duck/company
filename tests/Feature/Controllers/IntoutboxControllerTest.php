<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Intoutbox;

use App\Models\SubFolder;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IntoutboxControllerTest extends TestCase
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
    public function it_displays_index_view_with_intoutboxes(): void
    {
        $intoutboxes = Intoutbox::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('intoutboxes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.intoutboxes.index')
            ->assertViewHas('intoutboxes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_intoutbox(): void
    {
        $response = $this->get(route('intoutboxes.create'));

        $response->assertOk()->assertViewIs('app.intoutboxes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_intoutbox(): void
    {
        $data = Intoutbox::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('intoutboxes.store'), $data);

        $this->assertDatabaseHas('intoutboxes', $data);

        $intoutbox = Intoutbox::latest('id')->first();

        $response->assertRedirect(route('intoutboxes.edit', $intoutbox));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_intoutbox(): void
    {
        $intoutbox = Intoutbox::factory()->create();

        $response = $this->get(route('intoutboxes.show', $intoutbox));

        $response
            ->assertOk()
            ->assertViewIs('app.intoutboxes.show')
            ->assertViewHas('intoutbox');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_intoutbox(): void
    {
        $intoutbox = Intoutbox::factory()->create();

        $response = $this->get(route('intoutboxes.edit', $intoutbox));

        $response
            ->assertOk()
            ->assertViewIs('app.intoutboxes.edit')
            ->assertViewHas('intoutbox');
    }

    /**
     * @test
     */
    public function it_updates_the_intoutbox(): void
    {
        $intoutbox = Intoutbox::factory()->create();

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

        $response = $this->put(route('intoutboxes.update', $intoutbox), $data);

        $data['id'] = $intoutbox->id;

        $this->assertDatabaseHas('intoutboxes', $data);

        $response->assertRedirect(route('intoutboxes.edit', $intoutbox));
    }

    /**
     * @test
     */
    public function it_deletes_the_intoutbox(): void
    {
        $intoutbox = Intoutbox::factory()->create();

        $response = $this->delete(route('intoutboxes.destroy', $intoutbox));

        $response->assertRedirect(route('intoutboxes.index'));

        $this->assertModelMissing($intoutbox);
    }
}
