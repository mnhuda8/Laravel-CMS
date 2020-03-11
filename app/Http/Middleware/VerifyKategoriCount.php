<?php

namespace App\Http\Middleware;

use Closure;

use App\Kategori;

class VerifyKategoriCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Kategori::all()->count() === 0){
            session()->flash('error', 'Anda Perlu Menambahkan Data Kategori Terlebih Dahulu');

            return redirect(route('kategori.create'));
        }

        return $next($request);
    }
}
