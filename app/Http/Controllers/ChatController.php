<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Comment;

class ChatController extends Controller
{
    function getChat($table_name, $element_id){

        Log::info('ChatController:getChat');

        $data = DB::table('comments')
            ->Join('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.table_name', $table_name)
            ->where('comments.element_id', $element_id)
            ->select( 'comments.*','users.id as user_id', 'users.nick', 'users.name', 'users.surname')
            ->get();

        if($table_name == "global"){
            $name = "Global";
        }else {
            $name = DB::table($table_name)
                ->where('id', $element_id)
                ->value('name');
        }

        return view('chat', ['comments' => $data, 'name'=> $name, 'table_name' => $table_name, 'element_id' => $element_id]);

    }

    function getChatComments($table_name, $element_id){

        Log::info('ChatController:getChatComments');

        $data = DB::table('comments')
            ->Join('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.table_name', $table_name)
            ->where('comments.element_id', $element_id)
            ->select( 'comments.*', 'users.nick', 'users.name', 'users.surname')
            ->get();

        return view('chat-comments', ['comments' => $data]);

    }

    function addComment(Request $request){

        Log::info('ChatController:addComment');

        $comment = new Comments;
        $comment->user_id = Auth::user()->id;
        $comment->table_name = $request->table_name;
        $comment->element_id = $request->element_id;
        $comment->text = $request->text;
        $check = $comment->save();

        if(!$check){
            return response('Chyba při ukládání do databáze Comments!' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }

    }

    function removeComment(Request $request){

        if(Auth::permition()->edit_content != "1" && Comments::find($request->id)->user_id != Auth::user()->id){
            abort(401);
        }

        return Comments::find($request->id)->delete();

    }
}
