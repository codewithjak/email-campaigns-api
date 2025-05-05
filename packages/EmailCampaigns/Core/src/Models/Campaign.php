<?php

namespace EmailCampaigns\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns';

    protected $fillable = [
        'name',
        'subject',
        'body',
        'status',
        'scheduled_at'
    ];

    protected $dates = ['scheduled_at'];
}
