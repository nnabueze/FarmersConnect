<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    //
    protected $fillable=[
    'key',
    'name_of_company',
    'company_email',
    'company_phone',
    'address',
    'website',
    'contact_person',
    'person_phone',
    'person_email',
    'agricultural_expertise',
    'years_in_business',
    'similar_project',
    'references',
    'company_tin',
    'bvn',
    'account_number',
    'account_name',
    'token'
    ];
}
