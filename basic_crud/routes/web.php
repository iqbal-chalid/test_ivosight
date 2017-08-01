<?php

// namespace App\Http\Controllers;

// use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\Controller

/*
|--------------------------------------------------------------------------
| MongoDB
|--------------------------------------------------------------------------
|
*/
 
use App\Http\Kernel;
// use Request;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class AddressBookModel extends Eloquent {

    protected $connection = 'mongodb';
    protected $collection = 'addressbook';

}

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

Route::get('/addressbook/', function () {

	$rows = DB::collection('addressbook')->get();

    return $rows;
});

Route::get('/addressbook/add/', function () {

	return view('addressbook_add');
});

Route::get('/addressbook/change/{first_name}', function ($first_name) {

	$rows = DB::collection('addressbook')->where('first_name', $first_name)->get();

	$first_name = $rows[0]['first_name'];
	$last_name = $rows[0]['last_name'];
	$address = $rows[0]['address'];
	$email = $rows[0]['email'];
	$contact = $rows[0]['contact'];

	$context = compact('first_name', 'last_name','address', 'email', 'contact');

	return view('addressbook_change', $context);
});

Route::get('/addressbook/delete/{first_name}', function ($first_name) {

	$thename = $first_name;

	$context = compact('thename');

	return view('delete_confirmation', $context );
});

Route::get('/addressbook/exec_delete/{first_name}/', function ($first_name) {

	DB::collection('addressbook')->where('first_name', $first_name)->delete( );

	return view('addressbook');
});

Route::post('/addressbook/exec_add/', function () {

	$request 	=  Request::all();

	$first_name = $request['first_name'];
	$last_name  = $request['last_name'];
	$address 	= $request['address'];
	$email 		= $request['email'];
	$contact 	= $request['contact'];

	DB::collection('addressbook')->insert( ['first_name' => $first_name, 'last_name' => $last_name, 'address' => $address, 'email' => $email, 'contact' => $contact] );

	return view('addressbook');
});

Route::post('/addressbook/exec_change/{first_name}', function ($first_name) {

	$request 	=  Request::all();

	$first_name = $request['first_name'];
	$last_name  = $request['last_name'];
	$address 	= $request['address'];
	$email 		= $request['email'];
	$contact 	= $request['contact'];

	DB::collection('addressbook')->where('first_name', $first_name)->update(['first_name' => $first_name, 'last_name' => $last_name, 'address' => $address, 'email' => $email, 'contact' => $contact] , ['upsert' => true]);

	return view('addressbook');
});


Route::get('/', function () {
    return view('addressbook');
});

