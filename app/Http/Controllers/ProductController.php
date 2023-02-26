<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use View;   
use Redirect;
use Auth;
use Storage;
use File;
use App\Models\Order;
use App\Cart;
use App\DataTables\ProductDataTable;
use App\DataTables\OrdersDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::all();
        // return view('product.index', compact('products'));
        $products= product::get();
        $products = product::orderBy('id')->paginate(6);
        // dd($products);
        return view('shop.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //  return view('product.create');
        $products = product::pluck('description','id');
        return View::make('product.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $input = $request->validate([

            'description' => 'required|max:255',
            'sell_price' => 'required|min:2',
            'product_img' => 'mimes:png,jpg,gif,svg',
        ]);

        if($file = $request->hasFile('product_img')) {
            $file = $request->file('product_img') ;
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/img_path' ;
            $input['product_img'] = 'img_path/'.$fileName;

            $products = Product::create($input);
            $file->move($destinationPath,$fileName);
           }

         return redirect()->route('getProduct')->with('Success!', 'New Product has been Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('product.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $products, $id)
    {
         $products = Product::find($id);

        $input = $request->all();

         $request->validate([

            'description' => 'required|max:255',
            'sell_price' => 'required|min:2',
            'product_img' => 'mimes:png,jpg,gif,svg',
            
        ]);

        if($file = $request->hasFile('product_img')) {
            $file = $request->file('product_img');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/img_path' ;
            $input['product_img'] = 'img_path/'.$fileName;
            $file->move($destinationPath, $fileName);
        }

            $products->description = $request->description;
            $products->sell_price = $request->sell_price;
            $products->product_img = $request->$fileName;

            $products->update($input);
            return redirect()->route('getProduct')->with('Success', 'Product Record Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect()->route('products.index')->with('Product Successfully Removed');
    }

     public function getProduct(ProductDataTable $dataTable){


        $products = Product::with([])->get();
        return $dataTable->render('product.products');   
    }
    public function getproducts(ProductsDataTable $dataTable) {
        $products =  product::get();
        // dd($products);
        return $dataTable->render('product.index');
    }

//////////////////////////////////

public function getAddToCart(Request $request , $id){
    $products = product::find($id);
    $oldCart = Session::has('cart') ? $request->session()->get('cart'):null;
    $cart = new Cart($oldCart);
    $cart->add($products, $products>id);
    $request->session()->put('cart', $cart);
    Session::put('cart', $cart);
    $request->session()->save();

    return redirect()->back()->with('info', 'Service has been added successfully!');
}

public function getCart() { 
    // $pets = Pet::select("id", "name")->pluck('name','id');

    if (!Session::has('cart')) {
        return view('shop.shopping-cart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    return view('shop.shopping-cart', ['products' => $cart->products, 'totalPrice' => $cart->totalPrice]);
}

public function getSession(){
    Session::flush();
   }


   public function postCheckout(Request $request){

    if(Auth::check()) {

    if (!Session::has('cart')) {
        return redirect()->route('product.shoppingCart');
    }

    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    // dd($cart);
    try {
        DB::beginTransaction();
        $order = new Order();
        $customer =  (Auth::user()->customers->id);
        $order->customer_id = $customer;
        $order->status = 'Ongoing';
        $order->save();

        foreach($cart->products as $products){
        $id = $products['product']['id'];
        $order->products()->attach($id);
        }
    
    $orders = product::join('orderline', 'orderline.product_id', '=', 'products.id')
    ->join('orderinfo','orderinfo.id','=','orderline.orderinfo_id')
    ->join('customers','customers.id','=','orderinfo.customer_id')
    ->select('products.id', 'products.price', 'products.description')
    ->where('orderinfo.id', '=', $order->id)
    ->get();
    
    $data = [
        'title' => 'Receipt for AcmeClinic',
        'date' => now(),
        'total' => $cart->totalPrice,
        'name' => (Auth::user()->customers->fname).' '.(Auth::user()->customers->lname)
     ];

    // $receipt = 'receipt-'.now()->format('M-d-Y_h-i-s').'.pdf';
    // dd($receipt);

    $pdf = PDF::loadView('receipt', $data, compact('orders'));

    // $pdf = PDF::loadView('receipt', $data, compact('orders'))->setWarnings(false)->save('C:/Users/ItzReigne/Downloads'.'/'.$receipt);

    } catch (\Exception $e) {
        // dd($e);
        DB::rollback();
        // dd($order);
        return redirect()->route('product.shoppingCart')->with('error', $e->getMessage());
    }

    DB::commit();

    // dd($orders->id);
    Session::forget('cart');
      
    return $pdf->download('receipt.pdf');

    // return redirect()->route('product.shoppingCart')->with('success','Successfully Purchased Your Pet products!');

    } else {
        return Redirect::route('user.signin')->with('warning', 'Please sign-in first.');
        // return view('user.signin');
    }
}


}
