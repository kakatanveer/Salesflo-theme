<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;



class CreditController extends Controller
{
    public function ShowCredit()
    {
        $CreditData = Credit::all();
        // dd( $CreditData);
        return view('ShowCredit',compact('CreditData'));
    }

    public function SaveCredit(Request $request)
    {
       // Validation
       $validator = Validator::make($request->all(), [
            'Credit_name' => 'required|string|max:255|unique:Credit',
            'contact_number' => 'required|integer',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            // dd("here");
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $Credit = new Credit();
        $Credit->Credit_name = $request->input('Credit_name');
        $Credit->contact_number = $request->input('contact_number');
        $Credit->address = $request->input('address');
        $Credit->added_by = auth()->user()->id; // Assuming the user is authenticated
        $Credit->added_on = now();

        $Credit->save();

        // Redirect with success message
        return redirect()->route('ShowCredit')->with('success', 'Credit added successfully!');
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
