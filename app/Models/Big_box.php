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

    public static function getAllTestsResultsFrom($id){

        $elements = DB::table('results')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->join('elements', 'results.element_id', '=', 'elements.id')
            ->join('element_types', 'elements.type', '=', 'element_types.id')
            ->join('middle_box', 'elements.parent', '=', 'middle_box.id')
            ->join('big_box', 'middle_box.parent', '=', 'big_box.id')
            ->where('element_types.blade', 'like', '%test%')
            ->where('big_box.id', $id)
            ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.user_id', 'results.element_id', 'results.data_json', 'results.data', 'results.result', 'results.comments', 'results.created_at', 'results.updated_at')
            ->orderBy('user_id', 'asc')
            ->orderBy('element_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return $elements;
    }

    public static function getAllWithChildren($id){

        $big_box = DB::table('big_box')
            ->where('id', '=', $id)
            ->get();

        $middle_box = DB::table('middle_box')
            ->where('parent', '=', $id)
            ->get();

        $elements = DB::table('elements')
            ->join('middle_box', 'elements.parent', '=', 'middle_box.id')
            ->where('middle_box.parent', '=' , $id)
            ->select('elements.*')
            ->get();



        return array_merge(json_decode($big_box), json_decode($middle_box), json_decode($elements));

    }

    public static function getAllWithoutChildren($id){

        $big_box = DB::table('big_box')
            ->where('id', '<>', $id)
            ->get();

        $middle_box = DB::table('middle_box')
            ->where('parent', '<>', $id)
            ->get();

        $elements = DB::table('elements')
            ->join('middle_box', 'elements.parent', '=', 'middle_box.id')
            ->where('middle_box.parent', '<>' , $id)
            ->select('elements.*')
            ->get();



        return array_merge(json_decode($big_box), json_decode($middle_box), json_decode($elements));
    }
}
