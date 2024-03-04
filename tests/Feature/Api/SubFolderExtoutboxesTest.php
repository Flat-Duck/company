<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SubFolder;
use App\Models\Extoutbox;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubFolderExtoutboxesTest extends TestCase
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
    public function it_gets_sub_folder_extoutboxes(): void
    {
        $subFolder = SubFolder::factory()->create();
        $extoutboxes = Extoutbox::factory()
            ->count(2)
            ->create([
                'sub_folder_id' => $subFolder->id,
            ]);

        $response = $this->getJson(
            route('api.sub-folders.extoutboxes.index', $subFolder)
        );

        $response->assertOk()->assertSee($extoutboxes[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_folder_extoutboxes(): void
    {
        $subFolder = SubFolder::factory()->create();
        $data = Extoutbox::factory()
            ->make([
                'sub_folder_id' => $subFolder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sub-folders.extoutboxes.store', $subFolder),
            $data
        );

        $this->assertDatabaseHas('extoutboxes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $extoutbox = Extoutbox::latest('id')->first();

        $this->assertEquals($subFolder->id, $extoutbox->sub_folder_id);
    }
}
