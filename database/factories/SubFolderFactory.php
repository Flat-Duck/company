<?php

namespace Database\Factories;

use App\Models\SubFolder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubFolderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubFolder::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'main_folder_id' => \App\Models\MainFolder::factory(),
        ];
    }
}
