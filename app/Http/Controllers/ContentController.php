<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class ContentController extends Controller
{
    function saveImage(Request $request){

        Log::info('ContentController:saveImage');

        if($request->img != "") {
            $validatedData = $request->validate([
                'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:4092',
            ]);

            $img_type = $request->file('img')->getClientOriginalExtension();
            $img_path = $request->table_name.'_xxx_'.$request->id.'.'.$img_type;
            request()->img->move(public_path('/user_files'), $img_path);
        }

        DB::table($request->table_name)->where('id', $request->id)->update(['img' => $img_path]);

        $new_img = DB::table($request->table_name)->where('id', $request->id)->get();
        $new_img = $new_img[0]->img;

        $check = true;
        if($new_img != $img_path){
            $check = false;
        }

        return  $check ? array('1',$img_path) : array('0');
    }

    function saveName(Request $request){

        Log::info('ContentController:saveName');

        if(strlen($request->name) > 50){
            Log::info('Yep');
            return response('Jméno nesmí být delší jak 50 znaků!' . $request->table_name, 500)->header('Content-Type', 'text/plain');

        }

        DB::table($request->table_name)->where('id', $request->id)->update(['name' => $request->name]);

        $new = DB::table($request->table_name)->where('id', $request->id)->get();
        $new = $new[0]->name;

        $check = true;
        if($new != $request->name){
            $check = false;
        }

        return  $check ? "1" : "0";
    }
}
