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

    //Farmers verification
    public function farmer_verification()
    {
    	$user = JWTAuth::parseToken()->authenticate();
    	try{
    		if (! $user ) {
    			return $this->response->errorUnauthorized();
    		} 
    	} catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
    			return $this->response->error('something went wrong');
    	}

    	//$id = $request->only('id');
    	//$id = $request->only('id');
    	return User::all();
    }
}
