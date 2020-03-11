<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Post;
use App\Kategori;
use App\Tag;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        return view('blog.show')->with('post', $post);
    }

    public function kategori(Kategori $kategori)
    {
        return view('blog.kategori')
        ->with('ktg', $kategori)
        ->with('posts', $kategori->posts()->searched()->simplePaginate(4))
        ->with('kategori', Kategori::all())
        ->with('tags', Tag::all());
    }

    public function tag(Tag $tag)
    {
        return view('blog.tag')
        ->with('tag', $tag)
        ->with('posts', $tag->posts()->searched()->simplePaginate(4))
        ->with('kategori', Kategori::all())
        ->with('tags', Tag::all());
    }
}
