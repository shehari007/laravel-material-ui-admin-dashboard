<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class generalSettings extends Model
{
    protected $fillable = [
        // Other fields that are fillable
        'smtp_server',
        'smtp_port',
        'smtp_protocol',
        'smtp_email',
        'smtp_psw',
        'siteinfo_title',
        'siteinfo_description',
        'siteinfo_keywords',
        'siteinfo_fb',
        'siteinfo_twitter',
        'siteinfo_insta',
        'siteinfo_google',
        'siteinfo_googlemap',
        'siteinfo_telephone',
        'siteinfo_fax',
        'siteinfo_sl1',
        'siteinfo_sl2',
        'siteinfo_email',
        'siteinfo_address',
        'siteinfo_ac',
        'siteset_picsrc',
        'siteset_deflang',
        'siteset_sef',
        'siteset_homesl',
        'siteset_homesrv',
        'siteset_homefeat',
        'siteset_home3block',
        'siteset_homeref',
        'siteset_theme1',
        'siteset_theme2',

    ];
    use HasFactory;
}
