<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'title' => $this->faker->userName(),
           'slug' => $this->faker->unique()->slug,
           'summary' => $this->faker->sentences(3,true),
           'photo' => $this->faker->imageUrl('350','350'),
           'is_parent' => $this->faker->randomElement([true]),
           'status' => $this->faker->randomElement(['active','inactive']),
           'parent_id' => $this->faker->randomElement(Category::pluck('id')->toArray())
        ];
    }
}