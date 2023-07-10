<?php

namespace App\Enums;

enum TableStatus: string
{
    case Tertunda = 'tertunda';
    case Tersedia = 'tersedia';
    case Tidak_Tersedia = 'tidak_tersedia';

}