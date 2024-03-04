<?php

namespace Database\Factories;

use App\Models\Extoutbox;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExtoutboxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Extoutbox::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->text(255),
            'registered_at' => $this->faker->dateTime(),
            'issued_at' => $this->faker->dateTime(),
            'sender' => $this->faker->text(255),
            'receiver' => $this->faker->text(255),
            'subject' => $this->faker->text(),
            'main_folder_id' => \App\Models\MainFolder::factory(),
            'sub_folder_id' => \App\Models\SubFolder::factory(),
        ];
    }
}
