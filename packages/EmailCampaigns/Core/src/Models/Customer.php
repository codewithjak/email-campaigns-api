<?php

namespace EmailCampaigns\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers'; // matches the table from SQL file

    protected $fillable = [
        'name', 'email', 'status', 'plan_expiry_date'
    ];

    protected $dates = ['plan_expiry_date'];
}
