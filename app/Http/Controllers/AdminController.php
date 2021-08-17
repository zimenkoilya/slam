<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\History;
use App\Models\Refer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user = auth()->user();
        $users = User::where('id', '!=', $user->id)->withTrashed()->get();
        return view('admin.index', compact('users', 'user'))->with('active', 'user');
    }

    public function profile($user_id){
        $user = auth()->user();
        $user_data = User::withTrashed()->find($user_id);
        
        return view('admin.profile', compact('user_data', 'user'))->with('active', 'user');
    }

    public function setting(){
        $user = auth()->user();
        return view('admin.setting', compact('user'))->with('active', 'setting');
    }

    public function destroy($id){
        User::find($id)->delete();
        return back()->with('destroy', 'Deleted Successfully!');
    }

    public function retrieve($id){
        User::withTrashed()->find($id)->restore();
        return back()->with('success', 'Retrieved Successfully!');
    }
    
    public function update(Request $request){
        $email_confirm = User::whereNotIn('id', [auth()->user()->id])->where('email', $request->email)->get();
        if(count($email_confirm)>0){
            return back()->with('destroy', 'The Email is exist already. Please Use other email');
        }
        if($request->cpass !== $request->npass){
            return back()->with('destroy', 'Password is not matched.');
        }

        $user = User::find(auth()->user()->id);
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;

        $user->name = $request->name;
        $user->slam_name = $request->slam_name;
        $user->tg_name = $request->tg_name;

        if($request->npass){
            $user->password = Hash::make($request->npass);  
        }
        $user->save();

        return back()->with('success', 'Updated Successfully!');
    }
    
    public function bonus(Request $request){
        if($request->bonus == null){
            return back();
        }
        $trans = new History();
        $trans->user_id = $request->user_id;
        $trans->slam = $request->bonus;
        $trans->bnb = "BONUS";
        $trans->save();
        return back()->with('success', 'Sent successfully');
    }

    public function memo_save(Request $request){
        
        $validated = $request->validate([
            'user_id' => 'required',
            'memo' => 'required'
        ]);

        $user = User::find($request->user_id);
        $user->memo = $request->memo;
        $user->save();

        return 'Memo saved successfully';
    }
    
    public function password_update(Request $request){
        
        $validated = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user = User::find($request->user_id);
        $user->password = bcrypt($request->password);
        $user->save();

        return 'Password updated successfully';
    }
    
    public function forceswap(Request $request) 
    {
        $user = User::find($request->user_id);
        // get user info and deduct from the history table

        // add removed funds to admin wallet

        
    }
}
