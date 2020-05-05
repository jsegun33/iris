<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Registration;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
			 $curYear = date('Y'); 
			 $CountUser = Registration::count() + 1;
			 $NewCountUser = str_pad($CountUser, 4, '0' , STR_PAD_LEFT); 
      
			 $AccountNo =  $curYear. "-".$NewCountUser;
	  
        
		return User::create([
            'name' 				=> $data['name'],
            'email' 			=> $data['email'],
            'password' 			=> Hash::make($data['password']),
			
			'department'        => "NONE",
			'AccountNo'        => $AccountNo,
            'active'           => '1',
            'status'           => '1',
            'CName'		       =>  $data['name'], 
            'Limit'            =>  0	,
            'CashOutDiscount' =>  0	,
			'pageRegister'	   => 1,	///for User registration	 
			
			
			
        ]);
    }
    
   



}
