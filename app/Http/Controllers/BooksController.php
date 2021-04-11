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

        $position = DB::table('books')
            ->orderBy('position', 'desc')
            ->first();

        if($position == "") {
            $position = 1;
        }else{
            $position = ($position->position)+1;
        }

        $book = new Books;
        $book->position = $position;
        $check = $book->save();

        return back();
    }



    function getStatus($id)
    {
        Log::info('BooksController:getStatus');

        $data = DB::table('histories')
            ->Join('users', 'histories.user_id', '=', 'users.id')
            ->where('histories.table_name', '=', 'books')
            ->where('histories.element_id', '=', $id)
            ->select( DB::raw('users.name'),DB::raw('users.surname'), DB::raw('MAX(histories.created_at) as last'),  DB::raw('COUNT(histories.element_id) as entry'), 'histories.user_id')
            ->groupBy('histories.element_id','histories.user_id')
            ->orderBy('histories.created_at','desc')
            ->get();

        foreach ($data as $dat){
            $lock = DB::table('locks')
                ->where('table_name', '=', 'books')
                ->where('element_id', '=', $id)
                ->where('user_id', '=', $dat->user_id)
                ->get();

            if(count($lock) != 0){
                $dat->locked = $lock[0]->locked;
                $dat->lockedDate = $lock[0]->created_at;
            }else{
                $dat->locked = null;
            }


            $finish = DB::table('finished')
                ->Join('elements', 'finished.element_id', '=', 'elements.id')
                ->where('elements.data', '=', ('books:'.$id))
                ->where('finished.user_id', '=', $dat->user_id)
                ->get();

            if(count($finish) != 0){
                $dat->finish = $finish[0]->created_at;
            }else{
                $dat->finish = null;
            }

        }


        return view('status', ['data' => $data]);
    }
}
