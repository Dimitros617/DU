<?php

namespace App\Http\Controllers;

use App\Models\Big_box;
use App\Models\Books;
use App\Models\Chapters;
use App\Models\Elements;
use App\Models\Locks;
use App\Models\Middle_box;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LockController extends Controller
{
    function ruleSetting(Request $request)
    {
        Log::info('LockController:ruleSetting');



        switch ($request->table_name) {
            case 'books':
                $data = Books::find($request->id);
                $options = DB::table('chapters')->get();
                $table = array('books','Učebnice');
                break;
            case 'chapters':
                $data = Chapters::find($request->id);
                $options = DB::table('chapters')->get();
                $table = array('chapters','Kapitola');
                break;
            case 'big_box':
                $data = Big_box::find($request->id);
                $options = DB::table('big_box')->get();
                $table = array('big_box','Velký box');
                break;
            case 'middle_box':
                $data = Middle_box::find($request->id);
                $options = DB::table('middle_box')->get();
                $table = array('middle_box','Box');
                break;
            case 'elements':
                $data = Elements::find($request->id);
                $options = DB::table('elements')->get();
                $table = array('elements','Element');
                break;
            default:
                return response('Zadán špatný název tabulky prvku!' . $request->table_name, 500)->header('Content-Type', 'text/plain');

        }

        Log::info($options);
        return view('lock-setting', ['data' => $data, 'table' => $table, 'options' => $options]);
    }

    function saveRule(Request $request)
    {
        Log::info('LockController:ruleSetting');

        $data = DB::table($request->table_name)
            ->where('id', $request->id)->get();

        if($data[0]->key == $request->key && $data[0]->security == $request->key_type  ){
            return "1";
        }

        $check = DB::table($request->table_name)
            ->where('id', $request->id)
            ->update(['key' => $request->key, 'security' => $request->key_type, 'updated_at' => Carbon::now()->toDateTimeString()]);

        if(!$check){
            return response('Nastal problém při ukládání dat do tabulky' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }

        return $check ? "1" : "0";

    }

    /**
     * @param Request $request  string type = název tabulky ve kterém je zamčený element | id = id zamčeného elementu
     * @return 1 = přístup povolen | 0 = zamčeno zkus zadat klíč
     */
    function checkLock(Request $request)
    {
        Log::info('LockController:checkLock ');

        if(Auth::permition()->edit_content == "1"){
            return array("1");
        }


        $check_data = DB::table($request->table_name)
            ->where('id', $request->id)
            ->get();

        if(count($check_data) == 0 && count($check_data) > 1){
            return response('Duplicitní položky v tabulce ' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }

        if($check_data[0]->security == 'empty' || $check_data[0]->security == null){
            return array("1");
        }



        $check_locks = DB::table('locks')
            ->Join('users', 'locks.user_id', '=', 'users.id')
            ->where('table_name', $request->table_name)
            ->where('element_id', $request->id)
            ->where('users.id', Auth::user()->id)
            ->select('locks.table_name', 'locks.element_id', 'locks.locked', 'locks.created_at', 'locks.updated_at')
            ->get();

        if(count($check_locks) == 0){
            $lock = new Locks;
            $lock->table_name = $request->table_name;
            $lock->element_id = $request->id;
            $lock->user_id = Auth::user()->id;
            $lock->locked = "1";
            $lock->created_at = Carbon::now()->toDateTimeString();
            $lock->updated_at = $check_data[0]->updated_at;
            $check_lock = $lock->save();

            $check_locks = DB::table('locks')
                ->Join('users', 'locks.user_id', '=', 'users.id')
                ->where('table_name', $request->table_name)
                ->where('element_id', $request->id)
                ->where('users.id', Auth::user()->id)
                ->select('locks.table_name', 'locks.element_id', 'locks.locked', 'locks.created_at', 'locks.updated_at')
                ->get();


            if(!$check_lock) {
                return response('Došlo k problému při načítání dat z tabulky locks ' . $request->table_name, 500)->header('Content-Type', 'text/plain');
            }

        }elseif(count($check_locks) > 1){
            return response('Duplicitní položky v tabulce locks', 500)->header('Content-Type', 'text/plain');
        }


        if($check_data[0]->updated_at != $check_locks[0]->updated_at){
            $remove_locks = DB::table('locks')
                ->Join('users', 'locks.user_id', '=', 'users.id')
                ->where('table_name', $request->table_name)
                ->where('element_id', $request->id)
                ->where('users.id', Auth::user()->id)
                ->delete();

            if($remove_locks){
                return response('Od poslední návštěvy se zámek změnil, zkus to znovu.', 500)->header('Content-Type', 'text/plain');

            }else{
                return response('Problém při mazání záznamu z tabulky Locks', 500)->header('Content-Type', 'text/plain');
            }
        }

            $response_data = null;
            switch ($check_data[0]->security) {

                case 'time':
                    $now = Carbon::now();
                    $before = Carbon::createFromFormat('Y-m-d H:i:s', $check_locks[0]->created_at);

                    if(intval($check_data[0]->key) - $now->diffInSeconds($before) <= 0){

                        DB::table('locks')
                            ->Join('users', 'locks.user_id', '=', 'users.id')
                            ->where('table_name', $request->table_name)
                            ->where('element_id', $request->id)
                            ->where('users.id', Auth::user()->id)
                            ->update(['locked' => '0']);
                        return array("1");
                    }else{
                        $response_data = intval($check_data[0]->key) - $now->diffInSeconds($before);
                    }

                break;
                case 'prev':

                    $temp = explode(":", $check_data[0]->key);

                    $find_table = $temp[0];
                    $find_id = $temp[1];

                    $finished_data = DB::table('finished')
                        ->Join('users', 'finished.user_id', '=', 'users.id')
                        ->Join('elements', 'finished.element_id', '=', 'elements.id')
                        ->where('elements.data', $check_data[0]->key)
                        ->where('users.id', Auth::user()->id)
                        ->select('finished.id')
                        ->get();


                    Log::info($finished_data);


                    if(count($finished_data) == 0 ) {

                        $response_name = DB::table($find_table)
                            ->where('id', $find_id)
                            ->value('name');

                        $response_data = $response_name;
                    }
                    else if(count($finished_data) == 1 ){
                        DB::table('locks')
                            ->Join('users', 'locks.user_id', '=', 'users.id')
                            ->where('table_name', $request->table_name)
                            ->where('element_id', $request->id)
                            ->where('users.id', Auth::user()->id)
                            ->update(['locked' => '0']);
                        return array("1");
                    }else{
                        return response('Duplicitní záznamy v tabulce finished', 500)->header('Content-Type', 'text/plain');
                    }
                break;
                case 'key':
                    $response_data = $check_data[0]->key;
                break;
                default:
                    return response('Neznámý typ zabezepečení elementu', 500)->header('Content-Type', 'text/plain');
            }

            return $check_locks[0]->locked == '1' ? array("0",$check_data[0]->security, $response_data) : array("1");


    }



    function unlock(Request $request)
    {
        Log::info('LockController:unlock ');

        $checked = DB::table('locks')
            ->leftJoin('users', 'locks.user_id', '=', 'users.id')
            ->where('table_name', $request->table_name)
            ->where('element_id', $request->id)
            ->where('users.id', Auth::user()->id)
            ->update(['locked' => '0']);


        return $checked ? "1" : response('Problém při aktualizaci dat v tabulce locks', 500)->header('Content-Type', 'text/plain');
    }
}


