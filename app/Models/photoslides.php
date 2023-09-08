<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class photoslides extends Model
{
    protected $fillable = ['heading', 'order', 'list_background'];
    use HasFactory;
}
