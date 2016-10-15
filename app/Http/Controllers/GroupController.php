<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Group;
use Validator;
use Redirect;
use App\Scheme;
use Session;
use App\Http\Requests\GroupRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GroupController extends Controller
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
        $groups = Group::with('schemes','farmers')->get();
        $schemes = Scheme::all();
        $title = "Farmers Connect: Group Farmers Page";
        return view('group.index',compact('groups','title','schemes'));
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
    public function store(GroupRequest $request)
    {
        //check if scheme is selected
        if (empty($request->input('scheme'))) {
            Session::flash('warning','Failed! Please select Scheme');
            return Redirect::back();
        }

        //check if group exist in scheme
        if ($groupName = Group::where('group_name',$request->input('group_name'))->first()) {
           Session::flash('warning','Failed! group exist');
            return Redirect::back();
        }
        $request['key'] = str_random(20);
        if (!$group = Group::create($request->all())) {

            Session::flash('warning','Failed! Unable to create group');
            return Redirect::back();
        }
        //attaching to group to scheme
        $group->schemes()->attach($request->input('scheme'));
        $group->save();
        Session::flash('message','Successful! Group Created');
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
        echo "showing group";
        die;
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
        $group = Group::where('key',$id)->first();
       if (!$group) {
           Session::flash('warning','Failed! Group not found');
           return Redirect::back();
       }
       $groups = Group::all();
       $title = "Farmers Connect: Group Farmers Page";
       return view('group.edit',compact('group','groups','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, $id)
    {
        //
        if (!$group = Group::where('key',$id)->first()) {
           Session::flash('warning','Failed! Group not found');
           return Redirect::back();
        }
        $group->update($request->all());
        Session::flash('Message','Successful! Group updated');
        return Redirect::to('/group');
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
        $group = Group::where('key',$id)->first();
        if ($group->delete()) {
            Session::flash('message','Successful! Group deleted');
            return Redirect::to('/group');
        }
        Session::flash('warning','Failed! Unable to delete Group');
        return Redirect::to('/group');
    }
}
