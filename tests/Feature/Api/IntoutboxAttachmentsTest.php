<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Intoutbox;
use App\Models\Attachment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IntoutboxAttachmentsTest extends TestCase
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
    public function it_gets_intoutbox_attachments(): void
    {
        $intoutbox = Intoutbox::factory()->create();
        $attachments = Attachment::factory()
            ->count(2)
            ->create([
                'intoutbox_id' => $intoutbox->id,
            ]);

        $response = $this->getJson(
            route('api.intoutboxes.attachments.index', $intoutbox)
        );

        $response->assertOk()->assertSee($attachments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_intoutbox_attachments(): void
    {
        $intoutbox = Intoutbox::factory()->create();
        $data = Attachment::factory()
            ->make([
                'intoutbox_id' => $intoutbox->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.intoutboxes.attachments.store', $intoutbox),
            $data
        );

        $this->assertDatabaseHas('attachments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $attachment = Attachment::latest('id')->first();

        $this->assertEquals($intoutbox->id, $attachment->intoutbox_id);
    }
}
