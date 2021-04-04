<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Big_box;
use App\Models\Books;
use App\Models\Chapters;
use App\Models\Elements;
use App\Models\Middle_box;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\throwException;

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
        Log::info('ResultsController:addResult ');


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
            return ['count' => $count, 'id' => $newID];
        }
    }

    function addTestResult(Request $request){
        Log::info('ResultsController:addTestResult ');




        $correct = DB::table('elements')
            ->where('id', $request->element_id)
            ->get()[0];

        $data_json = $request->data_json;
        $json_count = count($data_json);
        try {
            $data_json = json_encode($request->data_json);
        } catch (Exception $e) {
        }

        Log::info($correct->data_json);
        Log::info($data_json);
        Log::info(count(array_diff_assoc(str_split($correct->data_json), str_split($data_json))));

        $bad = (count(array_diff_assoc(str_split($correct->data_json), str_split($data_json))));
        $ok = (($json_count/2)- $bad);



        Log::info('OK: ' . $ok . " x ". intval($correct->data) . " BAD: " . $bad . " x ". intval($correct->data1));
        $bad *=  intval($correct->data1);
        $ok *= intval($correct->data);
        Log::info('OK: ' . $ok . " x ". intval($correct->data) . " BAD: " . $bad . " x ". intval($correct->data1));

        $result = ($ok + $bad) . "/" . (($json_count/2)) * intval($correct->data);
        Log::info('vysledek: ' . $result);




        $newID = DB::table('results')
            ->insertGetId([
                'data' => $request->data,
                'data_json' => $data_json,
                'user_id' => Auth::user()->id,
                'element_id' => $request->element_id,
                'result' => $result,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);

        $count = DB::table('results')
            ->where( 'user_id','=',  Auth::user()->id)
            ->where('element_id', '=', $request->element_id)
            ->count();


        $new = DB::table('results')
            ->where('id', $newID)
            ->value('data');


        $check = true;
        if($new != $request->data){
            $check = false;
        }

        if(!$check) {
            return response('Nastala chyba při ukládání dat do tabulky: results', 500)->header('Content-Type', 'text/plain');
        }else{
            return ['count' => $count, 'id' => $newID, 'result' => $result];
        }
    }

    public static function getAllTestResultsFrom($table_name, $id){

        Log::info('ResultsController:getAllTestResultsFrom ' . $table_name . " " . $id);

        switch ($table_name) {
            case 'elements':
                return Elements::getAllTestsResultsFrom($id);
            case 'middle_box':
                return Middle_box::getAllTestsResultsFrom($id);
            case 'big_box':
                return Big_box::getAllTestsResultsFrom($id);
            case 'chapters':
                return Chapters::getAllTestsResultsFrom($id);
            case 'books':
                return Books::getAllTestsResultsFrom($id);
            default:
                throwException('Neznámý typ objektu');
//                alert(500);

        }
    }

    function showResults($id, $element_id){

        Log::info('ResultsController:showResult ');

        if(Auth::permition()->edit_content != "1") {
            $data = DB::table('results')
                ->join('users', 'results.user_id', '=', 'users.id')
                ->where('element_id', '=', $element_id)
                ->where('users.id', Auth::user()->id)
                ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.user_id', 'results.element_id', 'results.data_json', 'results.data', 'results.result', 'results.comments', 'results.created_at', 'results.updated_at')
                ->orderBy('created_at', 'desc')
                ->get();
        }else{
            $data = DB::table('results')
                ->join('users', 'results.user_id', '=', 'users.id')
                ->where('element_id', '=', $element_id)
                ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.user_id', 'results.element_id', 'results.data_json', 'results.data', 'results.result', 'results.comments', 'results.created_at', 'results.updated_at')
                ->orderBy('user_id', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        foreach ($data as $dat){
            if($dat->result == null){
                $results = DB::table('results')
                    ->where('data', '=', $dat->id)
                    ->get();

                $ok = 0;
                $max = 0;
                foreach ($results as $result){
                    $ok += intval(explode('/',$result->result)[0]);
                    $max += intval(explode('/',$result->result)[1]);
                }
                $dat->result = $ok . "/" . $max;
                DB::table('results')
                    ->where('id', $dat->id)
                    ->update(['result' => ($ok . "/" . $max)]);
            }
        }

        return view('test-results', ['results' => $data, 'element_name' => Chapters::find($id)->name, 'chapter_id' => $id]);

    }

    function showAllResults($id){

        Log::info('ResultsController:showResult ');

        if(Auth::permition()->edit_content != "1") {
            $data = DB::table('results')
                ->join('users', 'results.user_id', '=', 'users.id')
                ->join('elements', 'results.element_id', '=', 'elements.id')
                ->join('element_types', 'elements.type', '=', 'element_types.id')
                ->join('middle_box', 'elements.parent', '=', 'middle_box.id')
                ->join('big_box', 'middle_box.parent', '=', 'big_box.id')
                ->join('chapters', 'big_box.parent', '=', 'chapters.id')
                ->where('chapters.id', $id)
                ->where('results.data',  'like', '%test%')
                ->where('users.id', Auth::user()->id)
                ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.user_id', 'results.element_id', 'results.data_json', 'results.data', 'results.result', 'results.comments', 'results.created_at', 'results.updated_at')
                ->orderBy('created_at', 'desc')
                ->get();
        }else{
            $data = DB::table('results')
                ->join('users', 'results.user_id', '=', 'users.id')
                ->join('elements', 'results.element_id', '=', 'elements.id')
                ->join('element_types', 'elements.type', '=', 'element_types.id')
                ->join('middle_box', 'elements.parent', '=', 'middle_box.id')
                ->join('big_box', 'middle_box.parent', '=', 'big_box.id')
                ->join('chapters', 'big_box.parent', '=', 'chapters.id')
                ->where('results.data',  'like', '%test%')
                ->where('chapters.id', $id)
                ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.user_id', 'results.element_id', 'results.data_json', 'results.data', 'results.result', 'results.comments', 'results.created_at', 'results.updated_at')
                ->orderBy('user_id', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        foreach ($data as $dat){
            if($dat->result == null){
                $results = DB::table('results')
                    ->where('data', '=', $dat->id)
                    ->get();

                $ok = 0;
                $max = 0;
                foreach ($results as $result){
                    $ok += intval(explode('/',$result->result)[0]);
                    $max += intval(explode('/',$result->result)[1]);
                }
                $dat->result = $ok . "/" . $max;
                DB::table('results')
                    ->where('id', $dat->id)
                    ->update(['result' => ($ok . "/" . $max)]);
            }
        }

        return view('test-results', ['results' => $data, 'element_name' => Chapters::find($id)->name, 'chapter_id' => $id]);

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
