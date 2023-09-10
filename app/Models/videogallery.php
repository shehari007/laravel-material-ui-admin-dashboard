<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class videogallery extends Model
{
    protected $fillable = ['heading', 'order', 'vlink'];
    use HasFactory;
}
