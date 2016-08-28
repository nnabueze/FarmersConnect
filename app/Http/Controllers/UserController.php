<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\User;
use Redirect;
use Session;
use Hash;
use Bican\Roles\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all();
        $users = User::with('roles')->paginate(3);
        $title = 'Fermers Connect: Users Page';
        return view('user.index', compact('title','roles','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        $user = User::where('email',$request->input('email'))->first();
        if ($user) {
            Session::flash('warning', 'Failed! Email already exist');
            return Redirect::back();
        }
        if (empty($request->input('role'))) {
           Session::flash('warning', 'Failed! select a role');
           return Redirect::back();
        }
        $request['password'] = Hash::make($request->input('password'));
      $user = User::create($request->all());
      $user->attachRole($request->input('role'));

      Session::flash('message', 'Success! Acount have been created');
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
        $title = 'Fermers Connect: Users Page';
        $roles = Role::all();
        $users = User::with('roles')->paginate(3);
        $user1 = User::where('id',$id)->with('roles')->first();
        //dd($user1);
        return view('user.show',compact('title','user1','users','roles'));

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
        echo "updating user";
        die;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //
        $user = User::find($id);
        if ($user->update($request->all())) {
            $user->roles->sync($request->input('role'));
            Session::flash('message', 'Success! Account have been updated');
            return Redirect::to('/users');
        }else{
           Session::flash('warning', 'Failed! User not updated');
           return Redirect::to('/users'); 
        }
       /* echo"<pre>";
        print_r($request->all());
        echo"</pre>";*/
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
    $user = User::where('id',$id)->with('roles')->first();
/*    foreach($user->roles as $role){
        if ($role['name'] == 'Super Admin') {
           Session::flash('warning', 'Failed! Unable to delete a User');
           return Redirect::back();
        }
    }*/
    $user->delete();
    Session::flash('message', 'Success! You have deleted a User');
    return Redirect::back();
    }
}
