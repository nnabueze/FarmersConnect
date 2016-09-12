<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;
use Session;
use Redirect;
use App\Scheme;
use App\User;
use App\Dealer;
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
/*        echo "<pre>";
        print_r($request->all());
        die;*/
        //select scheme
        $scheme = Scheme::where('id',$request->input('scheme'))->first();
        if (count($request->input('box')) < 1) {
            Session::flash('warning','Failed! Select farmers to assign');
            return Redirect::back();
        }
        if ($scheme) {
            # code...
            //attach farmer
            $scheme->farmers()->attach($request->input('box'));
            $scheme->save();

            Session::flash('message','Successful! You have assaigned farmers to scheme');
            return Redirect::back();
        }
        Session::flash('warning','Failed! Unable to assaign farmers to scheme');
        return Redirect::back();
    }    

    //assigning workers
    public function assignWorker(Request $request)
    {
/*        echo "<pre>";
        print_r(count($request->input('box')));
        die;*/
        $scheme = Scheme::where('id',$request->input('scheme'))->first();
        if (count($request->input('box')) < 1) {

            Session::flash('warning','Failed! Select workers to assign');
            return Redirect::back();
        }
        if ($scheme) {
            # code...
            //attach farmer
            $scheme->workers()->attach($request->input('box'));
            $scheme->save();

            Session::flash('message','Successful! You have assaigned workers to scheme');
            return Redirect::back();
        }
        Session::flash('warning','Failed! Unable to assaign workers to scheme');
        return Redirect::back();
    }
    //assign dealer
    public function assignDealer(Request $request)
    {
 /*       echo "<pre>";
        print_r($request->all());
        die;*/
        $scheme = Scheme::where('id',$request->input('scheme'))->with('activities')->first();
      
        if (count($request->input('box')) < 1) {

            Session::flash('warning','Failed! Select workers to assign');
            return Redirect::back();
        }
        if ($scheme) {
            //check if activity is in line with scheme activity
            $checkActivity = $this->checkActivity($scheme, $request);
            if ( ! $checkActivity) {
                Session::flash('warning','Failed! Activity selected is not assigned to scheme');
                return Redirect::back();
            }

            //attach activity to dealer
            $this->attachActivity($request);

            //attach dealer
            $scheme->dealers()->attach($request->input('box'));
            $scheme->save();

            Session::flash('message','Successful! You have assaigned dealers to scheme');
            return Redirect::back();
        }
        Session::flash('warning','Failed! Unable to assaign dealers to scheme');
        return Redirect::back();

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

    //checking if activity is equal to scheme activity
    private function checkActivity($scheme, $request)
    {
        $scheme_activity = array();
        $activities = $scheme->activities->toArray();

        foreach ($activities as $value) {

            //$scheme_activity[] = $value['id'];
            array_push($scheme_activity, $value['id']);
        }

        foreach($request->input('activity') as $check){

            if (in_array($check, $scheme_activity)) {
               return true;
            }
        }
    return false;
    }

    //attaching activity to each dealer
    private function attachActivity($request)
    {
/*        echo "<pre>";
        print_r($request->input('box'));
        die;*/
        foreach ($request->input('box') as $value) {
          $dealer = Dealer::find($value);
          $dealer->activities()->attach($request->input('activity'));
          $dealer->save();
        }
    }
}
