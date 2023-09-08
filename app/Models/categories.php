<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $fillable = ['heading', 'order', 'url', 'list_img', 'list_background', 'description', 'seo_title', 'seo_keywords', 'seo_description'];
    use HasFactory;
}
