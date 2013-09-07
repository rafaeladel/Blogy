<?php

class UserController extends BaseController {

	public function getCreateAdmin(){
		return View::make('admin.create');
	}

	public function postCreateAdmin(){
		$data = Input::all();
		$rules = array(
				'username' => 'required|min:3',
				'password' => 'required|min:3',
			);

		$validator = Validator::make($data, $rules);

		if($validator->passes()){
			$user = new User();
			$user->username = htmlentities(trim($data['username']));
			$user->password = Hash::make($data['password']);
			$user->save();
			return Redirect::to('admin');
		} else {
			return Redirect::route('getSignup')->withErrors($validator)->withInput();
		}
	}

	public function getLogin(){
		return View::make('login');
	}

	public function postLogin(){
		$data = Input::all();
		$username = htmlentities($data['username']);
		// $password = Hash::make($data['password']);
		$password = $data['password'];
		$rememberme = isset($data['rememberme']) && $data['rememberme'] == 1 ? true : false;

		if(Auth::attempt(array('username' => $username, 'password' => $password), $rememberme)){
			return Redirect::intended('admin');
		} else {
			$message = "Invalide Username or Password";
			return View::make('login')->with('message', $message);
		}
	}

	public function getLogout(){
		if(Auth::check()){
			Auth::logout();
		}
		return Redirect::to('/');
	}
}

?>