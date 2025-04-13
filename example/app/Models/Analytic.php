<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    protected $fillable = [
        'seed_input',
        'seed_response',
        'facebook_visitor',
        'instagram_visitor',
        'snapshort_visitor',
        'session_adjustment',
        'engagement_adjustment',
        'iphone_adjustment',
        'android_adjustment',
        'pc_adjustment',
    ];
}
