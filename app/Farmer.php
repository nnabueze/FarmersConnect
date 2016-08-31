<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    //
    protected $fillable=[
    'key',
    'fullname',
    'gender',
    'email',
    'phone',
    'state',
    'lga',
    'village',
    'farm_size',
    'no_of_pack',
    'used_before',
    'bank',
    'account_no'
    ];
}
