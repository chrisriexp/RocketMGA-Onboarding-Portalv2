<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileUpload;

class FileController extends Controller
{
    public function index(){
        return FileUpload::orderBy('created_at', 'DESC')->get();
    }

    public function upload(Request $request){
        
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $fileUpload = new FileUpload;

        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

            $fileUpload->userID = $request['userID'];
            $fileUpload->type = $request['type'];
            $fileUpload->name = time().'_'.$request->file->getClientOriginalName();
            $fileUpload->path = '/storage/' . $file_path;
            $fileUpload->save();

            /**return response()->json(['success'=>'File uploaded successfully.','id'=>$fileUpload->id, 'type'=>$fileUpload->type, 'name'=>$fileUpload->name, 'path'=>$fileUpload->path]); */
            return $fileUpload;
        }
    }

    public function getUser($id){
        $existingUser = FileUpload::find($id);

        return $existingUser;
    }
}
