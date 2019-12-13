<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobOrderProcessing;
use App\Inventory;

class JobOrderProcessingController extends Controller
{

    public function processList()
    {
        $processing = JobOrderProcessing::all();
        return view('pages.inventory.processing', compact('processing'));
    }

    public function process(Request $request)
    {
        if ($request->ajax()) {

            $process_item = new JobOrderProcessing();
            $process_item->inventory_id = $request->item_id;
            $process_item->qty = $request->qty;

                    if ($process_item->save()) {

                        $item = Inventory::where('id', $request->item_id)->first();
                        // $data = [
                        //     'consumable_id' => $request->consumable_id,
                        //     'qty' => $request->qty,
                        //     'status' => 'Processing',
                        //     'created_at' => $date,
                        //     'updated_at' => $date,
                        // ];
                        // $created = IndividualConsumable::create($data);

                        $updated = Inventory::where('id', $request->item_id)
                                                    ->update(['qty' => $item->qty - $request->qty]);

                            if(!$updated){
                                return response(['update_error' => 'Processing of item failed. Please try again, if issue persists contact support.']);
                            }
                            else {
                                return response(['update_success' => 'Item successfully processed.']);
                            }
                    }

        } else {
            return response(['request_error' => 'Cannot process request. Please try again, if issue persists contact support.']);
        }
    }

    public function destroy()
    {
        $processing_item = JobOrderProcessing::all();

        foreach ($processing_item as $pi) {

            $item_proc = JobOrderProcessing::where('inventory_id', $pi->inventory_id)->first();
            $item_stock = Inventory::where('id', $pi->inventory_id)->first();

            $total = $item_stock->qty + $item_proc->qty;
            Inventory::where('id', $pi->inventory_id)->update(['qty' => $total]);
        }

        JobOrderProcessing::truncate();
    }
}
