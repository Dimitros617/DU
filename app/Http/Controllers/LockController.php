<?php

namespace App\Http\Controllers;

use App\Models\Chapters;
use App\Models\Locks;
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
            case 'chapters':
                $data = Chapters::find($request->id);
                $options = DB::table('chapters')->get();
                break;
            default:
                return response('Zadán špatný název tabulky elementu ' . $request->table_name, 500)->header('Content-Type', 'text/plain');

        }

        Log::info($options);
        return view('lock-setting', ['data' => $data, 'table' => array('chapters','Kapitola'), 'options' => $options]);
    }

    function saveRule(Request $request)
    {
        Log::info('LockController:ruleSetting');

        $data = DB::table($request->table_name)->where('id', $request->id)->get();

        if($data[0]->key == $request->key && $data[0]->security == $request->key_type  ){
            return "1";
        }

        $check = DB::table($request->table_name)->where('id', $request->id)->update(['key' => $request->key, 'security' => $request->key_type ]);

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

        $history = new HistoryController;

        $check_data = DB::table($request->table_name)->where('id', $request->id)->get();

        if(count($check_data) == 0 && count($check_data) > 1){
            return response('Duplicitní položky v tabulce ' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }

        if($check_data[0]->security == 'empty' || $check_data[0]->security == null){
            $history->log(Auth::user()->id, $request->table_name, $request->id);
            return array("1");
        }



        $check_locks = DB::table('locks')->Join('users', 'locks.user_id', '=', 'users.id')->where('table_name', $request->table_name)->where('element_id', $request->id)->where('users.id', Auth::user()->id)->select('locks.table_name', 'locks.element_id', 'locks.locked', 'locks.created_at', 'locks.updated_at')->get();

        if(count($check_locks) == 0){
            $lock = new Locks;
            $lock->table_name = $request->table_name;
            $lock->element_id = $request->id;
            $lock->user_id = Auth::user()->id;
            $lock->locked = "1";
            $lock->created_at = Carbon::now()->toDateTimeString();
            $lock->updated_at = Carbon::now()->toDateTimeString();
            $check_lock = $lock->save();

            $check_locks = DB::table('locks')->Join('users', 'locks.user_id', '=', 'users.id')->where('table_name', $request->table_name)->where('element_id', $request->id)->where('users.id', Auth::user()->id)->select('locks.table_name', 'locks.element_id', 'locks.locked', 'locks.created_at', 'locks.updated_at')->get();

            if(!$check_lock) {
                return response('Došlo k problému při ukládání dat do tabulky locks ' . $request->table_name, 500)->header('Content-Type', 'text/plain');
            }

        }elseif(count($check_locks) > 1){
            return response('Duplicitní položky v tabulce locks', 500)->header('Content-Type', 'text/plain');
        }

            $response_data = null;
            switch ($check_data[0]->security) {

                case 'time':
                    $now = Carbon::now();
                    $before = Carbon::createFromFormat('Y-m-d H:i:s', $check_locks[0]->created_at);

                    if(intval($check_data[0]->key) - $now->diffInSeconds($before) <= 0){

                        DB::table('locks')->Join('users', 'locks.user_id', '=', 'users.id')->where('table_name', $request->table_name)->where('element_id', $request->id)->where('users.id', Auth::user()->id)->update(['locked' => '0']);
                        $history->log(Auth::user()->id, $request->table_name, $request->id);
                        return array("1");
                    }else{
                        $response_data = intval($check_data[0]->key) - $now->diffInSeconds($before);
                    }

                break;
                case 'prev':

                    $temp = explode(":", $check_data[0]->key);
                    Log::info($temp);
                    $find_table = $temp[0];
                    $find_id = $temp[1];
                    $finished_data = DB::table('finished')->Join('users', 'finished.user_id', '=', 'users.id')->where('table_name', $find_table)->where('element_id', $find_id)->where('users.id', Auth::user()->id)->get();

                    if(count($finished_data) == 0 ) {
                        $response_data = $check_data[0]->name;
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

            if($check_locks[0]->locked == '0'){
                $history->log(Auth::user()->id, $request->table_name, $request->id);
            }

            return $check_locks[0]->locked == '1' ? array("0",$check_data[0]->security, $response_data) : "1";


    }

    function unlock(Request $request)
    {
        Log::info('LockController:unlock ');

        $checked = DB::table('locks')->leftJoin('users', 'locks.user_id', '=', 'users.id')->where('table_name', $request->table_name)->where('element_id', $request->id)->where('users.id', Auth::user()->id)->update(['locked' => '0']);


        return $checked ? "1" : response('Problém při aktualizaci dat v tabulce locks', 500)->header('Content-Type', 'text/plain');
    }
}


