<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class DashboardController extends Controller
{
    function show()
    {

        Log::info('DashboardControler:show');

        $firstUser = $this->checkUserAlone();
        if($firstUser != null){
            return $firstUser;
        }

        $data = DB::table('chapters')->get();
        $check_locks = DB::table('locks')->Join('users', 'locks.user_id', '=', 'users.id')->where('table_name', 'chapters')->where('users.id', Auth::user()->id)->select( 'locks.element_id', 'locks.locked')->get();



        return view('dashboard', ['chapters' => $data, 'locked' => $check_locks]);

    }

    function checkUserAlone(){

        Log::info('DashboardControler:show->checkUserAlone');

        $count = DB::table('users')->get();

        if(count($count) == 1){
            $user = User::find(Auth::user()->id);
            if($user -> current_team_id == null) {
                $user->current_team_id = 1;
                $user->permition = 3;
                $user->save();
                return view( 'first-user');
            }
        }

        return null;

    }


}
