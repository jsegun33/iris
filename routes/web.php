<?php

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

// Route::get('/', function () {
//     // return view('welcome');
//     return redirect(route('login'));
// });
Route::get('/GetUserData', function() {
	$auth_user = auth()->user();

	$auth = [
		'first_name' 			=> $auth_user->user_fname,
		'last_name' 			=> $auth_user->user_lname,
		'user_mname' 			=> $auth_user->user_mname,
		'_id' 					=> $auth_user->_id,
		'AccountNo' 			=> $auth_user->AccountNo,
		'department' 			=> $auth_user->department,
		'password' 			    => $auth_user->password,
		'ApprovedLimit' 	    => $auth_user->ApprovedLimit,
		'email' 	    		=> $auth_user->email,
		'ContactNo' 	        => $auth_user->ContactNo,
		'AgentType' 	        => $auth_user->AgentType,
		'SubAgent'				=> $auth_user->SubAgent,
		'signature'				=> $auth_user->signature,
		'CashOutDiscount'		=> $auth_user->CashOutDiscount,
		'TINno'					=> $auth_user->TINno,
		'CName' 	        	=>  $auth_user->user_fname . ' ' . $auth_user->user_mname . ' ' .$auth_user->user_lname ,
	];
    return $auth;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d\-\/_.]+)?');


Route::get('/', [
	'uses'  =>  'HomeController@index',
	'as'	=>   'home'

]);





