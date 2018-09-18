<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Customer;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use DB;
use Mail;

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
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function register(Request $request)
    // {
    //     $this->validator($request->all())->validate();

    //     event(new Registered($user = $this->create($request->all())));

    //     $this->guard()->login($user);

    //     return $this->registered($request, $user)
    //                     ?: redirect($this->redirectPath());
    // }


    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/customer/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer');
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
            'google_code' => 'string|min:10',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:6|confirmed',
            'phone_no' => 'required|numeric|min:10|unique:customers',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Customer
     */
    protected function create(array $data)
    {
        $data['password'] =  bcrypt($data['password']);
        return Customer::create($data);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('customer.auth.register');
   }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('customer');
    } 


    public function register(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);

        if($validator->passes())
        {
            $user = $this->create($input)->toArray();
            $user['link'] = str_random(30);

            DB::table('customers_activations')->insert(['id_customer' => $user['id'], 'token' => $user['link']]);
            Mail::send('mail.customeractivation', $user, function($message) use ($user){
                $message->to($user['email']);
                $message->subject('ServiceKart.com - Activation Code');
            });

            return redirect()->to('/customer/login')->with('Success', "We sent an activation code");
        }
        return back()->with('Error', $validator->errors());
    }

    public function userActivation($token)
    {
        $check = DB::table('customers_activations')->where('token', $token)->first();
        if(!is_null($check))
        {
            $user = Customer::find($check->id_customer);
            if($user->verified == 1)
            {
                return redirect()->to('/customer/login')->with('Success', "User already activated");
            }

            $user->update(['verified' => 1]);
            DB::table('customers_activations')->where('token', $token)->delete();
            return redirect()->to('/customer/login')->with('Success', "User active successfully");
        }
        return redirect()->to('/customer/login')->with('warning',"your token is invalid");
    }

    
}