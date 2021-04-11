<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Histories extends Model
{
    use HasFactory;

    /**
     * Funkce zaloguje přístup (vstup) do daného prvku
     *
     * @param $user = ID uživatele
     * @param $table = String jméno tabulky
     * @param $id = ID elementu z dané tabulky
     * @param $remove = (Boolean) Zda chceme provést i zmazání historie starší 30 dní (defaultně true)
     */
    public static function log($user, $table, $id, $remove = true){

        Log::info('Histories:log');

        $data= DB::table($table)
            ->where('id', '=', $id)
            ->get()[0];

        $history = new Histories;
        $history->old_name = $data->name;
        $history->old_display_name = $data->display_name;
        $history->table_name = $table;
        $history->element_id = $id;
        $history->user_id = $user;
        $history->created_at = \Carbon\Carbon::now()->toDateTimeString();
        $history->updated_at = Carbon::now()->toDateTimeString();
        $check = $history->save();

        if(!$check){
            abort(500);
        }

        if($remove) {
            Histories::removeUserOlderThen($user, 30);
        }
    }

    /**
     * @param $id = (Integer) Id uživatele u kterého chceme smazat historii
     * @param $day = (Integer) Počet dnů, jak staré záznamy se majjí smazat
     */
    public static function removeUserOlderThen($id, $day){

        $count = DB::table("histories")
                    ->where('user_id', $id)
                    ->where('created_at', '<', Carbon::now()->subDays($day))
                    ->count();
        if($count == 0){
            return true;
        }

        $check = DB::table("histories")
                ->where('user_id', $id)
                ->where('created_at', '<', Carbon::now()->subDays($day))
                ->delete();

        return $check;

    }
}
