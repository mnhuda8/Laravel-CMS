<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\Kategori\CreateKategoriRequest;
use App\Http\Requests\Kategori\UpdateKategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori.index')->with('data', Kategori::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateKategoriRequest $request)
    {   
        Kategori::create([
            'name' => $request->name
        ]);
        
        session()->flash('success', 'Berhasil Menyimpan Kategori Baru :)');

        return redirect(route('kategori.index'));
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
    public function edit(Kategori $kategori)
    {
        return view('kategori.create')->with('data', $kategori);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        $kategori->update([
            'name' => $request->name
        ]);

        session()->flash('success', 'Berhasil Menyimpan Perubahan');

        return redirect(route('kategori.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        if($kategori->posts->count() > 0){
            session()->flash('error', 'Gagal. Tidak dapat menghapus data dikarenakan data sedang digunakan pada post.');
            return redirect(route('kategori.index'));
        }

        $kategori->delete();

        session()->flash('success', 'Berhasil Menghapus Data');

        return redirect(route('kategori.index'));
    }
}
