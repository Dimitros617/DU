<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\permition;

class PermitionController extends Controller
{

    function showPermissions(){

        Log::info('PermitionController:showPermissions');

        $data = DB::table('permition')->leftJoin('users','permition.id', '=', 'users.permition')->select('permition.*', DB::raw('COUNT(users.permition) as count'))->groupByRaw('permition.id, permition.name, permition.possibility_read, permition.new_user, permition.edit_content, permition.edit_permitions')->get();

        return view('permitions', ['permitions' => $data]);
    }

    function addPermition(){

        Log::info('PermitionController:addPermition');

        if(Auth::permition()->edit_permitions != 1){
            abort(403);
            return;
        }

        $permition = new permition;
        $permition->name = 'Nové oprávnění';
        $permition->possibility_read = 0;
        $permition->new_user = 0;
        $permition->edit_content = 0;
        $permition->edit_permitions = 0;
        $check = $permition->save();

        return back();
    }

    function savePermitionData(Request $request){

        Log::info('PermitionController:savePermitionData');


        $permition = permition::find($request->id);
        $permition->name = $request->name;
        $permition->possibility_read = $request->read;
        $permition->new_user = $request->user;
        $permition->edit_content = $request->edit;
        $permition->edit_permitions = $request->permition;
        $check = $permition->save();

        $check_edit_permitions = DB::table('permition')->select('edit_permitions')->groupByRaw('edit_permitions')->get();
        if(count($check_edit_permitions) == 1){
            $permition = permition::find($request->id);
            $permition->edit_permitions = 1;
            $check2 = $permition->save();
            return $check2 ? "-1" : "0";
        }

        return $check ? "1" : "0";

    }

    function removePermition(Request $request){

        Log::info('PermitionController:removePermition');


        $data = DB::table('users')->where('permition',$request->id)->get();
        $dataC = count($data);

        if ($dataC == 0)
        {
            $check = DB::table('permition')->where('id', $request->id)->delete();

        }
        elseif ($dataC > 0)
        {
            return "2";
        }

        return $check ? "1" : "0";


    }
}
