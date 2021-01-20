<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\categories;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Exceptions;




class CategoryController extends Controller
{


    //
    function showCategories()
    {

        echo "<script>console.log('Debug Objects: CategoryController' );</script>";
        Log::info('CategoryControler:showCategories');
        if(Auth::permition()->return_verification == 1 || Auth::permition()->possibility_renting == 1 || Auth::permition()->edit_item == 1) {

            $data = DB::table('categories')->leftJoin('items', 'categories.id', '=', 'items.categories')->select('categories.id', 'categories.name', 'categories.description', 'items.availability', DB::raw('COUNT(items.categories) as count'))->groupByRaw('categories.name, categories.description, items.availability, categories.id')->get();
            $permition = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', Auth::id())->select('permition.edit_item', 'permition.possibility_renting')->get();

            //return $data    ;
            return view('categories', ['categories' => $data, 'permition' => $permition]);
        }
        else{
            return "0"; //sem dát view 403.blade
        }


    }

    function showItem(categories $name)
    {

        Log::info('CategoryControler:showItem');

        $dataItems = DB::table('items')->where('categories', $name['id'])->get();
        $dataLoans = DB::table('loans')->join('items', 'loans.item', '=', 'items.id')->where('categories', $name['id'])->select('loans.item', 'loans.rent_from', 'loans.rent_to')->get();
        $permition = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', Auth::id())->select('permition.edit_item','permition.possibility_renting')->get();


        return view('category', ['category' => $name, 'items' => $dataItems, 'loans' => $dataLoans, 'permition' => $permition]);

    }





    function saveCategory(Request $request)
    {
        Log::info('CategoryControler:saveCategory');

        if($this->checkCategoryNameExist($request->categoryName) == "true" && $request->categoryName != $request->categoryNameOld){
            abort(409);
            return;
        }

        $category = categories::find($request->categoryId);
        $category->name = is_null($request->categoryName) ? "": $request->categoryName;
        $category->description = is_null($request->categoryDescription) ? "": $request->categoryDescription;
        $category->save();

        return redirect('categories/' . $request->categoryName);

    }



    function addNewCategory(Request $request)
    {
        Log::info('CategoryControler:addNewCategory');

        $category = new categories;
        $category->name = 'Abecedně seřazená NOVÁ KATEGORIE';
        $check = $category->save();

        return back()->withInput(array('saveCheck' => $check ? '1' : '0'));

    }

    function removeCategory(Request $request)
    {
        Log::info('CategoryControler:removeCategory');

        $data = DB::table('items')->leftJoin('loans', 'items.id', '=', 'loans.item')->leftJoin('Users', 'loans.user', '=', 'Users.id')->Join('categories', 'items.categories', '=', 'categories.id')->orderBy('categories.name', 'asc')->orderBy('items.id', 'asc')->select('Users.id as userId', 'Users.name', 'Users.surname','categories.id as categoryId', 'categories.name as categoryName',  'items.id as itemId', 'items.name as itemName' , 'loans.id', 'loans.rent_from', 'loans.rent_to')->where('categories.id', $request->id)->get();

        if(count($data) == 0){
            $check = DB::table('categories')->where('id', $request->id)->delete();

            return $check;
        }else {

            return view('category-remove-verify', ['categories' => $data]);
        }
    }

    function removeCategoryHard(Request $request)
    {
        Log::info('CategoryControler:removeCategoryHard');

        $loansController = new LoansController;
        $check1 = DB::table('loans')->Join('items','loans.item', '=', 'items.id')->where('items.categories', $request->categoryId)->delete();
        $check2 = DB::table('items')->where('categories', $request->categoryId)->delete();
        $check3 = DB::table('categories')->where('id', $request->categoryId)->delete();

        return redirect('/categories');

    }

    public function checkCategoryNameExist($name){

        Log::info('CategoryControler:checkCategoryNameExist');

        $data = DB::table('categories')->where('name', $name)->get();
        return count($data) > 0 ? "true" : "false";

    }

    public function categoriesSort($sort){

        Log::info('CategoryControler:categoriesSort');

        $data = DB::table('categories')->orderBy('name', $sort)->get();
        return $data;

    }

    public function categoriesFind($find){

        Log::info('CategoryControler:categoriesFind');

        $data = DB::table('categories')->where('name', 'like', '%'.$find.'%')->get();
        return $data;

    }


}
