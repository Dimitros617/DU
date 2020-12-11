<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\categories;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{


    //
    function showCategories()
    {

        echo "<script>console.log('Debug Objects: CategoryController' );</script>";
        Log::info('CategoryControler:show');

        $data = DB::table('categories')->leftJoin('items', 'categories.id', '=', 'items.categories')->select('categories.id','categories.name', 'categories.description', 'items.availability', DB::raw('COUNT(items.categories) as count'))->groupByRaw('categories.name, categories.description, items.availability, categories.id')->get();
        $permition = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', Auth::id())->select('permition.edit_item', 'permition.possibility_renting')->get();

        return view('categories', ['categories' => $data, 'permition' => $permition]);


    }

    function showItem(categories $name)
    {

        Log::info('CategoryControler:showItem');

        $dataItems = DB::table('items')->where('categories', $name['id'])->get();
        $dataLoans = DB::table('loans')->join('items', 'loans.item', '=', 'items.id')->where('categories', $name['id'])->select('loans.item', 'loans.rent_from', 'loans.rent_to')->get();
        $permition = DB::table('users')->join('permition', 'users.permition', '=', 'permition.id')->where('users.id', Auth::id())->select('permition.edit_item')->get();

        return view('category', ['category' => $name, 'items' => $dataItems, 'loans' => $dataLoans, 'permition' => $permition]);

    }





    function saveCategory(Request $request)
    {
        Log::info('CategoryControler:saveCategory');

        if($this->checkCategoryNameExist($request->categoryName) == "true"){
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
        $category->name = 'ZZZ - Nová kategorie';
        $check = $category->save();

        return back()->withInput(array('saveCheck' => $check ? '1' : '0'));

    }

    function removeCategory(Request $request)
    {
        Log::info('CategoryControler:removeCategory');

        $data = DB::table('items')->leftJoin('loans', 'items.id', '=', 'loans.item')->leftJoin('Users', 'loans.user', '=', 'Users.id')->Join('categories', 'items.categories', '=', 'categories.id')->orderBy('categories.name', 'asc')->orderBy('items.id', 'asc')->select('Users.id as userId', 'Users.name', 'Users.surname','categories.id as categoryId', 'categories.name as categoryName',  'items.id as itemId', 'items.name as itemName' , 'loans.id', 'loans.rent_from', 'loans.rent_to')->where('categories.id', $request->id)->get();

        if(count($data) == 0){
            $check = DB::table('categories')->where('id', $request->id)->delete();

            return back()->withInput(array('saveCheck' => $check ? '1' : '0'));
        }else {

            return view('category-remove-verify', ['categories' => $data]);
        }
    }

    function removeCategoryHard(Request $request)
    {
        Log::info('CategoryControler:removeCategoryHard');

        $check1 = DB::table('loans')->Join('items','loans.item', '=', 'items.id')->where('items.categories', $request->categoryId)->delete();
        $check2 = DB::table('items')->where('categories', $request->categoryId)->delete();
        $check3 = DB::table('categories')->where('id', $request->categoryId)->delete();

        return back()->withInput(array('saveCheck' => $check1 && $check2 && $check3 ? '1' : '0'));

    }

    public function checkCategoryNameExist($name){

        Log::info('CategoryControler:checkCategoryNameExist');

        $data = DB::table('categories')->where('name', $name)->get();
        return count($data) > 0 ? "true" : "false";

    }


}
