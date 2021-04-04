<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\Chapters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChapterController extends Controller
{
    function showChapters($id)
    {

        Log::info('ChapterController:showChapters');

        $title_name = Books::find($id)->name;

        $data = DB::table('chapters')
            ->where('parent', $id)
            ->orderBy('position', 'asc')
            ->get();

        $check_locks = DB::table('locks')
            ->Join('users', 'locks.user_id', '=', 'users.id')
            ->Join('chapters', 'locks.element_id', '=', 'chapters.id')
            ->where('table_name', 'chapters')
            ->where('chapters.parent', $id)
            ->where('users.id', Auth::user()->id)
            ->select( 'locks.element_id', 'locks.locked')
            ->get();



        $lockController = new LockController();
        $request = new \Illuminate\Http\Request();
        $request->replace(['table_name' => 'books', 'id' => $id]);

        $checkLock = $lockController->checkLock($request);
        if($checkLock[0] != '1'){
            abort(401);
        }
        $history = new HistoryController;
        $history->log(Auth::user()->id, 'books', $id);

        return view('chapters', ['chapters' => $data, 'locked' => $check_locks, 'book' => $id, 'title_name' => $title_name]);

    }

    function showChapterResultMe($chapter_id, $result_id){
        return $this->showChapterResult($chapter_id, $result_id, Auth::user()->id);
    }

    function showChapterResult($chapter_id, $result_id, $user_id){

        Log::info('ChapterController:showChapterResult');

        $count = DB::table('results')
            ->where('user_id', $user_id)
            ->where('id', $result_id)
            ->orderBy('position', 'asc')
            ->count();

        if($count == 0 || (Auth::permition()->edit_content != "1" && $user_id != Auth::user()->id)){
            abort(401);
        }

        return $this->showChapter($chapter_id, 'results', $result_id, $user_id);
    }

    function showChapterEdit($id){
        Log::info('ChapterController:showChapterEdit');
        return $this->showChapter($id, 'edit');
    }

    function showChapter($id){

        Log::info('ChapterController:showChapter');

        $args = func_get_args();

        $edit = false;
        $test_results = false;
        $result_user = Auth::user()->id;
        $result_element = 'chapters_'.$id;
        $result_id = null;

        if(count($args)>1 ){
            for ($i = 1; $i < count($args); $i++) {
                if ($args[$i]=='edit') {
                    $edit = true;
                }
                if ($args[$i]=='results') {
                    $test_results = true;
                    $result_id = $args[++$i];
                    $result_user = $args[++$i];
                    $result_element = DB::table('results')
                        ->Join('elements', 'results.element_id', '=', 'elements.id')
                        ->where('results.id', '=', $result_id)
                        ->where('results.user_id','=', $result_user)
                        ->value('elements.data');
                    $result_element = str_replace(':','_',$result_element);
                }
            }

        }
        $title_name = Books::find((Chapters::find($id)->parent))->name;

        $data = DB::table('chapters')
            ->where('id', $id)
            ->orderBy('position', 'asc')
            ->get();

        $finished = DB::table('finished')
            ->where('user_id', Auth::user()->id)
            ->get();

        $results = DB::table('results')
            ->get();

        $big_boxes = DB::table('big_box')
            ->join('chapters', 'big_box.parent', '=', 'chapters.id')
            ->where('chapters.id', $id)
            ->select('big_box.id', 'big_box.name', 'big_box.description', 'big_box.img', 'big_box.security', 'big_box.key', 'big_box.position', 'big_box.style')
            ->orderBy('position', 'asc')
            ->get();

        $big_boxes_locks = DB::table('locks')
            ->Join('users', 'locks.user_id', '=', 'users.id')
            ->where('table_name', 'big_box')
            ->where('users.id', Auth::user()->id)
            ->select( 'locks.element_id', 'locks.locked')
            ->get();

        $middle_boxes = DB::table('middle_box')
            ->join('big_box', 'middle_box.parent', '=', 'big_box.id')
            ->join('chapters', 'big_box.parent', '=', 'chapters.id')
            ->where('chapters.id', $id)
            ->select('middle_box.id', 'middle_box.parent', 'middle_box.name', 'middle_box.description', 'middle_box.img', 'middle_box.security', 'middle_box.key', 'middle_box.position', 'middle_box.style')
            ->orderBy('position', 'asc')
            ->get();

        $middle_boxes_locks = DB::table('locks')
            ->Join('users', 'locks.user_id', '=', 'users.id')
            ->where('table_name', 'middle_box')
            ->where('users.id', Auth::user()->id)
            ->select( 'locks.element_id', 'locks.locked')
            ->get();

        $elements = DB::table('elements')
            ->join('middle_box', 'elements.parent', '=', 'middle_box.id')
            ->join('element_types', 'elements.type', '=', 'element_types.id')
            ->join('big_box', 'middle_box.parent', '=', 'big_box.id')
            ->join('chapters', 'big_box.parent', '=', 'chapters.id')
            ->where('chapters.id', $id)
            ->select('elements.id', 'elements.parent', 'elements.name', 'elements.description', 'elements.url', 'elements.security', 'elements.key', 'elements.position', 'elements.style', 'elements.type', 'elements.data_json', 'elements.data', 'elements.data1', 'elements.data2', 'elements.correct', 'elements.correct_json', 'elements.created_at', 'elements.updated_at', 'element_types.blade')
            ->orderBy('position', 'asc')
            ->get();


        $elements_locks = DB::table('locks')
            ->Join('users', 'locks.user_id', '=', 'users.id')
            ->where('table_name', 'elements')
            ->where('users.id', Auth::user()->id)
            ->select( 'locks.element_id', 'locks.locked')
            ->get();

        if($test_results) {
            $elements_results = DB::table('results')
                ->where('user_id','=', $result_user)
                ->where('data','=', $result_id)
                ->orderBy('element_id', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();
        }else{
            $elements_results = null;
        }


        $data = $data[0];


        //TODO zde mazat záznamy starší jak měsíc u každého člověka z historie vstupu

        $lockController = new LockController();
        $request = new \Illuminate\Http\Request();
        $request->replace(['table_name' => 'chapters', 'id' => $id]);

        $checkLock = $lockController->checkLock($request);
        if($checkLock[0] != '1'){
            abort(401);
        }

        $history = new HistoryController;
        $history->log(Auth::user()->id, 'chapters', $id);

        return view('chapter',
            ['chapter' => $data,
            'big_boxes' => $big_boxes,
            'middle_boxes' => $middle_boxes,
            'big_boxes_locks' => $big_boxes_locks,
            'middle_boxes_locks' => $middle_boxes_locks,
            'elements' => $elements,
            'elements_locks' => $elements_locks,
            'elements_results' => $elements_results,
            'finished' => $finished,
            'results' => $results,
            'result_element' => $result_element,
            'edit' => $edit,
            'test_results' => $test_results,
            'title_name' => $title_name
            ]);

    }


    function addChapter(Request $request){

        Log::info('ChapterController:addChapter');

        $position = DB::table('chapters')
            ->where('parent', $request->id)
            ->orderBy('position', 'desc')
            ->first();

        if($position == "") {
            $position = 1;
        }else{
            $position = ($position->position)+1;
        }

        $chapter = new Chapters;
        $chapter->parent = $request->id;
        $chapter->position = $position;
        $check = $chapter->save();

        return back();
    }



    function getStatus($id)
    {
        Log::info('ChapterController:getStatus');

        $data = DB::table('histories')
            ->Join('users', 'histories.user_id', '=', 'users.id')
            ->where('histories.table_name', '=', 'chapters')
            ->where('histories.element_id', '=', $id)
            ->select( DB::raw('users.name'),DB::raw('users.surname'), DB::raw('MAX(histories.created_at) as last'),  DB::raw('COUNT(histories.element_id) as entry'), 'histories.user_id')
            ->groupBy('histories.element_id','histories.user_id')
            ->orderBy('histories.created_at','desc')
            ->get();

        foreach ($data as $dat){
            $lock = DB::table('locks')
                ->where('table_name', '=', 'chapters')
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
                ->where('elements.data', '=', ('chapters:'.$id))
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
