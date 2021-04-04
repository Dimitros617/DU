<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Finished;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Elements extends Model
{
    use HasFactory;

    public static function deleteHard($id)
    {
//        Log::info('Elements:deleteHard ' . $id);
        $data = DB::table('finished')
                ->Join('elements', 'finished.element_id', '=', 'elements.id')
                ->where('elements.id', $id)
                ->get();

        $check1 = true;
        if(count($data) != 0) {
            $check1 = DB::table('finished')
                ->Join('elements', 'finished.element_id', '=', 'elements.id')
                ->where('elements.id', $id)
                ->delete();
        }

        if(!$check1){
            Log::info('Chyba při mazání finished elementů');
        }

        $data2 = DB::table('results')
            ->where('element_id', $id)
            ->get();

        $check3 = true;
        if(count($data2) != 0) {

            foreach ($data2 as $result){
                $temp_check = Results::tryDeleteTests($result->id);
                $check3 = $temp_check == null ? true : $temp_check;
            }
        }


        if(!$check3){
            Log::info('Chyba při mazání results');
        }


        Elements::delete_reposition(Elements::find($id)->position);

        $check2 = Elements::find($id)->delete();

        if(!$check2){
            Log::info('Chyba při mazání elementů z elements');
        }

        return ($check1 && $check2 && $check3 ? true : false);
    }

    public static function delete_reposition($position){

        $dats = DB::table('elements')
            ->orderBy('position', 'asc')
            ->get();


        foreach ($dats as $data){

            if($data->position >= $position){
                $temp = Elements::find($data->id);
                $temp->position = ($temp->position-1);
                $check = $temp->save();
                if(!$check){
                    Log::info('Chyba při repozicování elements');
                }
            }

        }

    }

    public static function getAllTestsResultsFrom($id){

        $elements = DB::table('results')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->join('elements', 'results.element_id', '=', 'elements.id')
            ->join('element_types', 'elements.type', '=', 'element_types.id')
            ->where('element_types.blade', 'like', '%test%')
            ->where('elements.id', $id)
            ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.user_id', 'results.element_id', 'results.data_json', 'results.data', 'results.result', 'results.comments', 'results.created_at', 'results.updated_at')
            ->orderBy('user_id', 'asc')
            ->orderBy('element_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return $elements;
    }

}
