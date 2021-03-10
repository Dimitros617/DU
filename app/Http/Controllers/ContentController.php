<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;


class ContentController extends Controller
{
    function saveImage(Request $request){

        Log::info('ContentController:saveImage');

        $validatedData = $request->validate([
            'chapter_img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);


        $img_type = $request->file('chapter_img')->getClientOriginalExtension();


        $path = request()->chapter_img->move(public_path('/user_files'), 'chapter_img_'.$request->chapter_id.'.'.$img_type);


        $chapter = Chapters::find($request->chapter_id);
        $chapter->name = $request->chapter_name;
        $chapter->chapter_img = 'chapter_img_'.$request->chapter_id.'.'.$img_type;
        $check = $chapter->save();

        return  $check ? array('1','chapter_img_'.$request->chapter_id.'.'.$img_type) : array('0');
    }
}
