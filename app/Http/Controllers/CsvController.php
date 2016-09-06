<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Farmer;
use App\Crop;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CsvController extends Controller
{
    
    public function __construct()
    {

        $this->middleware('auth');

    }
    
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

    //adding crops
    public function crop()
    {
        $title = "Farmers Connect: Adding Crop Page";
        $crops = Crop::all();
        return view('farmer.crop',compact('title','crops'));
    }

    //add crop to database
    public function addCrop(Request $request)
    {
        $crop = Crop::create($request->all());
        Session::flash('message','Success! Crop have been add');
        return Redirect::back();
    }

    //deleting crop
    public function deleteCrop($id)
    {
        $crop = Crop::where('id',$id)->first();
        if ($crop->delete()) {
            Session::flash('message','Success! Crop deleted!!');
            return Redirect::back();
        }
        Session::flash('warning','Failed! unable to delete crop');
        return Redirect::back();
    }
}
