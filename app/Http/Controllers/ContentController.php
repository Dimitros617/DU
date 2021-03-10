<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class ContentController extends Controller
{
    function saveImage(Request $request){

        Log::info('ContentController:saveImage');

        if($request->chapter_img != "") {
            $validatedData = $request->validate([
                'chapter_img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            $img_type = $request->file('chapter_img')->getClientOriginalExtension();
            $path = request()->chapter_img->move(public_path('/user_files'), 'chapter_img_'.$request->chapter_id.'.'.$img_type);
        }




        $chapter = Chapters::find($request->chapter_id);
        $chapter->name = $request->chapter_name;
        if($request->chapter_img != "") {
        $chapter->chapter_img = 'chapter_img_'.$request->chapter_id.'.'.$img_type;
        }
        $img_save = $chapter->chapter_img;
        $check = $chapter->save();

        return  $check ? array('1',$img_save) : array('0');
    }
}
