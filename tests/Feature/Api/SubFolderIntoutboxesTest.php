<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SubFolder;
use App\Models\Intoutbox;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubFolderIntoutboxesTest extends TestCase
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
    public function it_gets_sub_folder_intoutboxes(): void
    {
        $subFolder = SubFolder::factory()->create();
        $intoutboxes = Intoutbox::factory()
            ->count(2)
            ->create([
                'sub_folder_id' => $subFolder->id,
            ]);

        $response = $this->getJson(
            route('api.sub-folders.intoutboxes.index', $subFolder)
        );

        $response->assertOk()->assertSee($intoutboxes[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_sub_folder_intoutboxes(): void
    {
        $subFolder = SubFolder::factory()->create();
        $data = Intoutbox::factory()
            ->make([
                'sub_folder_id' => $subFolder->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sub-folders.intoutboxes.store', $subFolder),
            $data
        );

        $this->assertDatabaseHas('intoutboxes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $intoutbox = Intoutbox::latest('id')->first();

        $this->assertEquals($subFolder->id, $intoutbox->sub_folder_id);
    }
}
