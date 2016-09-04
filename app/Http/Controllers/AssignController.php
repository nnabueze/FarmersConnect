<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Farmer;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class AssignController extends Controller
{
    //
    public function __construct()
    {

        $this->middleware('auth');

    }
    //
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
    	$title = "Farmers Connect: Farmers Page";
        return view('farmer.assign',compact('title'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return Datatables::of(Farmer::query())->addColumn('action', function ($id) {
            return '<input type="checkbox" name="box[]" value="'.$id->id.'" id="remember_me_'.$id->id.'">
                                        <label for="remember_me_'.$id->id.'"></label>'; 
        })->make(true);
    }
}
