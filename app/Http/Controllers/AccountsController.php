<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\{Guest_accounts, Teachers};
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
			}
			return redirect()->route('guest_dashboard');
		}

		return redirect()->intended('/');
	}

	function account_logout(Request $r){
		
		$r->session()->forget('sidebarName');
		$r->session()->forget('profile_pic');

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