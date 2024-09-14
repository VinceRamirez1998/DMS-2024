<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
        dd('asd');
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'firstname' => ['required','string','max:255'],
            'lastname' => ['required','string', ],
            // 'department' => ['required','string','in:ccs,cea,cbs,cas,coe,chm,cit,cssp,law'],
            'position' => ['required','string','max:255'],
            'purpose' => ['required','string','in:inquire,request'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required','same:password'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'position' => $data['position'],
            'purpose' => $data['purpose'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $validator = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'purpose' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'same:password'],
        ], [
            'username.unique' => 'The username has already been taken.',
            'email.unique' => 'The email address is already in use.',
            'email.email' => 'The email address must be a valid email format.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password_confirmation.same' => 'The password confirmation must match the password.',
        ]);

        $createUser = User::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'username' => $request['username'],
            'email' => $request['email'],
            'position' => $request['position'],
            'purpose' => $request['purpose'],
            'password' => Hash::make($request['password']),
            'focal_person' => $request['focal_person'],
        ]);

        
        // Log in user
         $credentials = $request->only('email', 'password');
         if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
         }else{
             return redirect('/home');
         }
    }
    
}
