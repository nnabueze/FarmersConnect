<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Dealer;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class ApprovedDealerController extends Controller
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
   	$title = "Farmers Connect: Dealers Page";
       return view('dealer.approved',compact('title'));
   }

   /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */
   public function anyData()
   {
   		$worker = Dealer::with('schemes')->where('status','active')->where('assign',1)->get();

       return Datatables::of($worker)->addColumn('action', function ($id) {
           return '<a href="dealer/' . $id->key . '" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span></a>
           <button class="btn-delete btn btn-default" data-remote="/dealer/' . $id->key . '"><span class="glyphicon glyphicon-remove"></span></button>'; 
       })->make(true);
   }
}
