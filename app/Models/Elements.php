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
            Log::info('Chyba při mazání finished elementů: ' . $check1);
        }

        Elements::delete_reposition(Elements::find($id)->position);

        $check2 = Elements::find($id)->delete();

        if(!$check2){
            Log::info('Chyba při mazání elementů z elements');
        }

        return ($check1 && $check2 ? true : false);
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

}
