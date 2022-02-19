<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BantuanHukum extends Model
{
    use HasFactory;
    protected $table = "bantuan_hukum";
    protected $fillable = ['nama', 'judul', 'slug', 'sub_judul', 'deskripsi', 'image'];


    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}