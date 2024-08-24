<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $tags = Tag::factory(10)->create();

        Post::factory(50)->create()->each(function ($post) use ($tags) {
            $post->tags()->attach($tags->random(rand(1, 3))->pluck('id')->toArray());
        });
    }
}
