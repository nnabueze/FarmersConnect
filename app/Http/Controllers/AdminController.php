<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;
use Redirect;
use App\User;
use Session;
use App\Http\Requests;

class AdminController extends Controller
{
    public function __construct()
    {

        //$this->middleware('guest');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::check()) {
            return Redirect::to('admin/dashboard');
        }else{
            $title = "Farmers Connect: Admin Page";
            return view('admin.index', compact('title'));
        }
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
    public function store(Request $request)
    {
        //
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
/*            print_r(Auth::user()->Roles[0]['name']);
            die;*/
            if (Auth::user()->status ==='pending' ) {
                Session::flash('warning', 'Account not activated');           
                return Redirect::to('admin/logout');
            }
            if (Auth::user()->level() < 3) {
                Session::flash('warning', 'Account not activated');           
                return Redirect::to('admin/logout');
            }
            return redirect()->intended('admin/dashboard');
        } else {
            Session::flash('warning', 'Invalid login credentials');           
            return Redirect::back();
        }
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
}
