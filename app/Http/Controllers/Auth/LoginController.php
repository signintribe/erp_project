<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\VendorModels\tblcompanydetail;
use App\Models\employeeCenter\tblemployeeinformation;
use App\User;
class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        $input = $request->all();
        if($input['company_id']){
            $user = User::where('email', $input['email'])->first();
            if(empty($user)){
                return redirect()->route('open-company')->withInput()->withErrors(['email' => 'This email is not registered']);
            }else{
                if(empty(tblcompanydetail::where('id', $input['company_id'])->where('user_id', $user->id)->first())){
                    if(empty(tblemployeeinformation::where('company_id', $input['company_id'])->where('user_id', $user->id)->first())){
                        return redirect()->route('open-company')->withInput()->withErrors(['nocompany' => 'You are not registered in this company']);
                    }
                }
                if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
                    session(['company_id' => $input['company_id']]);
                    if (auth()->user()->is_admin == 1) {
                        return redirect()->route('adminhome');
                    } else if (auth()->user()->is_admin == 0) {
                        return redirect()->route('home');
                    }else if(auth()->user()->is_admin == 2){
                        return redirect()->route('userdashboard');
                    }
                } else {
                    return redirect()->route('open-company')->withInput()->withErrors(['password' => 'Email-Address Or Password Are Wrong.']);
                }
            }
        }else{
            $user = User::where('email', $input['email'])->first();
            if(empty($user)){
                return redirect()->route('open-company')->withInput()->withErrors(['email' => 'This email is not registered']);
            }else{
                if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
                    if (auth()->user()->is_admin == 4) {
                        return redirect()->route('superadmin');
                    }
                } else {
                    return redirect()->route('open-company')->withInput()->withErrors(['password' => 'Email-Address Or Password Are Wrong.']);
                }
            }
            return redirect()->route('open-company')->withInput()->withErrors(['selectcompany' => 'Please select company first']);
        }
    }

}
