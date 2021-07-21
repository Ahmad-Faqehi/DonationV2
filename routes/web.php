<?php

use Illuminate\Support\Facades\Route;
use App\Donation;
use App\Donor;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    $donation = new Donation();
//    $donation = $donation::where('statues',1)->take(1)->get();
//    return view('index')->with('donation',$donation);
    return view('intro.index');
});

// Redirects
Route::get('/home',function (){
    return redirect('admin/home');
});
Route::get('/admin',function (){
    return redirect('admin/home');
});

//Auth::routes();
Route::get('set/{token}','DonationController@setPage');


Route::get('admin/home','DonationController@index');
Route::get('admin/donations','DonationController@showAll');
Route::get('admin/show/{id}','DonationController@show');
Route::get('admin/removeDonation/{id}','DonationController@destroy');
Route::get('admin/editDonor/{idDonation}/{idDonor}','DonorConroller@editDonr');
Route::get('admin/removeDonor/{idDonation}/{idDonor}','DonorConroller@destroy');
Route::get('admin/add', 'DonationController@addDonation');
Route::get('admin/users', 'UserController@index');
Route::get('admin/addUser', 'UserController@create');
Route::get('admin/removeUser/{id}','UserController@destroy');
Route::get('admin/archived/{id}','DonationController@arched');
Route::get('admin/stopit/{id}','DonationController@stopit');
Route::get('admin/paid/{id}','DonationController@updatePaid');




Route::resource('donation', 'DonationController');
Route::resource('donor', 'DonorConroller');
Route::resource('user', 'UserController');
Auth::routes(['register' => true]);

//Route::get('/home', 'HomeController@index')->name('home');
