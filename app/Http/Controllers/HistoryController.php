<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Histories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HistoryController extends Controller
{

    /**
     * Funkce zaloguje přístup (vstup) do daného prvku
     *
     * @param $user = ID uživatele
     * @param $table = String jméno tabulky
     * @param $id = ID elementu z dané tabulky
     */
    function log($user, $table, $id){
        Log::info('HistoryController:log ');
        $history = new Histories;
        $history->table_name = $table;
        $history->element_id = $id;
        $history->user_id = $user;
        $history->created_at = Carbon::now()->toDateTimeString();
        $history->updated_at = Carbon::now()->toDateTimeString();
        $check = $history->save();

        if(!$check){
            abort(500);
        }
    }
}
