<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Attachment;

use App\Models\Memo;
use App\Models\Inbox;
use App\Models\Extoutbox;
use App\Models\Intoutbox;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttachmentControllerTest extends TestCase
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
    public function it_displays_index_view_with_attachments(): void
    {
        $attachments = Attachment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('attachments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.attachments.index')
            ->assertViewHas('attachments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_attachment(): void
    {
        $response = $this->get(route('attachments.create'));

        $response->assertOk()->assertViewIs('app.attachments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_attachment(): void
    {
        $data = Attachment::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('attachments.store'), $data);

        $this->assertDatabaseHas('attachments', $data);

        $attachment = Attachment::latest('id')->first();

        $response->assertRedirect(route('attachments.edit', $attachment));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_attachment(): void
    {
        $attachment = Attachment::factory()->create();

        $response = $this->get(route('attachments.show', $attachment));

        $response
            ->assertOk()
            ->assertViewIs('app.attachments.show')
            ->assertViewHas('attachment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_attachment(): void
    {
        $attachment = Attachment::factory()->create();

        $response = $this->get(route('attachments.edit', $attachment));

        $response
            ->assertOk()
            ->assertViewIs('app.attachments.edit')
            ->assertViewHas('attachment');
    }

    /**
     * @test
     */
    public function it_updates_the_attachment(): void
    {
        $attachment = Attachment::factory()->create();

        $extoutbox = Extoutbox::factory()->create();
        $intoutbox = Intoutbox::factory()->create();
        $inbox = Inbox::factory()->create();
        $memo = Memo::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'extoutbox_id' => $extoutbox->id,
            'intoutbox_id' => $intoutbox->id,
            'inbox_id' => $inbox->id,
            'memo_id' => $memo->id,
        ];

        $response = $this->put(route('attachments.update', $attachment), $data);

        $data['id'] = $attachment->id;

        $this->assertDatabaseHas('attachments', $data);

        $response->assertRedirect(route('attachments.edit', $attachment));
    }

    /**
     * @test
     */
    public function it_deletes_the_attachment(): void
    {
        $attachment = Attachment::factory()->create();

        $response = $this->delete(route('attachments.destroy', $attachment));

        $response->assertRedirect(route('attachments.index'));

        $this->assertModelMissing($attachment);
    }
}
