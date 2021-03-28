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

        Middle_box::delete_reposition(Middle_box::find($id)->position);

        $check2 = Middle_box::find($id)->delete();

        if(!$check2){
            Log::info('Chyba při mazání elementů z middle_box');
        }

        return ($check1 && $check2 ? true : false);
    }

    public static function delete_reposition($position){

        $dats = DB::table('middle_box')
            ->orderBy('position', 'asc')
            ->get();


        foreach ($dats as $data){

            if($data->position >= $position){
                $temp = Middle_box::find($data->id);
                $temp->position = ($temp->position-1);
                $check = $temp->save();
                if(!$check){
                    Log::info('Chyba při repozicování middle_box');
                }
            }

        }

    }

    public static function getAllTestsResultsFrom($id){

        $elements = DB::table('results')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->join('elements', 'results.element_id', '=', 'elements.id')
            ->join('element_types', 'elements.type', '=', 'element_types.id')
            ->join('middle_box', 'elements.parent', '=', 'middle_box.id')
            ->where('middle_box.id', $id)
            ->where('element_types.blade', 'like', '%test%')
            ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.user_id', 'results.element_id', 'results.data_json', 'results.data', 'results.result', 'results.comments', 'results.created_at', 'results.updated_at')
            ->orderBy('user_id', 'asc')
            ->orderBy('element_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return $elements;
    }
}
