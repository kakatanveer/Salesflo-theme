<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\CreditItem;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;





class CreditController extends Controller
{
    public function ShowCredit()
    {
        $credit =  Credit::all();
        $items = Item::all();
        $customer = Customer::all();
        return view('AddCredit',compact('credit','items','customer'));

        return view('AddCredit',compact('credit','items','customer'));
    }

    public function AddCredit()
    {
        $credit =  Credit::all();
        $items = Item::all();
        $customer = Customer::all();
        return view('AddCredit',compact('credit','items','customer'));
    }

    public function StoreCredit(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'customer_name' => 'required|integer',
            'advance_payment' => 'required|numeric|min:0',
            'item_id.*' => 'required|integer|exists:items,id',
            'price.*' => 'required|numeric|min:0',
            'quantity.*' => 'required|integer|min:1',
            'item_discount.*' => 'required|numeric|min:0',
            'discount_amount.*' => 'required|numeric|min:0',
            'total.*' => 'required|numeric|min:0',
        ]);

        // dd($validatedData);

         // Use a transaction to ensure data integrity
         DB::transaction(function () use ($validatedData) {
            // Create the sell record
            $credit = Credit::create([
                'customer_id' => $validatedData['customer_name'],
                'advance_payment' => $validatedData['advance_payment'],
            ]);

            // Check if the credit was created successfully and has an ID
            if (!$credit) {
                throw new \Exception('Credit record could not be created.');
            }

            // Create the associated sell items and update stock quantities
            foreach ($validatedData['item_id'] as $index => $itemId) {
                $quantity = $validatedData['quantity'][$index];

                // Create the sell item
                $creditItem = CreditItem::create([
                    'credit_id' => $credit->id,
                    'item_id' => $itemId,
                    'price' => $validatedData['price'][$index],
                    'quantity' => $quantity,
                    'item_discount' => $validatedData['item_discount'][$index],
                    'discount_amount' => $validatedData['discount_amount'][$index],
                    'total' => $validatedData['total'][$index],
                ]);

                // Check if the credit item was created successfully
                if (!$creditItem) {
                    throw new \Exception('Credit item record could not be created.');
                }
                // Update the stock quantity
                $item = Item::find($itemId);
                if ($item) {
                    $item->stock_quantity -= $quantity;
                    $item->save();
                }
            }
        });
        // Redirect with success message
        return redirect()->route('ShowCredit')->with('success', 'Credit successfully added and stock updated');
    }

    public function UpdateCredit(Request $request, $id)
    {
        // dd($request);
        $Credit = Credit::find($id);
        if ($Credit) {
            $Credit->update($request->all());
            return redirect()->route('ShowCredit')->with('success', 'Credit updated successfully!');
        } else {
            return redirect()->route('ShowCredit')->with('success', 'Credit not found!');
        }
    }

    public function edit_Credit(Request $request)
    {
        $Credit = Credit::find($request->id);
        $res =  new ABC($Credit);

        dd($Credit);

        if ($Credit) {
            return response()->json($res);
        } else {
            return response()->json(['error' => 'Credit not found'], 404);
        }
    }
}
