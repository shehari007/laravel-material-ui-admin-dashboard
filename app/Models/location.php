<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    protected $fillable = ['location', 'order', 'address', 'telephone', 'gsm', 'email', 'google_map_link'];
    use HasFactory;
}
