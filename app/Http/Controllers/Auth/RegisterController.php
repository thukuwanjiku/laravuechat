<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Chatkit\Chatkit;
use Chatkit\Exceptions\MissingArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        try {
            $chatkit = new Chatkit([
                'instance_locator' => 'v1:us1:663b8744-26ef-4713-9a95-6aac9c5329d1',
                'key' => '5f9f3b3c-7fc3-4cd2-a27b-10c28e318013:SnVSnR+MCYEfYqCISov0/eWu3qWT+l92AgCktAvj93k='
            ]);

            $chatkit->createUser([
                'id' => $user->email,
                'name' => $user->name,
                'avatar_url' => 'https://www.shareicon.net/download/2015/09/18/103159_user.ico'
            ]);

            $chatkit->createRoom([
                'creator_id' => $user->email,
                'name' => $user->email.'_Room',
                'private' => false,
            ]);
            
            Session::put('email', base64_encode($user->email));

        } catch (MissingArgumentException $e) {
            //throw new \Exception($e->getMessage());
        }

    }

}
