<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use JWTAuth;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Routing\Helpers;
use App\User;
use App\Farmer;
use App\Worker;
use App\Scheme;
use App\Dealer;
use App\Report;
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

    // GET Farmers verification
    public function farmer_verification(Request $request)
    {
        //Token authentication
        $this->token_auth();
        //validating Farmers identification
    	$validator = Validator::make($request->only('id'),['id'=>'alpha_num|max:20|min:20']);
        //checking if validation failed
        if ($validator->fails()) {
            return $this->response->errorBadRequest();
        }
        $identification = $request->only('id');
        $farmer = Farmer::where('key',$identification)->first();
        if ( ! $farmer) {
            return $this->response->errorNotFound();
        }
        return $this->response->array(compact('farmer'))->setStatusCode(200);
    }

    // POST Api to login workers
    public function login_worker(Request $request)
    {
        //Token authentication
        $this->token_auth();
        $validator = Validator::make($request->only('email','password'),['email'=>'email']);

        //checking if validation failed
        if ($validator->fails()) {
            return $this->response->errorBadRequest();
        }

        //check if worker is able to login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            //getting login worker details via email
            $worker = Worker::where('email', Auth::user()->email)->with('scheme')->first();
            //return $worker;
            //check if worker is found
            if (!$worker) {
                return $this->response->errorNotFound();
            }

            //check if worker is assigned
            if( $worker->assign != 1){
                return $this->response->error('Not assigned',404);
            }
            //return worker details
            return $this->response->array(compact('worker'))->setStatusCode(200);
        }

        return $this->response->error('Unable to login',404);
    }

    //GET scheme Verification
    public function scheme_verification(Request $request)
    {
        //Token authentication
        $this->token_auth();
        $validator = Validator::make($request->only('id'),['id'=>'alpha_num|max:20|min:20']);
        //checking if validation failed
        if ($validator->fails()) {
            return $this->response->errorBadRequest();
        }
        $identification = $request->only('id');
        $scheme = Scheme::where('key',$identification)->with('dealers','activities')->first();
        if (!$scheme) {
            return $this->response->errorNotFound();
        }

        return $this->response->array(compact('scheme'))->setStatusCode(200);
    }

    //GET Dealer Verification
    public function dealer_verification(Request $request)
    {
        //Token authentication
        $this->token_auth();
        $validator = Validator::make($request->only('id'),['id'=>'alpha_num|max:20|min:20']);
        //checking if validation failed
        if ($validator->fails()) {
            return $this->response->errorBadRequest();
        }

        $dealer = Dealer::where('key',$request->only('id'))->with('activities')->first();
        if (!$dealer) {
            return $this->response->errorNotFound();
        }

        return $this->response->array(compact('dealer'))->setStatusCode(200);
    }

    //POST Rport API
    public function report(Request $request)
    {
        //Token authentication
        $this->token_auth();
        $validator = Validator::make($request->all(),[
            'key_farmer'=>'alpha_num|max:20|min:20|required',
            'key_worker'=>'alpha_num|max:20|min:20|required',
            'key_dealer'=>'alpha_num|max:20|min:20|required',
            'key_scheme'=>'alpha_num|max:20|min:20|required',
            'activity'=>'required',
            'quantity'=>'numeric|required',
            'amount'=>'numeric|required'
            ]);
        //checking if validation failed
        if ($validator->fails()) {
            return $this->response->errorBadRequest();
        }
         

        //check if report key exist
        if ($key = Report::where('key',$request['key'])->first()) {
            return $this->response->error('report exist',400);
        }

        //inserting a report
        if (Report::create($request->all())) {
            return $this->response->created();
        }
        return $this->response->error('something went wrong',400);
    }

    //token Authentication
    private function token_auth()
    {
            //Token authentication
            $user = JWTAuth::parseToken()->authenticate();
            try{
                if (! $user ) {
                    return $this->response->errorUnauthorized();
                } 
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                    return $this->response->error('something went wrong');
            }

    }
}
