<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Big_box extends Model
{

    protected $table = 'Big_box';
    use HasFactory;

    public static function deleteHard($id)
    {
        $data = DB::table('middle_box')
            ->where('parent', $id)
            ->get();

        $check1 = true;
        foreach ($data as $dat){
            $temp_check = Middle_box::deleteHard($dat->id);
            $check1 = ($temp_check && $check1 ? true : false);
        }

        Big_box::delete_reposition(Big_box::find($id)->position);

        $check2 = Big_box::find($id)->delete();

        if(!$check2){
            Log::info('Chyba při mazání elementů z big_box');
        }

        return ($check1 && $check2 ? true : false);
    }

    public static function delete_reposition($position){

        $dats = DB::table('big_box')
            ->orderBy('position', 'asc')
            ->get();


        foreach ($dats as $data){

            if($data->position >= $position){
                $temp = Big_box::find($data->id);
                $temp->position = ($temp->position-1);
                $check = $temp->save();
                if(!$check){
                    Log::info('Chyba při repozicování big_box');
                }
            }

        }

    }
}
