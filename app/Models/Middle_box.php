<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Middle_box extends Model
{
    protected $table = 'Middle_box';
    use HasFactory;

    public static function deleteHard($id)
    {
        $data = DB::table('elements')
            ->where('parent', $id)
            ->get();

        $check1 = true;
        foreach ($data as $dat){
            $temp_check = Elements::deleteHard($dat->id);
            $check1 = ($temp_check && $check1 ? true : false);
        }

        $check2 = Middle_box::find($id)->delete();

        if(!$check2){
            Log::info('Chyba při mazání elementů z middle_box');
        }

        return ($check1 && $check2 ? true : false);
    }
}
