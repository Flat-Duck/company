<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Inbox;
use App\Models\Attachment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InboxAttachmentsTest extends TestCase
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
    public function it_gets_inbox_attachments(): void
    {
        $inbox = Inbox::factory()->create();
        $attachments = Attachment::factory()
            ->count(2)
            ->create([
                'inbox_id' => $inbox->id,
            ]);

        $response = $this->getJson(
            route('api.inboxes.attachments.index', $inbox)
        );

        $response->assertOk()->assertSee($attachments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_inbox_attachments(): void
    {
        $inbox = Inbox::factory()->create();
        $data = Attachment::factory()
            ->make([
                'inbox_id' => $inbox->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.inboxes.attachments.store', $inbox),
            $data
        );

        $this->assertDatabaseHas('attachments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $attachment = Attachment::latest('id')->first();

        $this->assertEquals($inbox->id, $attachment->inbox_id);
    }
}
