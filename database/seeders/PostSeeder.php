<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->title = $faker->words(4, true);
            $post->cover_image = $faker->imageUrl(600, 300, 'Posts', true, $post->title, true, 'jpg');
            $post->slug = Str::of($post->title)->slug('-');
            $post->content = $faker->text(400);
            $post->save();
        }
    }
}
