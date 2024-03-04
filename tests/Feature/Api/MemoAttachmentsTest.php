<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Memo;
use App\Models\Attachment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MemoAttachmentsTest extends TestCase
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
    public function it_gets_memo_attachments(): void
    {
        $memo = Memo::factory()->create();
        $attachments = Attachment::factory()
            ->count(2)
            ->create([
                'memo_id' => $memo->id,
            ]);

        $response = $this->getJson(route('api.memos.attachments.index', $memo));

        $response->assertOk()->assertSee($attachments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_memo_attachments(): void
    {
        $memo = Memo::factory()->create();
        $data = Attachment::factory()
            ->make([
                'memo_id' => $memo->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.memos.attachments.store', $memo),
            $data
        );

        $this->assertDatabaseHas('attachments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $attachment = Attachment::latest('id')->first();

        $this->assertEquals($memo->id, $attachment->memo_id);
    }
}
