<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reference extends Model
{
    protected $fillable =['src'];
    use HasFactory;
}
