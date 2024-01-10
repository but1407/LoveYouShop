<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Services\LoginService;
use App\Events\Auth\UserLoggedOut;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

// use Illuminate\Validation\Validator;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $loginservice;
    
    public function __construct(LoginService $loginservice)
    {
        $this->loginservice = $loginservice;
        // $this->middleware('guest')->except('logout');

    }
    public function index()
    {
        return view('admin.users.login',[
            'title' => 'Login'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        if (
            Auth::attempt([
                //kiem tra co dung email va password
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'confirm' => 1,
            ], $request->input('remember'))
        ) {
            return redirect()->route('home');
            // return redirect()->back(); //chuyen huong tro lai
        }
        Session::flash('error', 'wrong email or password or not exists'); //tao session alert error
        return redirect()->back(); //chuyen huong tro lai
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        return view('admin.users.forgotPass.search-email',[
            
        ]);
        
    }
    
    public function postForgotPass(Request $request)
    {
        $customer = $this->loginservice->postForgotPass($request);
        if ($customer) {
            return view('admin.users.forgotPass.search-email-exist',['name'=>$customer->name,
            'email'=>$customer->email
        ]);
        }
        return redirect()->back()->with('error', 'Loi khong tim thay tai khoan');

    }
    public function getPass(User $customer, $token)
    {
        
        if($customer->token === $token){
            return view('admin.users.change-password',['email'=> $customer->email]);

        }
        return '404';
    }
    public function postGetPass(User $customer, $token, Request $request  ){
        
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required',

        ]);
        if($request->password === $request->confirm_password){

            $password_h = bcrypt($request->password);
            $customer->update(['password'=> $password_h, 'token'=> null]);
            return redirect()->route('login')->with('yes', 'dat lai mat khau thanh cong');
        }
        Session::flash('error', 'Password không khớp');
        return redirect()->back();
    }
    public function logout(Request $request)
    {
        // Remove the socialite session variable if exists
        if (app('session')->has(config('access.socialite_session_name'))) {
            app('session')->forget(config('access.socialite_session_name'));
        }

        // Fire event, Log out user, Redirect
        event(new UserLoggedOut($request->user()));

        // Laravel specific logic
        Auth::guard()->logout();
        $request->session()->invalidate();

        return redirect()->route('login.index');
    }
    // protected function sendLoginResponse(Request $request){
    //     dd(1);
    //     $request->session()->regenerate();
    //     $this->clearLoginAttempts($request);
    //     if($response =$this->authenticated($request,$this->guard()->user())){
    //         return $response;
    //     }
    //     $sessionId = $request->session()->getId();
    //     $user = $request->user();
    //     $user->last_session = $sessionId;
    //     $user->save();

    //     return $request->wantsJson()
    //         ? new JsonResponse([], 204)
    //         : redirect()->intended($this->redirectPath());
    // }
}