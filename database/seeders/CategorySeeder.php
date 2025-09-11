<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $statuses = ['draft', 'published', 'archived', 'hidden', 'pending', 'deleted'];

        for ($i = 1; $i <= 10; $i++) {
            $name = ucfirst($faker->unique()->words(2, true));

            $parent = Category::create([
                'name'        => $name,
                'slug'        => Str::slug($name) . '-' . $i,
                'description' => implode(' ', $faker->paragraphs(5)),
                'parent_id'   => null,
                'image'       => $faker->imageUrl(640, 480, 'categories', true),
                'status'      => $faker->randomElement($statuses),
                'sort_order'  => $i,
            ]);

            for ($j = 1; $j <= rand(3, 6); $j++) {
                $subName = ucfirst($faker->unique()->words(2, true));

                $child = Category::create([
                    'name'        => $subName,
                    'slug'        => Str::slug($subName) . '-' . $i . '-' . $j,
                    'description' => $faker->sentence(),
                    'parent_id'   => $parent->id,
                    'image'       => $faker->imageUrl(640, 480, 'categories', true),
                    'status'      => $faker->randomElement($statuses),
                    'sort_order'  => $j,
                ]);

                for ($k = 1; $k <= rand(1, 3); $k++) {
                    $subSubName = ucfirst($faker->unique()->words(2, true));

                    Category::create([
                        'name'        => $subSubName,
                        'slug'        => Str::slug($subSubName) . '-' . $i . '-' . $j . '-' . $k,
                        'description' => $faker->sentence(),
                        'parent_id'   => $child->id,
                        'image'       => $faker->imageUrl(640, 480, 'categories', true),
                        'status'      => $faker->randomElement($statuses),
                        'sort_order'  => $k,
                    ]);
                }
            }
        }
    }
}
