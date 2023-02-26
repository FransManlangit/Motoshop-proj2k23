<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'user'], function(){
     Route::group(['middleware' => 'guest'], function() {

        //customer signup
     Route::get('user/signup', [UserController::class, 'getSignup'])->name('user.signup');
     Route::post('signup', [UserController::class, 'postSignup'])->name('user.signups');

     //mechanic signup
     Route::get('user/msignup', [UserController::class, 'MechanicSignup'])->name('user.msignup');
     Route::post('msignup', [UserController::class, 'postMechanic'])->name('user.msignups');


     Route::get('signin', [UserController::class, 'getSignin'])->name('user.signin');

     Route::post('login', [LoginController::class, 'postSignin'])->name('user.signins');
         });
});



//Customer Route Group
Route::group(['middleware' => 'role:customer'], function() {

    Route::get('profile', [UserController::class, 'getProfile'])->name('user.profile');



    Route::put('/customers/{id}/update', [CustomerController::class, 'update'])->name('customers.update');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');


    });


//Mechanic Route Group
Route::group(['middleware' => 'role:mechanic'], function() {

    Route::get('mprofile', [UserController::class, 'getMprofile'])->name('user.mprofile');
   
    Route::put('/mechanics/{id}/update', [MechanicController::class, 'update'])->name('mechanics.update');
    Route::get('/mechanics/{id}/edit', [MechanicController::class, 'edit'])->name('mechanics.edit');

    });



//Admin Route Group
Route::group(['middleware' => 'role:admin'], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    //motorcycle Route
    Route::resource('motorcycle', 'MotorcycleController');
    // Route::resource('motorcycle', 'motorcycleController')->except(['index','delete','update']);
    
    Route::get('/motorcycle', [
          'uses' => 'MotorcycleController@getmotorcycles',
           'as' => 'getmotorcycles'
        ]);
    
    Route::post('/motorcycle/import', 'MotorcycleController@import')->name('motorcycleImport');
    
    Route::get('/motorcycle/restore/{id}',['uses' => 'MotorcycleController@restore','as' => 'motorcycle.restore']);


    //customer routes
   Route::get('/customer', [CustomerController::class, 'index'])->name('customers.index');
   Route::get('/customers', [CustomerController::class, 'getCustomer'])->name('getCustomer');
   Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
   Route::post('/customer/import', 'CustomerController@import')->name('customerImport');


   //mechanics route
   Route::get('/mechanic', [MechanicController::class, 'index'])->name('mechanics.index');
   Route::get('/mechanics', [MechanicController::class, 'getMechanic'])->name('getMechanic');
   Route::delete('/mechanics/{id}', [MechanicController::class, 'destroy'])->name('mechanics.destroy');
   Route::post('/mechanic/import', 'MechanicController@import')->name('mechanicImport');


   //product route
    Route::get('/product', [ProductController::class, 'index'])->name('products.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/product/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products', [ProductController::class, 'getProduct'])->name('getProduct');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
Route::get('logout', [LoginController::class, 'logout'])->name('user.logout');

     //shop route
Route::get('/product/review/{id}','ProductController@show')->name('shop.review');

Route::post('/product/reviewStore',['uses' => 'ProductController@reviewStore','as' => 'product.reviewStore']);

Route::get('/shop', [
    'uses' => 'ProductController@index',
    'as' => 'shop.index'
    ]);

Route::get('add-to-cart/{id}',[
  'uses' => 'ProductController@getAddToCart',
  'as' => 'product.addToCart'
]);

Route::get('shopping-cart', [
  'uses' => 'ProductController@getCart',
  'as' => 'product.shoppingCart'
    // 'middleware' =>'role:customer'
]);

Route::get('checkout',[
  'uses' => 'ProductController@postCheckout',
  'as' => 'checkout',
  'middleware' =>'role:customer'
]);

Route::get('reduce/{id}',[
  'uses' => 'ProductController@getReduceByOne',
  'as' => 'product.reduceByOne'
]);

Route::get('remove/{id}',[
  'uses'=>'ProductController@getRemoveItem',
  'as' => 'product.remove'
]);




