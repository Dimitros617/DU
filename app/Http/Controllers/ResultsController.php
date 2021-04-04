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
use stdClass;
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


    function showABCResults($element_id){
        Log::info('ResultsController:showABCResults');


        $graph_data = DB::table('results')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->where('results.element_id', '=', $element_id)
            ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.user_id', 'results.element_id', 'results.data_json', 'results.data', 'results.result', 'results.comments', 'results.created_at' )
            ->groupBy('results.user_id')
            ->orderBy('results.user_id', 'asc')
            ->orderBy('results.created_at', 'desc')
            ->get();


        $graph = null;
        if(count($graph_data) != 0 ) {
            $graph = new stdClass();
            $graph->count = count($graph_data);

            $a_count = 0;
            $b_count = 0;
            $c_count = 0;
            foreach ($graph_data as $results) {
                $data_json = json_decode($results->data_json);

                $graph->a_text = $data_json->a_text;
                $graph->b_text = $data_json->b_text;
                $graph->c_text = $data_json->c_text;

                if($data_json->a_result == "1"){
                    $a_count++;
                }

                if($data_json->b_result == "1"){
                    $b_count++;
                }

                if($data_json->c_result == "1"){
                    $c_count++;
                }
            }
            $graph->a_result = $a_count;
            $graph->b_result = $b_count;
            $graph->c_result = $c_count;

        }

        if(Auth::permition()->edit_content != "1") {
            $data = DB::table('results')
                ->join('users', 'results.user_id', '=', 'users.id')
                ->where('results.element_id', '=', $element_id)
                ->where('users.id', Auth::user()->id)
                ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.user_id', 'results.element_id', 'results.data_json', 'results.data', 'results.result', 'results.comments', 'results.created_at', 'results.updated_at')
                ->orderBy('created_at', 'desc')
                ->get();
        }else{
            $data = DB::table('results')
                ->join('users', 'results.user_id', '=', 'users.id')
                ->where('results.element_id', '=', $element_id)
                ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.user_id', 'results.element_id', 'results.data_json', 'results.data', 'results.result', 'results.comments', 'results.created_at', 'results.updated_at')
                ->orderBy('user_id', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        foreach ($data as $dat){

                $data_json =  json_decode($dat->data_json);
                $data_json_correct = json_decode(Elements::find($dat->element_id)->data_json);

                $dat->a_text = $data_json->a_text;
                $dat->b_text = $data_json->b_text;
                $dat->c_text = $data_json->c_text;

                $dat->a_result_val = $data_json->a_result;
                $dat->b_result_val = $data_json->b_result;
                $dat->c_result_val = $data_json->c_result;

                if($data_json->a_result == $data_json_correct->a_result){
                    $dat->a_result = true;
                }else{
                    $dat->a_result = false;
                }

                if($data_json->b_result == $data_json_correct->b_result){
                    $dat->b_result = true;
                }else{
                    $dat->b_result = false;
                }

                if($data_json->c_result == $data_json_correct->c_result){
                    $dat->c_result = true;
                }else{
                    $dat->c_result = false;
                }

        }


        return view('test-abc-results', ['results' => $data, 'graph' => $graph]);

    }
}
