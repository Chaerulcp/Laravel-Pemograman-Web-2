<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'no_hp',
        'email',
        'table_id',
        'tanggal_reservasi',
        'kapasitas',
    ];

    protected $dates = [
        'tanggal_reservasi'
        
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

}
