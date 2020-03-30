<?php

use App\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) { 
            
            $newPost = new Post();
            $newPost->user_id = 1;
            $newPost->title = $faker->sentence(3);
            $newPost->body = $faker->paragraph(5);
            $newPost->slug = Str::slug($newPost->title) . '-' . rand(1,10000);
            $newPost->save();

         }
    }
}
