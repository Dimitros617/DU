<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChapterController extends Controller
{

    function showChapter($id){

        $data = DB::table('chapters')->where('id', $id)->get();


        $data = $data[0];

        return view('chapter', ['chapter' => $data]);

    }


    function addChapter(){

        Log::info('ChapterController:addChapter');

        $chapter = new Chapters;
        $check = $chapter->save();

        return back();
    }

    function removeChapter(Request $request)
    {
        Log::info('ChapterController:removeChapter');

            $check = true;
            //$check = DB::table('categories')->where('id', $request->id)->delete();

        //TODO dodělat smazání z databáze + obrázek

            return $check ? "1" : "0";
    }

    function statusChapter(Request $request)
    {
        Log::info('ChapterController:statusChapter');

        $check = true;

        //TODO předat data o stavu žáků nad kapitolou

        return view('chapter-status', ['data' => array('James','Dominik','Lukas','Viol')]);
    }

}
