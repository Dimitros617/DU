<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Elements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResultsController extends Controller
{
    function showFilesResults($id){
        Log::info('ResultsController:showFilesResults');

        $data = DB::table('results')
            ->Join('users', 'results.user_id', '=', 'users.id')
            ->where('element_id', '=', $id)
            ->select('users.nick', 'users.name', 'users.surname', 'results.id', 'results.data', 'results.result', 'results.comments', 'results.updated_at')
            ->orderBy('results.updated_at','asc')
            ->get();

        return view('files-results', ['results' => $data, 'element_name' => Elements::find($id)->name]);
    }
}
