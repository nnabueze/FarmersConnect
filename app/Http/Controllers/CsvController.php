<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Farmer;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CsvController extends Controller
{
    //
    //Upload via CSV
    public function csv()
    {
    	$title = "Farmers Connect: Uplaod Farmer CSV Page";
        return view('farmer.upload',compact('title'));
    }

    //upload csv to database
    public function upload(Request $request)
    {
    	$title = "Farmers Connect: Uplaod Farmer CSV Page";
    	try {
    	    Excel::load($request->file('file'), function ($reader) {

    	        $reader->each(function($sheet) {    
    	            foreach ($sheet->toArray() as $row) {
    	               Farmer::firstOrCreate($row);
    	            }
    	        });
    	    });
    	    \Session::flash('message', 'Users uploaded successfully.');
    	    return redirect(route('csv'));
    	} catch (\Exception $e) {
    	    \Session::flash('error', $e->getMessage());
    	    return redirect(route('csv'));
    	}
    }
}
