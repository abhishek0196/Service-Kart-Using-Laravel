<?php
namespace App\Http\Controllers\ServiceproviderAuth;
use App\Serviceprovider;
use App\ServiceTime;
use App\VerifyServiceProvider;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Validator;
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/serviceprovider/login';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:serviceprovider');
    }
   /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }*/
    
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
            'email' => 'required|string|email|max:255|unique:serviceproviders',
            'password' => 'required|string|min:6|confirmed',
            'phone_no' => 'required|numeric|min:10|unique:serviceproviders',
            'day' => 'required',           
        ]);
     
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Serviceprovider
     */
    protected function create(array $data)
    {
        
        $user = Serviceprovider::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_no' => $data['phone_no'],
            'password' => bcrypt($data['password']),
            'google_code' => $data['google_code'],
            
        ]);
     
        foreach($data['Day'] as $day)
        {
            $user->ServiceTime = ServiceTime::create([
                'serviceproviders_id' => $user->id,
                //'start_time' => $data['start_time'],
                //'end_time' => $data['end_time'],
                'Day' => $day,
                
                
            ]);
        }
        return $user; 
                         
    }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('serviceprovider.auth.register');
    }
    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('serviceprovider');
    }
    public function register(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);
        if($validator->passes()){
            $user = $this->create($input)->toArray();

            $otp= random_int ( 00000 , 99999 );
            
            $user['link']  = $otp;
            DB::table('verify_service_providers')->insert(['serviceprovider_id' => $user['id'], 'token' => $user['link']]);
            Mail::send('mail.useractivation', $user, function($message) use ($user){
                $message->to($user['email']);
                $message->subject('Service Kart - Activation Code');
            });
            return redirect()->to('/serviceprovider/otp')->with('Success',"We sent activation code, please check your email")->with('otp',$otp);
        }
        return back()->with('Error', $validator->errors());
    }
    /*public function userActivation($token)
    {
        $check = DB::table('verify_service_providers')->where('token', $token)->first();
        if(!is_null($check)) 
        {
            $user = ServiceProvider::find($check->serviceprovider_id);
            if($user->verified == 1)
            {
                return redirect()->to('/serviceprovider/login')->with('Success', "User are already activated");
            }
            $user->update(['verified' => 1]);
            DB::table('verify_service_providers')->where('token', $token)->delete();
            return redirect()->to('/serviceprovider/login')->with('Success', "User active successfully");
        }
        return redirect()->to('/serviceprovider/login')->with('warning', "Your token is invalid");
    }*/
    public function otp()
    {
        return view('serviceprovider.auth.otpcheck');
    }
    public function otpCheck(Request $r)
    {
       // dd($r->input('otp'));
       $otp =  $r->input('otp');
       
        $check = DB::table('verify_service_providers')->where('token',$otp)->first();
        if(!is_null($check)) 
        {
            $user = ServiceProvider::find($check->serviceprovider_id);
            if($user->verified == 1)
            {
                return redirect()->to('/serviceprovider/login')->with('Success', "User are already activated");
            }
            $user->update(['verified' => 1]);
              
            //DB::delete('delete verify_service_providers where token = ?', ["'".$otp."'"]);
            return redirect()->to('/serviceprovider/login')->with('Success', "User active successfully");
        }
        return redirect()->to('/serviceprovider/login')->with('warning', "Your token is invalid");
    }
   /* public function verifyUser($token)
    {
      $verifyUser = VerifyServiceProvider::where('token', $token)->first();
      if(isset($verifyUser) ){
        $user = $verifyUser->user;
        if(!$user->verified) {
          $verifyUser->user->verified = 1;
          $verifyUser->user->save();
          $status = "Your e-mail is verified. You can now login.";
        } else {
          $status = "Your e-mail is already verified. You can now login.";
        }
      } else {
        return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
      }
      return redirect('/login')->with('status', $status);
    }*/
}