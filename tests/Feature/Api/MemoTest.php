<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Memo;

use App\Models\SubFolder;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MemoTest extends TestCase
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
    public function it_gets_memos_list(): void
    {
        $memos = Memo::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.memos.index'));

        $response->assertOk()->assertSee($memos[0]->number);
    }

    /**
     * @test
     */
    public function it_stores_the_memo(): void
    {
        $data = Memo::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.memos.store'), $data);

        $this->assertDatabaseHas('memos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_memo(): void
    {
        $memo = Memo::factory()->create();

        $mainFolder = MainFolder::factory()->create();
        $subFolder = SubFolder::factory()->create();

        $data = [
            'number' => $this->faker->text(255),
            'registered_at' => $this->faker->dateTime(),
            'issued_at' => $this->faker->dateTime(),
            'type' => $this->faker->word(),
            'subject' => $this->faker->text(),
            'main_folder_id' => $mainFolder->id,
            'sub_folder_id' => $subFolder->id,
        ];

        $response = $this->putJson(route('api.memos.update', $memo), $data);

        $data['id'] = $memo->id;

        $this->assertDatabaseHas('memos', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_memo(): void
    {
        $memo = Memo::factory()->create();

        $response = $this->deleteJson(route('api.memos.destroy', $memo));

        $this->assertModelMissing($memo);

        $response->assertNoContent();
    }
}
