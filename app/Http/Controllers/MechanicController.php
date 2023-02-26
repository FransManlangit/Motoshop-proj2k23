<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Mechanic;
use App\Models\User;
use Redirect;
use App\Events\SendMail;
use Event;
use Auth;
use App\DataTables\MechanicDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Facades\DataTables;

class MechanicController extends Controller
{
    /**
     * Display a listing of the resource.
     */


       public function __construct(){
        $this->total = 0;
    }

    public function index(Request $request)
    {
         $mechanics = Mechanic::all();
        return view('mechanic.index', compact('mechanics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return view('mechanic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mechanics = Mechanic::where('user_id',Auth::id())->find($id);
        return view('mechanic.edit', compact('mechanics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $mechanics = Mechanic::find($id);

        // $input = $request->all();

        $request->validate([
             'fname' => 'required|max:255',
             'lname' => 'required|max:255',
             'address' => 'required|max:255',
             'town' => 'required|max:255',
             'city' => 'required|max:255',
             'phone' => 'required|max:255',
             'mechanic_img' => 'mimes:png,jpeg,gif,svg',
        ]);

         $mechanics->fname = $request->fname;
         $mechanics->lname = $request->lname;
         $mechanics->address = $request->address;
         $mechanics->town = $request->town;
         $mechanics->city = $request->city;
         $mechanics->phone = $request->phone;

         if($file = $request->hasFile('mechanic_img')) {
        $file = $request->file('mechanic_img') ;
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path().'/img_path' ;
        $input['mechanic_img'] = 'img_path/'.$fileName;
        $file->move($destinationPath,$fileName);
        $mechanics->mechanic_img = $fileName; 
            
            }

         $mechanics->update();
         return redirect()->route('user.mprofile')->with('Record Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $mechanics = Mechanic::find($id);
        
        $Id=$mechanics->user_id;
        $mechanics->delete();
        $users = User::find($Id);
        $users->delete();
        
        return Redirect::to('/mechanics');
    }


      public function getMechanic(MechanicDataTable $dataTable){

        $mechanics = Mechanic::with([])->get();
        return $dataTable->render('mechanic.mechanics');

    }
}
