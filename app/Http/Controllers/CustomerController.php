<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Customer;
use App\Models\User;
use Redirect;
use App\Events\SendMail;
use Event;
use Auth;
use App\DataTables\CustomerDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
  
      public function __construct(){
        $this->total = 0;
    }

    public function index(Request $request)
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
        
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
         $customers = Customer::where('user_id',Auth::id())->find($id);
        return view('customer.edit', compact('customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
         $customer = Customer::find($id);

        // $input = $request->all();

        $request->validate([
             'fname' => 'required|max:255',
             'lname' => 'required|max:255',
             'address' => 'required|max:255',
             'town' => 'required|max:255',
             'city' => 'required|max:255',
             'phone' => 'required|max:255',
             'cust_img' => 'mimes:png,jpeg,gif,svg',
        ]);

         $customer->fname = $request->fname;
         $customer->lname = $request->lname;
         $customer->address = $request->address;
         $customer->town = $request->town;
         $customer->city = $request->city;
         $customer->phone = $request->phone;

         if($file = $request->hasFile('cust_img')) {
        $file = $request->file('cust_img') ;
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path().'/img_path' ;
        $input['cust_img'] = 'img_path/'.$fileName;
        $file->move($destinationPath,$fileName);
        $customer->cust_img = $fileName; 
            
            }

         $customer->update();
         return redirect()->route('user.profile')->with('Record Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       
        $customers = Customer::find($id);
        // $customers->user_id;
        $Id=$customers->user_id;
        $customers->delete();
        $users = User::find($Id);
        $users->delete();
        

        return Redirect::to('/customers');
    }


      public function getCustomer(CustomerDataTable $dataTable){

        $customers = Customer::with([])->get();
        return $dataTable->render('customer.customers');

    }
}
