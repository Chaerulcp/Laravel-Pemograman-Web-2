<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi', 'image'];

    public function menu()
    {
        return $this->belongsToMany(Menu::class, 'kategori_menu');
    }
}
