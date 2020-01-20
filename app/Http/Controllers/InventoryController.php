<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\Inventory;

class InventoryController extends Controller
{
    public function __construct(Request $request)
    {
        $this->property = session()->get('property_id');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $property = Property::findorFail($this->property);
        $inventories = Inventory::all();
        return view('pages.inventory.index', compact('property', 'inventories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $inventory->update([
            'description' => $request->field_description,
            'price' => $request->field_price,
        ]);

        return redirect()->route('inventory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }

    public function restock(Request $request, Inventory $inventory)
    {
        $inventory->update([
            'qty' => $request->field_qty,
        ]);

        return redirect()->route('inventory.index');
    }

    public function reduce(Request $request, Inventory $inventory)
    {
        $inventory->update([
            'qty' => $request->field_qty,
        ]);

        return redirect()->route('inventory.index');
    }

    public function getInventory()
    {
        $inventory = Inventory::all();
        $data = '<option disabled selected value>Select an Item</option>';
        foreach ($inventory as $i) {
            $data .= '<option value="'.$i->id.'">'.$i->code.' | '.$i->description.'</option>';
        }
        return $data;
    }

    public function getStock(Request $request)
    {
        $match = ['id' => $request->id];

        $data = Inventory::where($match)->sum('qty');
        return response()->json($data);
    }
}
