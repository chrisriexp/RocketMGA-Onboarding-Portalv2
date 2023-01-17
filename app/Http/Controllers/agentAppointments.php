<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\appointedAgents;

class agentAppointments extends Controller
{
    public function index(){
        return appointedAgents::orderBy('created_at', 'DESC')->get();
    }

    public function getUser($rocketMGA_id){
        $existingUser = appointedAgents::find($rocketMGA_id);

        return $existingUser;
    }

    public function addUser(Request $request){
        $newUser = new appointedAgents;
        $newUser->rocketMGA_id = $request['rocketMGA_id'];
        $newUser->save();

        if(!empty($request['aon'])){
            $newUser->aon = $request['aon'];
            $newUser->save();
        }

        if(!empty($request['beyond'])){
            $newUser->beyond = $request['beyond'];
            $newUser->save();
        }

        if(!empty($request['dual'])){
            $newUser->dual = $request['dual'];
            $newUser->save();
        }

        if(!empty($request['flow'])){
            $newUser->flow = $request['flow'];
            $newUser->save();
        }

        if(!empty($request['neptune'])){
            $newUser->neptune = $request['neptune'];
            $newUser->save();
        }

        if(!empty($request['palomar'])){
            $newUser->palomar = $request['palomar'];
            $newUser->save();
        }

        if(!empty($request['sterling'])){
            $newUser->sterling = $request['sterling'];
            $newUser->save();
        }

        if(!empty($request['wright'])){
            $newUser->wright = $request['wright'];
            $newUser->save();
        }

        return $newUser;
    }

    public function updateUser(Request $request, $rocketID){
        $existingUser = appointedAgents::find($rocketID);

        if(!empty($request['aon'])){
            $existingUser->aon = $request['aon'];
            $existingUser->save();
        }

        if(!empty($request['beyond'])){
            $existingUser->beyond = $request['beyond'];
            $existingUser->save();
        }

        if(!empty($request['dual'])){
            $existingUser->dual = $request['dual'];
            $existingUser->save();
        }

        if(!empty($request['flow'])){
            $existingUser->flow = $request['flow'];
            $existingUser->save();
        }

        if(!empty($request['neptune'])){
            $existingUser->neptune = $request['neptune'];
            $existingUser->save();
        }

        if(!empty($request['palomar'])){
            $existingUser->palomar = $request['palomar'];
            $existingUser->save();
        }

        if(!empty($request['sterling'])){
            $existingUser->sterling = $request['sterling'];
            $existingUser->save();
        }

        if(!empty($request['wright'])){
            $existingUser->wright = $request['wright'];
            $existingUser->save();
        }

        return $existingUser;
    }
}
