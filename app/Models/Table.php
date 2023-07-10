<?php

namespace App\Models;

use App\Enums\TableLokasi;
use App\Enums\TableStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'kapasitas',
        'status',
        'lokasi'
        
    ];

    protected $casts = [
        'status' => TableStatus::class,
        'lokasi' => TableLokasi::class
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class);
    }
}
