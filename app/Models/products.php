<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = ['heading', 'feat_prod', 'category', 'url', 'list_img', 'list_background', 'description', 'seo_title', 'seo_keywords', 'seo_description'];
    use HasFactory;
}
