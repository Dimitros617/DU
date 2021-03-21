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

        $data = DB::table('permition')
            ->leftJoin('users','permition.id', '=', 'users.permition')
            ->select('permition.*', DB::raw('COUNT(users.permition) as count'))
            ->groupByRaw('permition.id, permition.name, permition.possibility_read, permition.new_user, permition.edit_content, permition.edit_permitions, permition.default')->get();

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
        $permition->default = $request->default;
        $permition->possibility_read = $request->read;
        $permition->new_user = $request->user;
        $permition->edit_content = $request->edit;
        $permition->edit_permitions = $request->permition;
        $check = $permition->save();

        $check_edit_permitions = DB::table('permition')
            ->select('edit_permitions')
            ->groupByRaw('edit_permitions')
            ->get();

        if(count($check_edit_permitions) == 1){
            $permition = permition::find($request->id);
            $permition->edit_permitions = 1;
            $check2 = $permition->save();

            if($check2) {
                return response('Alespoň jedna role musí mít přiřazenou možnost "Správy rolí"!' . $request->table_name, 500)->header('Content-Type', 'text/plain');
            }else{
                return response('Nastala chyba při ukládání dat do tabulky permitions.' . $request->table_name, 500)->header('Content-Type', 'text/plain');

            }
        }

        $check_default = DB::table('permition')
            ->where('default', '=','1')
            ->get();

        if(count($check_default) == 0){
            return response('Alespoň 1 role musí být nastavena jako výchozí, jinak nebude možná registrace nových uživatelů.' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }elseif (count($check_default) > 1){
            return response('Je označeno více rolí jako výchozích, to může zapříčinit nesprávné rozdělení rolí při registraci nových uživatelů.' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }

        if(!$check) {
            return response('Nastala chyba při ukládání dat do tabulky permitions' . $request->table_name, 500)->header('Content-Type', 'text/plain');
        }

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
