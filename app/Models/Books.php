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

    public static function getAllTestsResultsFrom($id){

        $elements = DB::table('results')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->join('elements', 'results.element_id', '=', 'elements.id')
            ->join('element_types', 'elements.type', '=', 'element_types.id')
            ->join('middle_box', 'elements.parent', '=', 'middle_box.id')
            ->join('big_box', 'middle_box.parent', '=', 'big_box.id')
            ->join('chapters', 'big_box.parent', '=', 'chapters.id')
            ->join('books', 'chapters.parent', '=', 'books.id')
            ->where('element_types.blade', 'like', '%test%')
            ->where('books.id', $id)
            ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.user_id', 'results.element_id', 'results.data_json', 'results.data', 'results.result', 'results.comments', 'results.created_at', 'results.updated_at')
            ->orderBy('user_id', 'asc')
            ->orderBy('element_id', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return $elements;
    }
}
