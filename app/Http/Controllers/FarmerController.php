<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Redirect;
use App\Farmer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FarmerController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "Farmers Connect: Farmers Page";
        return view('farmer.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Farmers Connect: Farmers Page";
        return view('farmer.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           echo "uploading image";
        die;
        
        $title ="Farmers Connect: profile page";
        //check if email exist
        $check = Farmer::where('email',$request->input('email'))->first();

        if ($check) {
           Session::flash('warning','Failed! Email already exist.');
           return Redirect::back();
        }
        //generate a random number
        $request['key'] = str_random(20);
        //insartinto db
        $farmer = Farmer::create($request->all());
        if ($farmer) {
         Session::flash('message','Successful! You have created a farmer.');
         return view('farmer.card', compact('title','farmer'));  
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
        $title = 'Farmers Connect: Farmer Details';
        $farmer = Farmer::where('id',$id)->first();
        //dd($farmer);
        return view('farmer.show',compact('title','farmer'));
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
        echo "edit method";
        die;
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
        echo "update method";
        die;
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
        echo "delete method";
        die;
    }
}
