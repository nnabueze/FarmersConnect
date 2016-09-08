<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Hash;
use Redirect;
use Session;
use App\User;
use App\Worker;
use App\Http\Requests;
use Bican\Roles\Models\Role;
use App\Http\Controllers\Controller;

class WorkerController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth', ['except' => [
             'create','store'
         ]]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('worker.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        //check if email
        $check_worker = Worker::where('email',$request->input('email'))->first();
        if ($check_worker) {
            Session::flash('warning','Failed! Email already exist.');
            return Redirect::back();
        }
        //generate key
        $request['key'] = str_random(20);
        //insert into workers table
        $worker = Worker::create($request->all());
/*        print_r($request->all());
        die;*/
        if ( ! $worker) {
          Session::flash('warning','Failed! Unable to create user');
          return Redirect::back();
        }
        //generate password
        $password = str_random(6);
        $password_hash = Hash::make($password);
        $token = Hash::make($password.$request->input('email'));
        //insert into user table
        $user = $this->insertUser($request, $password_hash);
        
        if ($user) {
            //send email
            $this->sendMail($worker, $password, $token);
            Session::flash('message','Successful! Please check your email to activate your account.');
            return Redirect::back();
        }
        Session::flash('warning','Failed! Unable to register on the platform.');
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //inserting into user table
    private function insertUser($request, $password_hash)
    {
        //check if email exist
        $check_user = User::where('email',$request->input('email'))->first();
        if ($check_user) {
            return false;
        }
        
        //create email
        $user = User::create([
            'name' => $request->input('first_name'),
            'email'=> $request->input('email'),
            'password' => $password_hash
            ]);
    //attaching role to user
        if ($user) {
            $role = Role::where('slug','worker')->first();
            $user->attachRole($role->id);

            return true;
        }
        return false;
    }

    //send email to worker
    private function sendMail($register, $password, $token) {
        Mail::send('email.success', ['user' => $register, 'password'=>$password, 'token'=>$token], function ($m) use ($register) {
            $m->from('oparannabueze@gmail.com', 'Farmers Connect Registration');
            $m->to($register->email, $register->first_name)->subject('Farmers Connect Registration Successful!');
        });
    }
}
