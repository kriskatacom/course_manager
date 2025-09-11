<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Category;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $statuses = ['draft', 'published', 'archived', 'deleted'];
        $levels   = ['beginner', 'intermediate', 'advanced'];

        // Вземаме всички категории за връзка
        $categories = Category::pluck('id')->toArray();

        // Генерираме 50 курса
        for ($i = 1; $i <= 50; $i++) {
            $title = ucfirst($faker->unique()->sentence(3));

            $price = $faker->randomFloat(2, 20, 200);
            $isFree = $faker->boolean(15); // 15% от курсовете са безплатни

            Course::create([
                'title'             => $title,
                'slug'              => Str::slug($title) . '-' . $i,
                'short_description' => $faker->sentence(15), // ~15 думи
                'description'       => implode(' ', $faker->paragraphs(6)), // 50+ думи
                'category_id'       => $faker->randomElement($categories),
                'level'             => $faker->randomElement($levels),
                'duration'          => $faker->numberBetween(30, 300), // минути
                'price'             => $isFree ? null : $price,
                'is_free'           => $isFree,
                'discount_price'    => $isFree ? null : ($faker->boolean(40) ? $price - $faker->numberBetween(5, 15) : null),
                'status'            => $faker->randomElement($statuses),
                'meta'              => json_encode([
                    'language' => $faker->randomElement(['en', 'bg']),
                    'requirements' => $faker->sentences(3),
                ]),
                'published_at'      => $faker->boolean(60) ? $faker->dateTimeBetween('-1 year', 'now') : null,
                'expires_at'        => $faker->boolean(20) ? $faker->dateTimeBetween('now', '+1 year') : null,
            ]);
        }
    }
}