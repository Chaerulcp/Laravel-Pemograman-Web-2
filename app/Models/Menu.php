<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'harga', 'deskripsi', 'image'];

    public function kategori()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_menu');
    }
}
