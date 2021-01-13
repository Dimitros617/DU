<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\items;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ItemsController extends Controller
{

    function addNewItem(Request $request)
    {
        Log::info('CategoryControler:addNewItem');

        $item = new items;
        $item->name = "Nepojmenováno";
        $item->categories = $request->category;
        $check = $item->save();

        return back()->withInput(array('saveCheck' => $check ? '1' : '0'));

    }

    function saveItem(Request $request)
    {
        Log::info('CategoryControler:saveItem');

        $item = items::find($request->itemId);
        $item->name = is_null($request->name) ? "": $request->name;
        $item->note = is_null($request->note) ? "": $request->note;
        $item->place = is_null($request->place) ? "": $request->place;
        $item->inventory_number = is_null($request->inventory_number) ? "": $request->inventory_number;
        $item->availability = is_null($request->availability) ? "0":  $request->availability;
        $check = $item->save();

        return $check;
    }

    function changeItemAvailability(Request $request)
    {
        Log::info('CategoryControler:changeItemAvailability');

        $item = items::find($request->id);
        $item->availability = (($request->availability + 1) % 2);
        $check = $item->save();

        $availability = (($request->availability + 1) % 2);
        return array("return" => $check, "availability" => $availability);

    }

    function removeItem(Request $request)
    {
        Log::info('CategoryControler:removeItem' . $request->id);

        $loans = DB::table('loans')->where('item', $request->id)->count();

        if ($loans == 0) {
            $check = DB::table('items')->where('id', $request->id)->delete();

            return  $check;

        } else {
            $item = items::find($request->id);
            $users = DB::table('loans')->join('users', 'loans.user', '=', 'users.id')->where('item', $request->id)->select('users.id', 'users.name', 'users.surname', 'loans.rent_from', 'loans.rent_to')->get();

            return view('item-remove-verify', ['item' => $item, 'users' => $users]);

        }

    }

    function removeItemHard(Request $request)
    {
        Log::info('CategoryControler:removeItemHard');

        $item = DB::table('items')->join('categories', 'items.categories', '=', 'categories.id')->where('items.id', $request->itemId)->select('categories.name')->get();
        DB::table('loans')->where('item', $request->itemId)->delete();
        DB::table('items')->where('id', $request->itemId)->delete();

        return redirect('categories/' . $item[0]->name);

    }

}
