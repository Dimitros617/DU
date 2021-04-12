<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ListUsers;
use App\Models\categories;
use App\Models\loans;
use App\Models\User;
use App\Models\items;
use Illuminate\Support\Facades\Log;


class ListUsersController extends Controller
{
    function showAllUsers()
    {
        Log::info('ListUsersController:showAllUsers');
        $data = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->select('users.id as userId', 'users.name as userName', 'users.surname as userSurname', 'users.email as userEmail','users.nick as userNick', 'permition.id as permitionId', 'permition.name as permitionName', 'permition.possibility_read', 'permition.new_user', 'permition.edit_content', 'permition.edit_permitions')->orderBy('surname','asc')->get();
        return view('users', ['users' => $data]);


    }

    function showUser(User $id)
    {

        Log::info('ListUsersController:showUser');
        if($id['id'] == Auth::user()->id){
            return redirect()->route('profile.show');
        }

        $data = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', $id['id'])->select('users.id as userId', 'users.name as userName', 'users.surname as userSurname', 'users.email as userEmail','users.nick as userNick', 'permition.id as permitionId', 'permition.name as permitionName')->get();
        $dataPermition = DB::table('permition')->select('permition.name as permitionName', 'permition.id as permitionId')->get();

        return view('singleUser', ['user' => $data, 'permitions' => $dataPermition]);
    }


    function saveUserData(Request $request) //request pracuje s name ve formuláři
    {
        Log::info('ListUsersController:saveUserData');

        $user = User::find($request -> userId);
        $user -> name = $request -> userName;
        $user -> surname = $request -> userSurname;
        $user -> nick = $request -> userNick;
        $user -> email = $request -> userEmail;
        $user -> permition = $request -> selectPermition;
        $check = $user -> save();

        return $check ? "1" : "0";
    }

    public function usersSort($sort){

        Log::info('ListUsersController:usersSort');

        $data = DB::table('users')->orderBy('surname', $sort)->get();
        return $data;

    }

    public function usersFind($find){

        Log::info('ListUsersController:usersFind');

        $data = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->select('users.id')->where('users.name', 'like', '%'.$find.'%')->orWhere('users.surname','like','%'.$find.'%')->orWhere('users.nick','like','%'.$find.'%')->orWhere('permition.name','like','%'.$find.'%')->get();
        return $data;

    }

    public function getUserNames(){

        Log::info('ListUsersController:getUserNames');

        $data = DB::table('users')->select('nick')->get();

        return $data;
    }

    public function setPermition($permition_id){

        Log::info('ListUsersController:setPermition');
            $user = User::find(Auth::user()->id);
            $user->permition = $permition_id;
            $user->save();
    }

    function getStatus($id)
    {
        Log::info('ListUsersController:getStatus');

        $data = DB::table('histories')
            ->Join('users', 'histories.user_id', '=', 'users.id')
            ->where('histories.user_id', '=', $id)
            ->select( DB::raw('MAX(histories.created_at) as last'),  DB::raw('COUNT(histories.element_id) as entry'), 'histories.table_name', 'histories.old_name', 'histories.old_display_name', 'histories.element_id','histories.user_id','users.name as user_name','users.surname as user_surname')
            ->groupBy('histories.element_id')
            ->orderBy('histories.created_at','desc')
            ->get();

        foreach ($data as $dat){

            $name = DB::table($dat->table_name)
                ->where('id', '=', $dat->element_id)
                ->get();

            if(count($name) != 0){
                $dat->display_name = $name[0]->display_name;
                $dat->name = $name[0]->name;
            }else{
                $dat->display_name = $dat->old_display_name;
                $dat->name = $dat->old_name;
            }

            $lock = DB::table('locks')
                ->where('user_id', '=', $id)
                ->where('table_name', '=', $dat->table_name)
                ->where('element_id', '=', $dat->element_id)
                ->get();

            if(count($lock) != 0){
                $dat->locked = $lock[0]->locked;
                $dat->lockedDate = $lock[0]->created_at;
            }else{
                $dat->locked = null;
            }

            $finish = DB::table('finished')
                ->Join('elements', 'finished.element_id', '=', 'elements.id')
                ->where('finished.user_id', '=', $dat->user_id)
                ->where('elements.data', '=', ($dat->table_name.":".$dat->element_id))
                ->get();

            if(count($finish) != 0){
                $dat->finish = $finish[0]->created_at;
            }else{
                $dat->finish = null;
            }

        }


        return view('user-status', ['data' => $data]);
    }




}
