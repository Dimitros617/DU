<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChapterController extends Controller
{
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

    function ruleChapter(Request $request)
    {
        Log::info('ChapterController:ruleChapter');

        $chapter = Chapters::find($request->id);

        return view('lock-setting', ['chapter' => $chapter]);
    }
}
