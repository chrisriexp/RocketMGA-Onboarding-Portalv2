<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\adminUser;

class AdminController extends Controller
{   
    public function login(Request $request){
        $existingUser = adminUser::where('user', $request['user'])->get();
        
        if(empty($existingUser[0])){
            return response()->json(["error"=>"No such user."]);
        }

        if($existingUser[0]->password != $request['password']){
            return response()->json(["error"=>"Incorrect password."]);
        } else {
            $existingUser[0]->loggedIn = true;
            $existingUser[0]->save();
            return response()->json(["success"=>"Login successfull.", "id"=>$existingUser[0]->id, "logged in"=>$existingUser[0]->loggedIn]);
        }
    }

    public function status($id){
        $existingUser = adminUser::find($id);

        if($existingUser->loggedIn == 1){
            return response()->json(["login"=> true]);
        } else {
            return response()->json(["login"=> false]);
        }
    }

    public function logout($id){
        $existingUser = adminUser::find($id);

        $existingUser->loggedIn = false;
        $existingUser->save();

        return response()->json(["success"=>"Logout successfull."]);
    }
}
