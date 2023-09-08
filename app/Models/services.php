<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    protected $fillable = ['heading', 'short_desc', 'out_link', 'icon_type', 'show_home', 'url', 'list_background', 'description', 'seo_title', 'seo_keywords', 'seo_description'];
    use HasFactory;
}
