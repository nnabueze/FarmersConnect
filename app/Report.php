<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable=[
    'key',
    'key_farmer',
    'key_worker',
    'key_dealer',
    'key_scheme',
    'activity',
    'quantity',
    'amount'
    ];
}
