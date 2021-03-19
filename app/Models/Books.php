<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Books extends Model
{
    use HasFactory;

    public static function deleteHard($id)
    {
        $data = DB::table('chapters')
            ->where('parent', $id)
            ->get();

        $check1 = true;
        foreach ($data as $dat){
            $temp_check = Chapters::deleteHard($dat->id);
            $check1 = ($temp_check && $check1 ? true : false);
        }

        $check2 = Books::find($id)->delete();

        if(!$check2){
            Log::info('Chyba při mazání elementů z books');
        }

        return ($check1 && $check2 ? true : false);
    }
}
