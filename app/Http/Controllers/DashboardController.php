<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;
use Session;
use Redirect;
use App\Http\Requests;

class DashboardController extends Controller
{
	public function __construct()
	{

		$this->middleware('auth', ['except' => [
		     'logout'
		 ]]);

	}
    //Display dashboard information

    public function index()
    {
        $title = "Farmers Connect: Dashboard Page";
    	return view('dashboard.index', compact('title'));
    }

    //create an admin test user
    public function user(Request $request)
    {
    	$request['password'] = Hash::make($request['password']);
    	$register = User::create($request->all());
    	Session::flash('message', 'You have sucessfully created an account. Please login to continue');
    	return Redirect::back();
    }

    //assigning farmer to scheme
    public function assign(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        die;
    }

    //logout from the system
    public function logout()
    {
    	if (Auth::check()) {
    	    Auth::logout();
    	    return redirect('/admin');
    	} else {
    	    return redirect('/admin');
    	}
    }
}
