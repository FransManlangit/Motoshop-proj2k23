<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MotorcycleController extends Controller
{
    //

    public function create()
    {
        $customers = Customer::select("id", DB::raw("CONCAT(fname, ' ' , lname) AS name"))->pluck('name','id');
        return View::make('motorcycle.create',compact('customers'));
    }

    public function store(Request $request)
    {
       $input = $request->all();

       // $request->validate([
       //     'imagePath' => 'mimes:jpeg,png,jpg,gif,svg'
       // ]);

       if($file = $request->hasFile('image')) {
           
           $file = $request->file('image') ;
           $fileName = $file->getClientOriginalName();
           // dd($fileName);
           $request->image->storeAs('images', $fileName, 'public');
           $input['motorcycle_img'] = 'images/'.$fileName;
           $motorcycle = motorcycle::create($input);
       }

       if (Auth::user()->role == 'customer'){
           // dd($motorcycle);
           return redirect::to('profile')->with('success','motorcycle Created Successfully!');
       }  else {
          return \Redirect::to('/motorcycle')->with('success','motorcycle Created Successfully!');
       }
   }


   

    
}
