<?php

namespace Database\Factories;

use App\Models\Attachment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attachment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'extoutbox_id' => \App\Models\Extoutbox::factory(),
            'intoutbox_id' => \App\Models\Intoutbox::factory(),
            'inbox_id' => \App\Models\Inbox::factory(),
            'memo_id' => \App\Models\Memo::factory(),
        ];
    }
}
