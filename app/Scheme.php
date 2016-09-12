<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{
    //
    protected $fillable=[
    'key',
    'name_of_scheme',
    'facilitator_of_scheme',
    'discription_of_scheme',
    'logo',
    'facilitator_name',
    'address',
    'bvn',
    'tin',
    'nature_of_bussiness',
    'email',
    'phone',
    'objective_of_scheme',
    'partners_of_scheme',
    'image'
    ];

//many to many relationship with activity
    public function activities(){
        return $this->belongsToMany('App\Activity');
    }

//many to many relationship with farmer
    public function farmers(){
        return $this->belongsToMany('App\Farmer');
    }
}
