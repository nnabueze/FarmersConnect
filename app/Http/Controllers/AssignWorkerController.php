<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Scheme;
use App\Worker;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class AssignWorkerController extends Controller
{
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
        $schemes = Scheme::all();
    	$title = "Farmers Connect: Workers Page";
        return view('worker.assign',compact('title','schemes'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return Datatables::of(Worker::where('status','active')->where('assign',0)->get())->addColumn('action', function ($id) {
            return '<input type="checkbox" name="box[]" value="'.$id->id.'" id="remember_me_'.$id->id.'">
                                        <label for="remember_me_'.$id->id.'"></label>'; 
        })->make(true);
    }
}
