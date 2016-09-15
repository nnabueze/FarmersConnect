<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Input;
use Redirect;
use Image;
use App\Crop;
use App\Farmer;
use App\Http\Requests;
use App\Http\Requests\FarmersRequest;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class FarmerController extends Controller
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
        $title = "Farmers Connect: Farmers Page";
        return view('farmer.index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Farmers Connect: Farmers Page";
        $crops = Crop::all();
        return view('farmer.create',compact('title','crops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FarmersRequest $request)
    {
        //dd($request->input('crop'));
            
        if ( ! $request->hasFile('file')) {
            //
            Session::flash('warning','Failed! please upload picture');
            return Redirect::back();
        }

        //check if email exist
        $phoneCheck = $this->phoneCheck($request);
        if ($phoneCheck) {
            Session::flash('warning','Failed! Farmer already exist');
            return Redirect::back();
        }

        //uploading image
        $request['image'] = $this->image($request);
       
        $title ="Farmers Connect: profile page";
        //generate a random number
        $request['key'] = str_random(20);
        //insartinto db
        $farmer = Farmer::create($request->all());
        //attaching crop to farmer
        if ($farmer) {
         /*$farmer->crops()->attach($request->input('crop'));
         $farmer->save();*/
         Session::flash('message','Successful! You have created a farmer.');
         return view('farmer.card', compact('title','farmer'));  
        }
        Session::flash('warning','Failed! Unable to created a farmer.');
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
        $title = 'Farmers Connect: Farmer Details';
        $farmer = Farmer::where('key',$id)->first();
        //dd($farmer);
        if ($farmer) {
            return view('farmer.show',compact('title','farmer'));
        }
        Session::flash('warning','Error! 404 Error.');
        return Redirect::back();
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
        echo "edit method";
        die;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        echo "update method";
        die;
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
         $farmer = Farmer::where('id',$id)->first();
         if ($farmer) {
             File::delete(public_path().'/uploads/farmers/'.$farmer->image);
             $farmer->delete($id);

             Session::flash('message','Successful! You have deleted a Farmer');
             return Redirect::to('/datatables');
         }
         Session::flash('warning','Failed! Unable to delete Dealer');
         return Redirect::back();
    }

    //uploading image
    public function image($request)
    {
        $image = $request->file('file');
        $imgName = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/farmers');
        $img = Image::make($image->getRealPath())->resize(150, 200)->save($destinationPath.'/'.$imgName);

        return $imgName;
    }

    //checking email
    public function phoneCheck($request)
    {
        $phone = Farmer::where('phone',$request->input('phone'))->orWhere('fullname', $request->input('fullname'))->first();
        if ($phone) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
