<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
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

    //Testing user login via postman
    public function user(Request $request)
    {
    	$credentials = $request->only('email', 'password');

    	return $this->response->created();
    }

    //creating user token
    public function authentication(Request $request)
    {
    	$credentials = $request->only('email', 'password');

    	try{
    		if (! $token = JWTAuth::attempt($credentials)) {
    			return $this->response->errorUnauthorized();
    		}

    	} catch (JWTException $e) {
    		return $this->response->errorInternal();
    	}

    	return $this->response->array(compact('token'))->setStatusCode(200);
    }
}
