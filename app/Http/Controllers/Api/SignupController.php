<?php

namespace App\Http\Controllers\Api;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function store(Request $request)
    {
        
        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = $request->input('password');
        $user->save();

        return response()->json($user);
    }

    public function check(Request $request)
    {
        
        $user = User::where('email',$request->input('email'))->first();

        if($user){
            if(Hash::check($request->input('password'), $user->password)){
                $message = [
                    'user'=> $user,
                    'status'=> 200
                ];
                return response()->json($message);
    
            }else{
                return response()->json(['message'=>'password is not valid','status'=>400]);
            }

        }else{
            return response()->json(['message'=>'email is not valid','status'=> 401]);
            
        }
        
       
          
        

       
    }
}
