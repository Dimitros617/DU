<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\Chapters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BooksController extends Controller
{


    function addBook(){

        Log::info('BooksController:addBook');

        $book = new Books;
        $check = $book->save();

        return back();
    }



    function statusChapter(Request $request)
    {
        Log::info('ChapterController:statusChapter');

        $check = true;

        //TODO předat data o stavu žáků nad kapitolou

        return view('chapter-status', ['data' => array('James','Dominik','Lukas','Viol')]);
    }
}
