<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\History;
use App\Models\Refer;
use App\Models\PasswordReset;
use Hash;
use Validator;
use Auth;
class RegisterController extends Controller
{
    public function signup(Request $request){

        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required',
            'address' => 'required',
            'privatekey' => 'required'
        ]);
       
        if ($v->fails())
        {
            return ['status'=>"mail",'message'=>$v->errors()];
        }

        $check_refer = 0;
        if($request->refer_id){
            
            $refer = User::find($request->refer_id);
            
            if($refer){
                $check_refer = 1;    
            }else{
                return ['status'=>"refer", 'message'=>"The refer ID is incorrect"];
            }
            
        }
        
        $token = base64_encode(random_bytes(64));
        
        $user = new User();
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = $token;
        $user->address = $request->address;
        $user->private = $request->privatekey;
        $user->save();

        if($check_refer == 1){
            $refer = new Refer();
            $refer->user_id = $request->refer_id;
            $refer->refer_id = $user->id;
            $refer->save();
        }
        
        return ['status'=>"ok", 'token'=>$token];

    }

    public function signin(Request $request){
       
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $token =  $token = base64_encode(random_bytes(64));
            $user = User::where('email', $request->email)->first();
            $user->remember_token = $token;
            $user->save();

            return ['status'=>"ok", 'token'=>$token];
        }else{
            return ['status'=>"error", 'message'=>"Email or password is incorrect."];
        }
  
    }

    public function forget(Request $request){
        $user = User::where('email', $request->email)->first();
        $token = rand(1000,9999);
        if($user){
            $reset = new PasswordReset();
            $reset->email = $request->email;
            $reset->token =  $token;
            $reset->save();
            $url = "email=".$request->email."&token=".$token;
            $encode_url = rtrim(strtr(base64_encode($url), '+/', '-_'), '=');
            \Mail::to($request->email)->send(new \App\Mail\ForgetPassword($encode_url));
        }else{
            return ['status'=>'error', 'the mail is not exist'];
        }
    }

    public function token(Request $request){
        $token = $request->token;
        $users = User::where('remember_token', $token)->first();
        
        if($users){
            $admin = User::where('rol', 1)->first();
            $trans = History::where('user_id', $users->id)->get()->toArray();
            $slam = 0;
            foreach($trans as $temp){
                $slam = $slam+$temp['slam'];
            }
        
            return ['status'=>'ok', 'address'=>$users->address, 'privateKey'=>$users->private, 'email'=>$users->email, 'phone'=>$users->phone, 'id'=>$users->id, 'admin'=>$admin->address, 'trans'=>$trans, 'slam'=>$slam];
        }else{
            return ['status'=>'false', 'message'=>'Something went wrong'];
        }
    }
    
    public function eth_slam(Request $request){
        
        $trans = new History();
        $trans->user_id = $request->user_id;
        $trans->slam = $request->slamAmount;
        $trans->eth = $request->ethAmount;
        $trans->bnb = 'ETH';
        $trans->save();
        $transact = History::where('user_id', $request->user_id)->get()->toArray();
        return ['status'=>'ok', 'trans'=>$transact];
        
    }
    
    public function bnb_slam(Request $request){
        
        $trans = new History();
        $trans->user_id = $request->user_id;
        $trans->slam = $request->slamAmount;
        $trans->eth = $request->bnbAmount;
        $trans->bnb = 'BNB';
        $trans->save();
        $transact = History::where('user_id', $request->user_id)->get()->toArray();
        return ['status'=>'ok', 'trans'=>$transact];
        
    }
    
    
}
