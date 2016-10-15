<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Farmer;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class ApprovedFarmerController extends Controller
{
    //
    //
    public function __construct()
    {

        $this->middleware('auth');

    }

    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        //$schemes = Scheme::all();
    	$title = "Farmers Connect: Farmers Page";
        return view('farmer.approved',compact('title'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
    	$farmers = Farmer::with('schemes')->where('assign',1)->get();

        return Datatables::of($farmers)->addColumn('action', function ($id) {
            return '<a href="farmers/' . $id->id . '" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
            <button class="btn btn-warning btn-sm" data-remote="/farmers/' . $id->id . '">unassign</button>'; 
        })->make(true);
    }
}
