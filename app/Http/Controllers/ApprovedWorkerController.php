<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Worker;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class ApprovedWorkerController extends Controller
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
    	$title = "Farmers Connect: Workers Page";
        return view('worker.approved',compact('title'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
    	$worker = Worker::with('scheme')->where('status','active')->where('assign',1)->get();

        return Datatables::of($worker)->addColumn('action', function ($id) {
            return '<a href="worker/' . $id->id . '" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span></a>
            <button class="btn-delete btn btn-default" data-remote="/worker/' . $id->id . '"><span class="glyphicon glyphicon-remove"></span></button>'; 
        })->make(true);
    }
}
