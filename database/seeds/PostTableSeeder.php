<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Post;
use App\Tag;
use App\Kategori;
use App\User;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = User::create([
            'name' => 'John',
            'email' => 'john@gmail.com',
            'password' => Hash::make('12345')
        ]);

        $author2 = User::create([
            'name' => 'Doe',
            'email' => 'doe@gmail.com',
            'password' => Hash::make('12345')
        ]);

        $kategori1 = Kategori::create([
            'name' => 'News'
        ]);

        $kategori2 = Kategori::create([
            'name' => 'Marketing'
        ]);

        $kategori3 = Kategori::create([
            'name' => 'Design'
        ]);

        $post1 = $author1->posts()->create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'content' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English.',
            'id_kategori' => $kategori1->id,
            'image' => 'posts/1.jpg'
        ]);

        $post2 = $author2->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'id_kategori' => $kategori2->id,
            'image' => 'posts/2.jpg'
        ]);

        $post3 = $author1->posts()->create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.',
            'content' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.',
            'id_kategori' => $kategori3->id,
            'image' => 'posts/3.jpg'
        ]);

        $tag1 = Tag::create([
            'name' => 'Record'
        ]);

        $tag2 = Tag::create([
            'name' => 'Job'
        ]);

        $tag3 = Tag::create([
            'name' => 'Customers'
        ]);

        $post1->tag()->attach([$tag1->id, $tag2->id]);
        $post2->tag()->attach([$tag2->id, $tag3->id]);
        $post3->tag()->attach([$tag1->id, $tag3->id]);
    }
}
