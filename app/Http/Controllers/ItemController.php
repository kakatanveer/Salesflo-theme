<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ItemController extends Controller
{
    //View Items
    public function ShowItems()
    {
        $items = Item::all(); // Retrieve all items from the database
        return view('ShowItem', compact('items')); // Pass the items to the view
    }


    public function ShowCredit()
    {
        return view('ShowCredit');
    }

    public function ShowExpense()
    {
        return view('ShowExpense');
    }

    public function ShowSell()
    {
        return view('ShowSell');
    }

    public function saveItem(Request $request)
    {
       // Validation
       $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:items',
            'plates' => 'required|integer',
            'ah' => 'required|integer',
            'limit' => 'required|integer',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            // dd("here");
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create new item
        $item = new Item();
        $item->name = $request->input('name');
        $item->plates = $request->input('plates');
        $item->ah = $request->input('ah');
        $item->limit = $request->input('limit');
        $item->buying_price = $request->input('buying_price');
        $item->selling_price = $request->input('selling_price');
        $item->added_by = auth()->user()->id; // Assuming the user is authenticated
        $item->added_on = now();

        $item->save();

        // Redirect with success message
        return redirect()->route('ShowItems')->with('success', 'Item added successfully!');
    }


    public function editItem($id)
    {
        $item = Item::findOrFail($id);
        return view('edit-item', compact('item'));
    }

    public function edit($id)
    {
        $item = Item::find($id);
        if ($item) {
            return response()->json($item);
        } else {
            return response()->json(['error' => 'Item not found'], 404);
        }
    }

    public function UpdateItems(Request $request, $id)
    {
        // dd($request);
        $item = Item::find($id);
        if ($item) {
            $item->update($request->all());
            return redirect()->route('ShowItems')->with('success', 'Item updated successfully!');
        } else {
            return redirect()->route('ShowItems')->with('success', 'Item not found!');
        }
    }
   
}
