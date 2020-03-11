<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;

use App\Post;
use App\Kategori;
use App\Tag;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyKategoriCount')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('data', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('kategori', Kategori::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        //save the image to storage
        $image = $request->image->store('posts');

        //create the post
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'id_pengguna' => auth()->user()->id,
            'id_kategori' => $request->id_kategori
        ]);
        
        if($request->tags){
            $post->tag()->attach($request->tags);
        }

        //flash message
        session()->flash('success', 'Berhasil Menyimpan Post');

        //redirect
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('data', $post)->with('kategori', Kategori::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        //menyimpan data custom
        $data = $request->only(['title', 'description', 'published_at', 'content']);

        //cek apakah ada upload file image
        if($request->hasFile('image')){
            //mengupload file image
            $image = $request->image->store('posts');

            //mebghapus file image lama
            $post->deleteImage();

            //menyimpan nama file image yang baru
            $data['image'] = $image;
        }

        if($request->tags){
            $post->tag()->sync($request->tags);
        }

        $post->update($data);

        session()->flash('success', 'Berhasil Menyimpan Perubahan');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if($post->trashed()){
            $post->deleteImage();
            $post->forceDelete();
        }else{
            $post->delete();
        }

        //flash message
        session()->flash('success', 'Berhasil Menghapus Post');

        //redirect
        return redirect(route('posts.index'));
    }

    /**
     * Display all trashed data post.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('data', $trashed);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Berhasil Mengembalikan Post');

        return redirect()->back();
    }
}
