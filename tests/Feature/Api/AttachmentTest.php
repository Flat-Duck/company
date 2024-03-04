<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Attachment;

use App\Models\Memo;
use App\Models\Inbox;
use App\Models\Extoutbox;
use App\Models\Intoutbox;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttachmentTest extends TestCase
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
    public function it_gets_attachments_list(): void
    {
        $attachments = Attachment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.attachments.index'));

        $response->assertOk()->assertSee($attachments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_attachment(): void
    {
        $data = Attachment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.attachments.store'), $data);

        $this->assertDatabaseHas('attachments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.attachments.update', $attachment),
            $data
        );

        $data['id'] = $attachment->id;

        $this->assertDatabaseHas('attachments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_attachment(): void
    {
        $attachment = Attachment::factory()->create();

        $response = $this->deleteJson(
            route('api.attachments.destroy', $attachment)
        );

        $this->assertModelMissing($attachment);

        $response->assertNoContent();
    }
}
