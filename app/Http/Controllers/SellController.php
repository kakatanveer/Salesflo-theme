<?php

namespace App\Http\Controllers;
use App\Models\Sell;
use App\Models\Item;
use Illuminate\Http\Request;


class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        //
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
}
