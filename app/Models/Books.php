<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Books extends Model
{
    use HasFactory;
    public bool $timestamps = false;

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

        Books::delete_reposition(Books::find($id)->position);

        $check2 = Books::find($id)->delete();

        if(!$check2){
            Log::info('Chyba při mazání elementů z books');
        }

        return ($check1 && $check2 ? true : false);
    }

    public static function delete_reposition($position){

        $dats = DB::table('books')
            ->orderBy('position', 'asc')
            ->get();


        foreach ($dats as $data){

            if($data->position >= $position){
                $temp = Books::find($data->id);
                $temp->position = ($temp->position-1);
                $check = $temp->save();
                if(!$check){
                    Log::info('Chyba při repozicování books');
                }
            }

        }

    }
}
