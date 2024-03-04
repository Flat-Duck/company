<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Memo;
use App\Models\SubFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubFolderMemosTest extends TestCase
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
    public function it_gets_sub_folder_memos(): void
    {
        $subFolder = SubFolder::factory()->create();
        $memos = Memo::factory()
            ->count(2)
            ->create([
                'sub_folder_id' => $subFolder->id,
            ]);

        $response = $this->getJson(
            route('api.sub-folders.memos.index', $subFolder)
        );

        $response->assertOk()->assertSee($memos[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_folder_memos(): void
    {
        $subFolder = SubFolder::factory()->create();
        $data = Memo::factory()
            ->make([
                'sub_folder_id' => $subFolder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sub-folders.memos.store', $subFolder),
            $data
        );

        $this->assertDatabaseHas('memos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $memo = Memo::latest('id')->first();

        $this->assertEquals($subFolder->id, $memo->sub_folder_id);
    }
}
