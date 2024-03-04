<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Extoutbox;
use App\Models\Attachment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExtoutboxAttachmentsTest extends TestCase
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
    public function it_gets_extoutbox_attachments(): void
    {
        $extoutbox = Extoutbox::factory()->create();
        $attachments = Attachment::factory()
            ->count(2)
            ->create([
                'extoutbox_id' => $extoutbox->id,
            ]);

        $response = $this->getJson(
            route('api.extoutboxes.attachments.index', $extoutbox)
        );

        $response->assertOk()->assertSee($attachments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_extoutbox_attachments(): void
    {
        $extoutbox = Extoutbox::factory()->create();
        $data = Attachment::factory()
            ->make([
                'extoutbox_id' => $extoutbox->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.extoutboxes.attachments.store', $extoutbox),
            $data
        );

        $this->assertDatabaseHas('attachments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $attachment = Attachment::latest('id')->first();

        $this->assertEquals($extoutbox->id, $attachment->extoutbox_id);
    }
}
