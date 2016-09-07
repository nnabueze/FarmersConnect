<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Farmer;
use App\Crop;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

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

                    // Loop through all rows
                    $sheet->each(function($row) {
                        $row = $row->toArray();
                        $row['key'] = str_random(20);
                        $farmer = Farmer::create($row);
                        $crop = Crop::where('crop',$row['crop'])->first();
                        $farmer->crops()->attach($crop->id);
                        $farmer->save();
                    });

                });

    	    });
    	    Session::flash('message', 'Users uploaded successfully.');
    	    return Redirect::to('csv');
    	} catch (\Exception $e) {
    	    Session::flash('warning', $e->getMessage());
    	    return Redirect::to('csv');
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
