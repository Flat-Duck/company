<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Inbox;

use App\Models\SubFolder;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InboxControllerTest extends TestCase
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
    public function it_displays_index_view_with_inboxes(): void
    {
        $inboxes = Inbox::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('inboxes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.inboxes.index')
            ->assertViewHas('inboxes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_inbox(): void
    {
        $response = $this->get(route('inboxes.create'));

        $response->assertOk()->assertViewIs('app.inboxes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_inbox(): void
    {
        $data = Inbox::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('inboxes.store'), $data);

        $this->assertDatabaseHas('inboxes', $data);

        $inbox = Inbox::latest('id')->first();

        $response->assertRedirect(route('inboxes.edit', $inbox));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_inbox(): void
    {
        $inbox = Inbox::factory()->create();

        $response = $this->get(route('inboxes.show', $inbox));

        $response
            ->assertOk()
            ->assertViewIs('app.inboxes.show')
            ->assertViewHas('inbox');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_inbox(): void
    {
        $inbox = Inbox::factory()->create();

        $response = $this->get(route('inboxes.edit', $inbox));

        $response
            ->assertOk()
            ->assertViewIs('app.inboxes.edit')
            ->assertViewHas('inbox');
    }

    /**
     * @test
     */
    public function it_updates_the_inbox(): void
    {
        $inbox = Inbox::factory()->create();

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

        $response = $this->put(route('inboxes.update', $inbox), $data);

        $data['id'] = $inbox->id;

        $this->assertDatabaseHas('inboxes', $data);

        $response->assertRedirect(route('inboxes.edit', $inbox));
    }

    /**
     * @test
     */
    public function it_deletes_the_inbox(): void
    {
        $inbox = Inbox::factory()->create();

        $response = $this->delete(route('inboxes.destroy', $inbox));

        $response->assertRedirect(route('inboxes.index'));

        $this->assertModelMissing($inbox);
    }
}
