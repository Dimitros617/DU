<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Elements;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResultsController extends Controller
{
    function showFilesResults($id){
        Log::info('ResultsController:showFilesResults');

        $data = DB::table('results')
            ->Join('users', 'results.user_id', '=', 'users.id')
            ->where('element_id', '=', $id)
            ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.data', 'results.result', 'results.comments', 'results.updated_at')
            ->orderBy('results.updated_at','asc')
            ->get();

        return view('files-results', ['results' => $data, 'element_name' => Elements::find($id)->name]);
    }

    function addResult(Request $request){
        Log::info('ContentController:saveResult ');


        $data = $request->data;
        try {
            $data = json_encode($request->data);
        } catch (Exception $e) {

        }
        Log::info($data);
        $newID = DB::table('results')
            ->insertGetId([
                $request->column => $data,
                'user_id' => Auth::user()->id,
                'element_id' => $request->element_id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);

        $count = DB::table('results')
                ->where( 'user_id','=',  Auth::user()->id)
                ->where('element_id', '=', $request->element_id)
                ->count();


        $new = DB::table('results')
            ->where('id', $newID)
            ->value($request->column);


        $check = true;
        if($new != $request->data && json_encode($request->data) != $new){
            $check = false;
        }

        if(!$check) {
            return response('Nastala chyba při ukládání dat do tabulky: results', 500)->header('Content-Type', 'text/plain');
        }else{
            return $count;
        }
    }

    function showResult($id){

    }

    function showABCResults($id){
        Log::info('ResultsController:showABCResults');

//        $data = DB::table('results')
//            ->Join('users', 'results.user_id', '=', 'users.id')
//            ->where('element_id', '=', $id)
//            ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.data', 'results.result', 'results.comments', 'results.updated_at')
//            ->orderBy('results.updated_at','asc')
//            ->get();
//
//        return view('files-results', ['results' => $data, 'element_name' => Elements::find($id)-
        //TODO

        return 'TODO';
    }
}
