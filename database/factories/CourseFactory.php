<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        $price = $this->faker->randomFloat(2, 0, 200);
        $isFree = $this->faker->boolean(20);

        return [
            "title" => $this->faker->sentence(3),
            "slug" => $this->faker->unique()->slug(),
            "short_description" => $this->faker->sentence(8),
            "description" => $this->faker->paragraphs(3, true),
            "category_id" => Category::inRandomOrder()->first()?->id ?? null,
            "level" => $this->faker->randomElement(["beginner", "intermediate", "advanced"]),
            "duration" => $this->faker->numberBetween(30, 600),
            "price" => $isFree ? 0 : $price,
            "is_free" => $isFree,
            "discount_price" => $isFree ? null : $this->faker->optional()->randomFloat(2, 10, $price),
            "status" => $this->faker->randomElement(["draft", "published", "archived"]),
            "meta" => [
                "tags" => $this->faker->words(5),
                "language" => $this->faker->randomElement(["bg", "en"]),
            ],
            "published_at" => $this->faker->optional()->dateTimeBetween("-1 year", "now"),
            "expires_at" => $this->faker->optional()->dateTimeBetween("now", "+1 year"),
        ];
    }
}
