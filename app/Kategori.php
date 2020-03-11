<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['name'];
    protected $table = 'kategori';

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_kategori');
    }
}
