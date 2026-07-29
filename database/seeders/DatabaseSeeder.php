<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Alif Rahmat Julianda',
            'username' => 'AlifRJ',
            'email' => 'test@example.com',
            // 'password' => Hash::make("password"),
        ]);
        PostCategory::factory()->create([
            'name' => 'Category 1',
            'slug' => 'category-1',
        ]);
        PostCategory::factory()->create([
            'name' => 'Category 2',
            'slug' => 'category-2',
        ]);
        Post::factory()->create([
            'user_id' => 1,
            'category_id' => 1,
            'title' => 'Lorem ipsum dolor sit amet',
            'slug' => 'lorem-ipsum-dolor-sit-amet',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam gravida egestas porttitor. Suspendisse rutrum, erat quis vehicula scelerisque, lacus magna aliquet orci, ut laoreet arcu velit nec quam.',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam gravida egestas porttitor. Suspendisse rutrum, erat quis vehicula scelerisque, lacus magna aliquet orci, ut laoreet arcu velit nec quam. Nulla lobortis nunc ligula, in tristique lectus viverra quis. Nullam dapibus est nisl, non porta justo porttitor vel. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Integer sed nulla sed nulla posuere elementum sed eget neque. Fusce sed sagittis nibh. Pellentesque finibus tellus ac dui ultrices iaculis. Aliquam mollis enim odio, id cursus ex tincidunt in. Donec pharetra vehicula sem non fringilla. Nullam vitae metus leo. Curabitur nec diam aliquet sem hendrerit aliquam a in nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec in ultrices augue. Morbi tempor nisl hendrerit scelerisque ultricies. Aenean erat mauris, cursus sit amet consequat id, porttitor mollis est.',
        ]);
        Post::factory()->create([
            'user_id' => 1,
            'category_id' => 2,
            'title' => 'Cras varius accumsan nunc ut lobortis',
            'slug' => 'cras-varius-accumsan-nunc-ut-lobortis',
            'excerpt' => 'Cras varius accumsan nunc ut lobortis. Donec commodo sapien id magna fermentum, nec viverra neque euismod.',
            'body' => 'Cras varius accumsan nunc ut lobortis. Donec commodo sapien id magna fermentum, nec viverra neque euismod. Quisque a aliquet leo, at eleifend lorem. Etiam laoreet, nisl ut vulputate vestibulum, massa tellus sagittis magna, at faucibus magna sem ut nunc. Quisque venenatis nec est eget tempus. Maecenas eu purus volutpat, venenatis felis ac, mollis tortor. Cras nec tempor neque, ac varius velit. Fusce laoreet volutpat ex, eu pretium metus dictum eu.',
        ]);
    }
}
