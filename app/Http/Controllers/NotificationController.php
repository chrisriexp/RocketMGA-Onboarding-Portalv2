<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;

class NotificationController extends Controller
{
    public function index(){
        return Notifications::orderBy('created_at', 'DESC')->get();
    }

    public function add(Request $request){
        $newNoti = new Notifications;
        $newNoti->agency = $request['agency'];
        $newNoti->agency_id = $request['agency_id'];
        $newNoti->save();

        return $newNoti;
    }

    public function read($id){
        $existingNoti = Notifications::find($id);
        $existingNoti->read = true;
        $existingNoti->save();

        return $existingNoti;
    }
}
