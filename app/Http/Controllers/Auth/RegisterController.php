<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
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
        return Validator::make($data, [
            'name' => ['required', 'string'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ], $messages = array(
            'name.required' => 'لطفا نام و نام خانوادگی را وارد کنید',
            'name.string' => 'لطفا نام و نام خانوادگی را به درستی وارد کنید',
            'email.required' => 'لطفا نام کاربری را وارد کنید',
            'password.required' => 'لطفا کلمه عبور را وارد کنید',
            'email.string' => 'لطفا فرمت کلمه عبور را به درستی وارد کنید',
            'email.min' => 'لطفا کلمه عبور را بزگتر از 5 کاراکتر وارد کنید',
            'email.confirmed' => 'کلمه عبور به درستی تکرار نشده است',
        ));
    }
    public function messages()
    {
        return [
            'name.required' => 'لطفا نام و نام خانوادگی را وارد کنید',
            'name.string' => 'لطفا نام و نام خانوادگی را به درستی وارد کنید',
            'email.required' => 'لطفا نام کاربری را وارد کنید',
            'password.required' => 'لطفا کلمه عبور را وارد کنید',
            'email.string' => 'لطفا فرمت کلمه عبور را به درستی وارد کنید',
            'email.min' => 'لطفا کلمه عبور را بزگتر از 5 کاراکتر وارد کنید',
            'email.confirmed' => 'کلمه عبور به درستی تکرار نشده است',
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
