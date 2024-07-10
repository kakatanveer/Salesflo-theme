<?php

namespace App\Http\Controllers;

use App\Http\Resources\ABC;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    public function ShowCustomers()
    {
        // Fetch all customers with their credits and credit items
        $customers = Customer::with('credits.creditItems')->get();

        // Check if customers are found
        if ($customers->isEmpty()) {
            return view('ShowCustomers')->withErrors(['No customers found']);
        }

        // Calculate the total credit for each customer
            // Calculate the total credit for each customer
            foreach ($customers as $customer) {
                $totalCredit = $customer->credits->sum(function ($credit) {
                    return $credit->creditItems->sum('total');
                });
                $customer->total_credit = $totalCredit - $customer->credits->sum('advance_payment');
            }


        // Pass the data to the view
        return view('ShowCustomers', compact('customers'));
    }

    public function SaveCustomer(Request $request)
    {
          // Validation
       $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255|unique:customers',
            'contact_number' => 'required|string',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            // dd("here");
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $Customer = new Customer();
        $Customer->customer_name = $request->input('customer_name');
        $Customer->contact_number = $request->input('contact_number');
        $Customer->address = $request->input('address');
        $Customer->added_by = auth()->user()->id; // Assuming the user is authenticated
        $Customer->added_on = now();

        $Customer->save();

        // Redirect with success message
        return redirect()->route('ShowCustomers')->with('success', 'customer added successfully!');
    }

    public function UpdateCustomer(Request $request, $id)
    {
        $Customer = Customer::find($id);
        if ($Customer) {
            $Customer->update($request->all());
            return redirect()->route('ShowCustomers')->with('success', 'Customer updated successfully!');
        } else {
            return redirect()->route('ShowCustomers')->with('success', 'Customer not found!');
        }
    }

    public function edit_customer(Request $request)
    {

        $customer = Customer::find($request->id);
        // $res =  new ABC($customer);

        if ($customer) {
            return response()->json($customer);
        } else {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }

}
