<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\{Guest_accounts, Teachers, Students};
use App\Services\UploadHandler;

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
			if(Auth::guard('web')->check()){
				if(Auth::user()->account_type_label == "Teacher"){
					$auth = Auth::user();
					$user = Teachers::where("id", $auth->account_id)->get();
					if($user->count()){
						
						$r->session()->forget('sidebarName');
						$r->session()->forget('profile_pic');

						$r->session()->put('sidebarName', $user->first()->fullname);
						if($user->first()->profile_pic != null){
							$r->session()->put('profile_pic', env('APP_URL') . '/storage/app/images/' . $user->first()->profile_pic);
						}else{
							$r->session()->put('profile_pic', asset('assets/img/avatar.png'));
						}
						
					}
				}
				else if(Auth::user()->account_type_label == "Student"){
					$auth = Auth::user();
					$user = Students::where("id", $auth->account_id)->get();
					if($user->count()){
						$row = $user->first();
						$r->session()->put('sidebarName', $row->fname . " " . $row->lname);
					}
				}
			}

			return redirect()->route('guest_dashboard');
		}

		return redirect()->intended('/')->with("login_error", "Incorrect Login");
	}

	function account_logout(Request $r){
		
		$r->session()->forget('sidebarName');
		$r->session()->forget('profile_pic');

		Auth::logout();
		
		return redirect()->intended('/');
	}

	function student_check(Request $r){

		$validatedData = $r->validate([
	        'lrefno' => 'required',
	    ], [
	    	'lrefno.required' => 'Please fill in your Learner Referrence Number'
	    ]);

		$find = Students::where("lrefno", $r->lrefno)->get();

		if($find->count()){
			
			$guess = Guest_accounts::where([
				['account_type_label', "=", "Student"],
				['account_id', "=", $find->first()->id]
			])->get();

			if(!$guess->count()){
				return redirect()->route("student_password", $r->lrefno)->with('no_account', "You have no account yet, Please create your account");
			}
			else
			{
				return redirect()->route("student_register")->with('with_record', "You already registered");	
			}
			
		}
		else{
			return redirect()->route("student_register")->with('no_record', "You record not found, please check in your school");	
		}
	}

	function student_password($lrn){

		$find = Students::where("lrefno", $lrn)->get();

		if($find->count()){

			$obj = [
				'user' => $find->first(),
				'lrn' => $lrn
			];

			return view('accounts.register-student_password', $obj);
		}
	}

	function student_account_create(Request $r, $lrn){

		$validatedData = $r->validate([
	        'password' => 'required|same:confirm|string|min:5',
	        'confirm' => 'required|string|same:password'
	    ], [
	    	'password.same' => "Your password is not match",
	    	'password.required' => "Your password is required",
	    	'confirm.same' => "Confirm your password"
	    ]);


		$find = Students::where("lrefno", $lrn)->get();

		if($find->count()){

			$guess = Guest_accounts::where([
				['account_type_label', "=", "Student"],
				['account_id', "=", $find->first()->id]
			])->get();

			if(!$guess->count()){
				$new = new Guest_accounts;
				$new->username = $lrn;
				$new->password = Hash::make($r->password);
				$new->account_type = "App\Models\Students";
				$new->is_active = 1;
				$new->account_id = $find->first()->id;
				$new->account_type_label = "Student";
				$new->date_created = date("Y-m-d", time());
				$new->date_updated = date("Y-m-d", time());
				$new->save();
			}
			else{
				return redirect()->route("student_register")->with('with_record', "You already registered");
			}
		}

		return redirect()->route("done_register");
	}

	function register_done(){
		return view('accounts.register_done');
	}

	function uploadProfilePic(Request $r){
		$upload_dir = storage_path('app/images/');

        $uploader = new UploadHandler(array(
        'upload_dir' => $upload_dir,
        'upload_url' => '/storage/app/images/',        
        ));
	}

	function updateProfilePic(Request $r){
		$auth = Auth::user();
		$user = Teachers::where("id", $auth->account_id);
		$pic = $r->picture;

		if($user->exists()){
			$update = $user->update([
				'profile_pic' => $pic
			]);

			return response()->json(['status' => true]);
		}
		
		return response()->json(['status' => false]);
	}

}