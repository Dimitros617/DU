<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChapterController extends Controller
{
    function addChapter(){

        Log::info('ChapterController:addChapter');

        $chapter = new Chapters;
        $check = $chapter->save();

        return back()->withInput(array('saveCheck' => $check ? '1' : '0'));
    }
}
