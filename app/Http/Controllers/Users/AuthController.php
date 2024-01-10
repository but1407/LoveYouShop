<?php

namespace App\Http\Controllers\Users;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\UserVerification;
use App\Services\LoginService;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;



class AuthController extends Controller
{
    private $loginservice;
    public function __construct(LoginService $loginservice){
        $this->loginservice = $loginservice;
        // $this->middleware('auth:api', ['except' => ['login','refresh']]);
    }
    
    // public function login()
    // {
    //     $credentials = request(['email', 'password']);

    //     if (! $token = auth()->attempt($credentials)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     $refreshToken = $this->createRefreshToken();
    //     return $this->respondWithToken($token,$refreshToken);
    // }
    // protected function respondWithToken($token,$refreshToken)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'refresh_token' => $refreshToken,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth()->factory()->getTTL() * 60,
    //     ]);
    // }
    public function index(){
        return view('admin.users.register.form-register',[
        ]);
    }
    // public function me()
    // {
    //     try{
    //         return response()->json(auth()->user());

    //     } catch(JWTException $e){
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }
    // }
    // public function logout()
    // {
    //     auth()->logout();

    //     return response()->json(['message' => 'Successfully logged out']);
    // }
    // public function refresh()
    // {
    //     $refreshToken = request()->refresh_token;
    //     try{

    //         $decoded = JWTAuth::getJWTProvider()->decode($refreshToken);

    //         $user = User::find($decoded['user_id']);
    //         if(!$user){
    //             return response()->json([
    //                 'error' => 'User not found',
    //             ],404);
    //         }
    //         $token = auth()->login($user);
    //         $refreshToken = $this->createRefreshToken();
    //     } catch (JWTException $e){
    //         return response()->json([
    //             'error' =>'refresh Invalid Token'
    //         ],500);

    //     }
    //     return $this->respondWithToken($token,$refreshToken);

    //     // return $this->respondWithToken(auth()->refresh());
    // }
    // private function createRefreshToken(){
    //     $data=[
    //         'user_id'=> auth()->user()->id,
    //         'random'=> rand() . time() ,
    //         'exp'=> time() + config('jwt.refresh_ttl'),
    //     ];
    //     $refreshToken =JWTAuth::getJWTProvider()->encode($data);
    //     return $refreshToken;
    // }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|between:2,100',
            'email' => 'required|string|email|max:100',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error',$validator->errors());
        }
        if($request->password === $request->confirm_password) {
        $user = User::where('email', $request->email)->first();
        if (!empty($user)) {
            if ($user['confirm'] == true) return redirect()->back()->with('error' , 'Email existed');
            else {
                return redirect()->back()->with('error','This api just use for registering the first time.Please use api re_register to reregister');
            }
        }
        $user = User::create(array_merge(
            $validator->validated(),
            [
                'password' => bcrypt($request->password),
                'confirm' => false,
                'confirmation_code' => rand(100000, 999999),
                'confirmation_code_expired_in' => Carbon::now()->addSecond(60),
            ]
        ));
        try {
            Mail::to($user->email)->send(new UserVerification($user));
            return redirect()->route('verification.verify',['id' => $user->id]);

        } catch (\Exception $err) {
            $user->delete();
            return redirect()->back()->with('error', 'Could not send email verification,please try again');
            
        }}
        return redirect()->back()->with( 'error' , 'Failed to create');
        
    }
    public function re_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100',
            // 'password' => 'string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user['confirm'] == true)
                return response()->json([
                    'message' => 'Email existed',
                ], 401);
            else {
                $user->confirmation_code = rand(100000, 999999);
                $user->confirmation_code_expired_in = Carbon::now()->addSecond(60);
                $user->save();
                try {
                    Mail::to($user->email)->send(new UserVerification($user));
                    return response()->json([
                        'message' => 'Registered again,verify your email address to login ',
                        'user' => $user
                    ], 201);
                } catch (\Exception $err) {
                    $user->delete();
                    return response()->json([
                        'message' => 'Could not send email verification,please try again',
                    ], 500);
                }
            }
        }
        return response()->json([
            'message' => 'Failed to re_register',
        ], 500);
    }

}