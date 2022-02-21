<?php

namespace Database\Seeders;

use App\Models\{Category, Gambar, User, Post, Profile};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Primera Justicia',
            'username' => 'Primera',
            'email' => 'primerajusticia@gmail.com',
            'password' => bcrypt('primerajustice14'),
            'is_admin' => 1
        ]);
        // User::factory(3)->create();
        // Post::factory(20)->create();

        Category::create([
            'name' => 'Event',
            'slug' => 'event'
        ]);

        Category::create([
            'name' => 'Programming',
            'slug' => 'programming'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Gambar::create([
            'id' => 303,
            'hero' => '',
            'bg_about' => '',
            'about' => ''
        ]);

        Profile::create([
            'id' => 303,
            'alamat' => 'alamat',
            'email' => 'email@gmail.com',
            'phone' => '088809090909',
            'link_video' => 'https://www.youtube.com/watch?v=AiPDZErbZ6I'
        ]);
    }
}