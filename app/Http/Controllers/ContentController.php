<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Big_box;
use App\Models\Chapters;
use App\Models\Middle_box;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class ContentController extends Controller
{
    function editSetting(Request $request){

        Log::info('ContentController:editSetting');

        return view('edit-setting', ['data' => $request]);
    }

    function getElementsSelector(Request $request){

        Log::info('ContentController:getElementsSelector');
        $data = DB::table('element_types')->get();
        return view('elements-selector', ['elements' => $data, 'data' => $request]);
    }

    function saveSetting(Request $request){

        $check = DB::table($request->table_name)
                ->where('id', $request->id)
                ->update(['name' => $request->name, 'description' => $request->description, 'style' => $request->style]);

        if($request->src != null){
            $check = DB::table($request->table_name)
                ->where('id', $request->id)
                ->update(['url' => $request->src]);
        }

        if($request->data != null){
            $check = DB::table($request->table_name)
                ->where('id', $request->id)
                ->update(['data' => $request->data]);
        }

        if($request->data1 != null){
            $check = DB::table($request->table_name)
                ->where('id', $request->id)
                ->update(['data1' => $request->data1]);
        }

        if($request->data2 != null){
            $check = DB::table($request->table_name)
                ->where('id', $request->id)
                ->update(['data2' => $request->data2]);
        }

        if($request->results != null){
            $check = DB::table($request->table_name)
                ->where('id', $request->id)
                ->update(['results' => $request->results]);
        }

        if(!$check) {
            return response('Nastala chyba při ukládání dat do tabulky: ' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }
    }

    function saveImage(Request $request){

        Log::info('ContentController:saveImage');

        if($request->img != "") {
            $validatedData = $request->validate([
                'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:4092',
            ]);

            $img_type = $request->file('img')->getClientOriginalExtension();
            $img_path = $request->table_name.'_'.$request->id.'.'.$img_type;
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
            return response('Jméno nesmí být delší jak 50 znaků!' . $request->table_name, 500)->header('Content-Type', 'text/plain');

        }

        DB::table($request->table_name)
            ->where('id', $request->id)
            ->update(['name' => $request->name]);

        $new = DB::table($request->table_name)
            ->where('id', $request->id)
            ->get();

        $new = $new[0]->name;

        $check = true;
        if($new != $request->name){
            $check = false;
        }

        return  $check ? "1" : "0";
    }

    function saveDescription(Request $request){

        Log::info('ContentController:saveDescription');

        if(strlen($request->description) > 1024){
            return response('Popisek nesmí být delší jak 1024 znaků!' . $request->table_name, 500)->header('Content-Type', 'text/plain');

        }

        DB::table($request->table_name)
            ->where('id', $request->id)
            ->update(['description' => $request->description]);

        $new = DB::table($request->table_name)
            ->where('id', $request->id)
            ->get();
        $new = $new[0]->description;

        $check = true;
        if($new != $request->description){
            $check = false;
        }

        return  $check ? "1" : "0";
    }

    function addElement(Request $request){

        Log::info('ContentController:addElement');

        $position = DB::table($request->table_name)
            ->where('parent', $request->id)
            ->orderBy('position', 'desc')
            ->first();

        if($position == "") {
            $position = 1;
        }else{
            $position = ($position->position)+1;
        }

        if($request->type == null) {

            $check = DB::table($request->table_name)->insert([
                'parent' => $request->id,
                'position' => $position,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
        else{
            $check = DB::table($request->table_name)->insert([
                'parent' => $request->id,
                'type' => $request->type,
                'position' => $position,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }


        return  $check ? "1" : response('Nastala chyba při vytváření nového záznamu v databázi tabulka: ' . $request->table_name, 500)->header('Content-Type', 'text/plain');

    }


    function move(Request $request){

        Log::info('ContentController:move');

        $temp = DB::table($request->table_name)
            ->where('id', $request->id)
            ->get();

        $parent_id = $temp[0]->parent;
        $position = $temp[0]->position;

        $last = DB::table($request->table_name)
            ->where('parent', $parent_id)
            ->orderBy('position', 'desc')
            ->first()->position;

        Log::info('id: ' .  $request->id . ' | rodic: ' . $parent_id . ' | pozice: ' . $position . ' | posledni: ' . $last);

        if($position == 1 && $request->direction == "up"){
            return  response('Výš už to bohužel nepůjde! Dosáhli jste vrcholu!', 500)->header('Content-Type', 'text/plain');
        }

        if($position == $last && $request->direction == "down"){
            return  response('Níž už to bohužel nepůjde! "Už jste úplně na dně!', 500)->header('Content-Type', 'text/plain');
        }

        $data = DB::table($request->table_name)
            ->where('parent', $parent_id)
            ->orderBy('position', 'asc')
            ->get();

        if($request->direction == "up"){

            $new_position = DB::table($request->table_name)
                ->where('parent', $parent_id)
                ->where('position', ($position-1))
                ->get()[0]->id;

            $old_position = DB::table($request->table_name)
                ->where('parent', $parent_id)
                ->where('position', $position)
                ->update(['position' => ($position-1)]);

            $new_position = DB::table($request->table_name)
                ->where('id', $new_position)
                ->update(['position' => ($position)]);

        }else{

            $new_position = DB::table($request->table_name)
                ->where('parent', $parent_id)
                ->where('position', ($position+1))
                ->get()[0]->id;

            $old_position = DB::table($request->table_name)
                ->where('parent', $parent_id)
                ->where('position', $position)
                ->update(['position' => ($position+1)]);

            $new_position = DB::table($request->table_name)
                ->where('id', $new_position)
                ->update(['position' => ($position)]);


        }

        return  $new_position && $old_position ? "1" : response('Nastala chyba při přesouvání elementu!', 500)->header('Content-Type', 'text/plain');

    }
}
