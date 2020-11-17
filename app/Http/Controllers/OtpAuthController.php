<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Validator;

class OtpAuthController extends Controller
{
    public $successStatus = 200;

    // public function login(Request $request){
    //     Log::info($request);
    //     if(Auth::attempt(['mobile' => request('mobile'), 'password' => request('password')])){
    //         return view('home');
    //     }
    //     else{
    //         return Redirect::back ();
    //     }
    // }
    
    public function registerPage(){
        return view('auth.register-otp');
    }

    public function loginPage(){
        return view('auth.login-otp');
    }

    public function loginWithOtp(Request $request){
        Log::info($request);
        $otp = rand(1000,9999);
        if ($request->mobile!=""){
                $validator = Validator::make($request->all(), [
                    'mobile' => ['required', 'string', 'min:10', 'max:15'],
                ]);
                $user = User::where('mobile', $request->mobile)->first();
        }
        else if($request->email!=""){
            
                $validator = Validator::make($request->all(), [
                    'email' => ['required', 'string', 'email', 'max:255'],
                ]);
                $user = User::where('email', $request->email)->first();
        }
        else{
            $validator = Validator::make($request->all(), [
                'mobile' => ['required', 'string', 'min:10', 'max:15'],
            ]);
            $user = User::where('mobile', $request->mobile)->first();
        }

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        if ($user){
            $uid = $user->id;
            Log::info("otp = ".$otp);
            $user = User::where('id', $user->id)->update(['otp_mobile' => $otp]);
            $arr = array('msg' => 'Successfully stored', 'status' =>  true, 'id'=> $uid);
            return Response()->json($arr);
        }
        else{
            $arr = array('msg' => 'Not Registered', 'status' =>  false);
            return Response()->json($arr);
        }
        
        // return redirect('login');
    }

    public function register(Request $request)
    {
        $otp = rand(1000,9999);
        if ($request->mobile!=""){
            if($request->email!=""){
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'mobile' => ['required', 'string', 'min:10', 'max:15', 'unique:users'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
            }
            else{
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'mobile' => ['required', 'string', 'min:10', 'max:15', 'unique:users'],
                ]);
            }
        }
        else if($request->email!=""){
            if($request->mobile!=""){
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'mobile' => ['required', 'string', 'min:10', 'max:15', 'unique:users'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
            }
            else{
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
            }
        }
        else{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'mobile' => ['required', 'string', 'min:10', 'max:15', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $uid = $user->id;
        Log::info("otp = ".$otp);
        $user = User::where('id', $user->id)->update(['otp_mobile' => $otp]);
        $arr = array('msg' => 'Successfully stored', 'status' =>  true, 'id'=> $uid);
        return Response()->json($arr);
        // return redirect('login');
    }

    public function verifyotp(Request $request){

        Log::info("otp = ".$request->otp);
        $user = User::where('id',$request->uid)->where('otp_mobile', $request->otp)->first();
        if ($user){
            Auth::login($user, true);
            $arr = array('msg' => 'Sucess', 'status' =>  true);
            return response()->json($arr);
            // return response()->json([$user],200);
        }
        else{
            Auth::login($user, false);
            $arr = array('msg' => 'Fail', 'status' =>  false);
            return response()->json($arr);
            // return response()->json([$user],500);
        }
    }
    public function resendOtp(Request $request){

        $otp = rand(1000,9999);
        Log::info("otp = ".$otp);
        $user = User::where('id', $request->uid)->update(['otp_mobile' => $otp]);
        if ($user){
        $arr = array('msg' => 'Sucess', 'status' =>  true);
        return response()->json($arr);
        }
        else{
            $arr = array('msg' => 'Fail', 'status' =>  false);
            return response()->json($arr);
        }
        // send otp to mobile no using sms api
    }
}
