<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Dingo\Api\Routing\Helpers;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
	use Helpers;
    //testing api
    public function index()
    {
    	return user::all();
    }

    //login user
    public function user(Request $request)
    {
    	$credentials = $request->only('email', 'password');

    	return $this->response->created();
    }
}
