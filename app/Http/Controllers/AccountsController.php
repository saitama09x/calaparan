<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\{Guest_accounts};

class AccountsController extends Controller{

	use AuthenticatesUsers;

	public function __construct()
    {

    }

    protected function guard(){
        return Auth::guard('web');
    }

	function login(){
		return view('accounts.login');
	}

	function register(){

		return view('accounts.register');
	}

	function account_login(Request $r){
		$user = $r->username;
		$pass = $r->password;
		if(Auth::attempt(['username' => $user, 'password' => $pass])) {
			return redirect()->intended('student_record');
		}

		return redirect()->intended('/');
	}

	function account_logout(){
		Auth::logout();
		return redirect()->intended('/');
	}

	function account_register_add(Request $r){

		$username = $r->username;
		$password = $r->password;
		$fname = $r->fname;
		$mname = $r->mname;
		$lname = $r->lname;
		$email = $r->email;
		$type = $r->account_type;

		$new = new Guest_accounts;
		$new->username = $r->username;
		$new->password = Hash::make($r->password);
		$new->fname = $r->fname;
		$new->mname = $r->mname;
		$new->lname = $r->lname;
		$new->email = $email;
		$new->account_type = $type;
		$new->is_active = 0;

		$new->save();

		if($new->id){
			return redirect('/admin');
		}
	}

	function register_done(){
		return view('accounts.register_done');
	}

}