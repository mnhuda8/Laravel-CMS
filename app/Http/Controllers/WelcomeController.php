<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Post;
use App\Tag;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome')
            ->with('posts', Post::searched()->simplePaginate(4))
            ->with('kategori', Kategori::all())
            ->with('tags', Tag::all());
    }
}
