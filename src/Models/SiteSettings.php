<?php

namespace Intelrx\Sitesettings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    use HasFactory;
    protected $table = 'site_settings';
    protected $fillable = ['key', 'value'];
}
