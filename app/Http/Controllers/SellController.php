<?php

namespace App\Http\Controllers;
use App\Models\Sell;
use App\Models\Item;
use App\Models\SellItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class SellController extends Controller
{
    public function index()
    {
        $sell =  Sell::all();
        $items = Item::all();
        return view('ShowSell',compact('sell','items'));
        // return view('ShowCustomers',compact('CustomerData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         // Validate the request
         $validatedData = $request->validate([
             'customer_name' => 'required|string|max:255',
             'contact_number' => 'required|string|max:20',
             'payment_type' => 'required|string',
             'account_number' => 'nullable|string|max:20',
             'item_id.*' => 'required|integer|exists:items,id',
             'price.*' => 'required|numeric|min:0',
             'quantity.*' => 'required|integer|min:1',
             'item_discount.*' => 'required|numeric|min:0',
             'discount_amount.*' => 'required|numeric|min:0',
             'total.*' => 'required|numeric|min:0',
         ]);

         // Use a transaction to ensure data integrity
         DB::transaction(function () use ($validatedData) {
             // Create the sell record
             $sell = Sell::create([
                 'customer_name' => $validatedData['customer_name'],
                 'contact_number' => $validatedData['contact_number'],
                 'payment_type' => $validatedData['payment_type'],
                 'account_number' => $validatedData['account_number'],
             ]);

             // Create the associated sell items and update stock quantities
             foreach ($validatedData['item_id'] as $index => $itemId) {
                 $quantity = $validatedData['quantity'][$index];

                 // Create the sell item
                 SellItem::create([
                     'sell_id' => $sell->id,
                     'item_id' => $itemId,
                     'price' => $validatedData['price'][$index],
                     'quantity' => $quantity,
                     'item_discount' => $validatedData['item_discount'][$index],
                     'discount_amount' => $validatedData['discount_amount'][$index],
                     'total' => $validatedData['total'][$index],
                 ]);

                 // Update the stock quantity
                 $item = Item::find($itemId);
                 if ($item) {
                     $item->stock_quantity -= $quantity;
                     $item->save();
                 }
             }
         });
         // Redirect with success message
        return redirect()->route('sells.index')->with('success', 'Sale successfully recorded and stock updated');
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function AddSell()
    {
        $sell =  Sell::all();
        $items = Item::all();
        return view('AddSell',compact('sell','items'));
    }
}
