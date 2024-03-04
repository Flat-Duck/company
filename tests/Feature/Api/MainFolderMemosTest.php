<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Memo;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainFolderMemosTest extends TestCase
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
    public function it_gets_main_folder_memos(): void
    {
        $mainFolder = MainFolder::factory()->create();
        $memos = Memo::factory()
            ->count(2)
            ->create([
                'main_folder_id' => $mainFolder->id,
            ]);

        $response = $this->getJson(
            route('api.main-folders.memos.index', $mainFolder)
        );

        $response->assertOk()->assertSee($memos[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_main_folder_memos(): void
    {
        $mainFolder = MainFolder::factory()->create();
        $data = Memo::factory()
            ->make([
                'main_folder_id' => $mainFolder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.main-folders.memos.store', $mainFolder),
            $data
        );

        $this->assertDatabaseHas('memos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $memo = Memo::latest('id')->first();

        $this->assertEquals($mainFolder->id, $memo->main_folder_id);
    }
}
