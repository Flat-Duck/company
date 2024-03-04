<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Memo;

use App\Models\SubFolder;
use App\Models\MainFolder;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MemoControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_memos(): void
    {
        $memos = Memo::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('memos.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.memos.index')
            ->assertViewHas('memos');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_memo(): void
    {
        $response = $this->get(route('memos.create'));

        $response->assertOk()->assertViewIs('app.memos.create');
    }

    /**
     * @test
     */
    public function it_stores_the_memo(): void
    {
        $data = Memo::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('memos.store'), $data);

        $this->assertDatabaseHas('memos', $data);

        $memo = Memo::latest('id')->first();

        $response->assertRedirect(route('memos.edit', $memo));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_memo(): void
    {
        $memo = Memo::factory()->create();

        $response = $this->get(route('memos.show', $memo));

        $response
            ->assertOk()
            ->assertViewIs('app.memos.show')
            ->assertViewHas('memo');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_memo(): void
    {
        $memo = Memo::factory()->create();

        $response = $this->get(route('memos.edit', $memo));

        $response
            ->assertOk()
            ->assertViewIs('app.memos.edit')
            ->assertViewHas('memo');
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

        $response = $this->put(route('memos.update', $memo), $data);

        $data['id'] = $memo->id;

        $this->assertDatabaseHas('memos', $data);

        $response->assertRedirect(route('memos.edit', $memo));
    }

    /**
     * @test
     */
    public function it_deletes_the_memo(): void
    {
        $memo = Memo::factory()->create();

        $response = $this->delete(route('memos.destroy', $memo));

        $response->assertRedirect(route('memos.index'));

        $this->assertModelMissing($memo);
    }
}
