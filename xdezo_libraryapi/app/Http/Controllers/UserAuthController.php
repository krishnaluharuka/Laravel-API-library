<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;





class UserAuthController extends Controller
{
    function login(Request $request){
        $user=User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return ['result'=>"User not found","success"=>false];
        }else{
            $success['token']=$user->createToken('MyApp')->plainTextToken;
            $user['name']=$user->name;
            return ['success'=>true,"result"=>$success,"msg"=>"user logged in successfully"];
        }
    }

    function signup(Request $req){
        $input=$req->all();
        $input['password']=bcrypt($input['password']);
        $user=User::create($input);
        $success['token']=$user->createToken('MyApp')->plainTextToken;
        $user['name']=$user->name;
        return ['success'=>true,"result"=>$success,"msg"=>"user registered successfully"];
    }
}
