<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Big_box;
use App\Models\Books;
use App\Models\Chapters;
use App\Models\Elements;
use App\Models\Files;
use App\Models\Finished;
use App\Models\Images;
use App\Models\Middle_box;
use App\Models\Results;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use League\Flysystem\File;
use phpDocumentor\Reflection\Element;
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

    function getImagesSelector(Request $request){

        Log::info('ContentController:getElementsSelector');
        $data = DB::table('images')->get();
        return view('images-selector', ['images' => $data]);
    }

    function getImagesSelectorGallery(){

        Log::info('ContentController:getImagesSelectorGallery');
        $data = DB::table('images')->get();
        return view('images-selector-gallery', ['images' => $data]);
    }

    function getFileSelector(Request $request){

        Log::info('ContentController:getFileSelector');
        $data = DB::table('files')->get();
        return view('files-selector', ['files' => $data]);
    }

    function getFileSelectorGallery(){

        Log::info('ContentController:getFileSelectorGallery');
        $data = DB::table('files')->get();
        return view('files-selector-gallery', ['files' => $data]);
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
            $img_name = $request->file('img')->getClientOriginalName();
//            $img_path = Carbon::now()->toDateTimeString().'.'.$img_type;
            request()->img->move(public_path('/user_files'), $img_name);
            $img_name = '/user_files/'.$img_name;
        }

        $img = new Images;
        $img->url = $img_name;
        $check = $img->save();

        if(!$check){
            return response('Chyba při ukládání do databáze Images!' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }
    }

    function addImage(Request $request){

        Log::info('ContentController:addImage');

        $img = new Images;
        $img->url = $request->url;
        $check = $img->save();

        if(!$check){
            return response('Chyba při ukládání do databáze Images!' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }
    }

    function addFile(Request $request){

        Log::info('ContentController:addFile');

        $file = new Files;
        $file->url = $request->url;
        $file->name = $request->url;
        $file->owner = Auth::user()->id;
        $check = $file->save();

        if(!$check){
            return response('Chyba při ukládání do databáze Files!' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }
    }

    function saveFile(Request $request){

        Log::info('ContentController:saveFile');

        if($request->file != "") {
            $validatedData = $request->validate([
                'file' => 'required|max:40960',
            ]);


            $file_name = $request->file('file')->getClientOriginalName();
            $original_file_name = $file_name;
            request()->file->move(public_path('/data'), $file_name);
            $file_name = '/data/'.$file_name;
        }

        $file = new Files;
        $file->url = $file_name;
        $file->name = $original_file_name;
        $file->owner = Auth::user()->id;
        $check = $file->save();

        if(!$check){
            return response('Chyba při ukládání do databáze Files!' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }
    }

    function saveFileResult(Request $request){

        Log::info('ContentController:saveFileResult');

        if($request->file != "") {
            $validatedData = $request->validate([
                'file' => 'required|max:40960',
            ]);


            $file_name = $request->file('file')->getClientOriginalName();
            $original_file_name = $file_name;
            request()->file->move(public_path('/data/results'), $file_name);
            $file_name = '/data/results/'.$file_name;
        }

        $data = DB::table('results')
            ->where('user_id', '=', Auth::user()->id)
            ->where('element_id', '=', $request->element_id)
            ->get();

        if(count($data) != 0){
            Results::find($data[0]->id)->delete();
        }

        $file = new Results;
        $file->data = $file_name;
        $file->element_id = $request->element_id;
        $file->user_id = Auth::user()->id;
        $check = $file->save();

        if(!$check){
            return response('Chyba při ukládání do databáze Results!' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }
        return $original_file_name;
    }

    function removeFile(Request $request){

        Log::info('ContentController:removeFile ');

        $file = Files::find($request->id);

        if (is_file(public_path($file->url))) {
            $check = unlink(public_path($file->url));
            if(!$check){
                return response('Chyba při mazání souboru ze složky! v databázi ale nadále zůstal.' . $request->table_name, 500)->header('Content-Type', 'text/plain');
            }
        }

        $check = Files::find($request->id)->delete();

        if(!$check){
            return response('Chyba při mazání z databáze, ale fyzicky se soubor vymazal správně!' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }

    }

    function removeImage(Request $request){

        Log::info('ContentController:removeImage ');

        $img = Images::find($request->id);

        if (is_file(public_path($img->url))) {
            $check = unlink(public_path($img->url));
            if(!$check){
                return response('Chyba při mazání souboru ze složky! v databázi ale nadále zůstal.' . $request->table_name, 500)->header('Content-Type', 'text/plain');
            }
        }

        $check = Images::find($request->id)->delete();

        if(!$check){
            return response('Chyba při mazání z databáze, ale fyzicky se obrázek vymazal správně!' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }

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


        if($new != $request->name){
            return response('Nastal problém při ukládání dat do databáze!' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }

        return   "1";
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

    function saveColumn(Request $request){

        Log::info('ContentController:saveColumn ');

        DB::table($request->table_name)
            ->where('id', $request->id)
            ->update([$request->column => $request->data]);

        $new = DB::table($request->table_name)
            ->where('id', $request->id)
            ->value($request->column);


        $check = true;
        if($new != $request->data && json_encode($request->data) != $new){
            $check = false;
        }

        if(!$check) {
            return response('Nastala chyba při ukládání dat do tabulky: ' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }
    }



    function saveFinished(Request $request){

        Log::info('ContentController:saveFinished');

        DB::table($request->table_name)
            ->where('id', $request->id)
            ->update([$request->column => $request->data]);

        $new = DB::table($request->table_name)
            ->where('id', $request->id)
            ->value($request->column);


        $check = true;
        if($new != $request->data){
            $check = false;
        }

        DB::table('finished')
            ->Join('elements', 'finished.element_id', '=', 'elements.id')
            ->where('elements.id', $request->id)
            ->delete();


        if(!$check) {
            return response('Nastala chyba při ukládání dat do tabulky: ' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }
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

    function removeElement(Request $request)
    {
        Log::info('ContentController:removeElement');

        $check = true;

        switch ($request->table_name) {
            case 'elements':
                $check = Elements::deleteHard($request->id);
                Log::info('Delete elements: ' . $check);
                break;
            case 'middle_box':
                $check = Middle_box::deleteHard($request->id);
                Log::info('Delete middle_box: ' . $check);
                break;
            case 'big_box':
                $check = Big_box::deleteHard($request->id);
                Log::info('Delete big_box');
                break;
            case 'chapters':
                $check = Chapters::deleteHard($request->id);
                Log::info('Delete chapters');
                break;
            case 'books':
                $check = Books::deleteHard($request->id);
                Log::info('Delete books');
                break;
            case 'results':
                $check = Results::tryDeleteTests($request->id);
                Log::info('Delete results');
                break;
        }

        if(!$check) {
            return response('Nastala chyba při ukládání dat do tabulky: ' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }
    }

    function finishElement(Request $request){

        $fin = new Finished;
        $fin->element_id = $request->id;
        $fin->user_id = Auth::user()->id;
        $check = $fin->save();

        if(!$check) {
            return response('Nastala chyba při vkladání dat do databáze, tabulka Finished', 500)->header('Content-Type', 'text/plain');
        }
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
