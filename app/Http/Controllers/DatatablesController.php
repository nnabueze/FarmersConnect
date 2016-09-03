<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Farmer;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    //
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
    	$title = "Farmers Connect: Farmers Page";
        return view('farmer.index',compact('title'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return Datatables::of(Farmer::query())->addColumn('action', function ($id) {
            return '<a href="farmers/' . $id->id . '/edit" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span></a>
            <button class="btn-delete btn btn-default" data-remote="/farmers/' . $id->id . '"><span class="glyphicon glyphicon-remove"></span></button>'; 
        })->make(true);
    }
}
