<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Results extends Model
{
    use HasFactory;

    public static function tryDeleteTests($id){

//        Log::info('Results:tryDeleteTests ' . $id);

        $result = Results::find($id)->data;
        if(str_contains($result,'test')){
            $check = DB::table('results')
                    ->where('data', '=', $id)
                    ->delete();

            $check2 = Results::find($id)->delete();

            return $check && $check2;
        }else{
            return Results::find($id)->delete();
        }

    }
}
