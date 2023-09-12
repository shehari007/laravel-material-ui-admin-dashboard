<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogue extends Model
{
    protected $fillable=['heading', 'order', 'src'];
    use HasFactory;
}
