<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $fillable = ['name', 'key'];

    public function schemes(){
        return $this->belongsToMany('App\Scheme');
    }
}
