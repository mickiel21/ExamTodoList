<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Item\ItemRequest;
use App\Helpers\ItemFilter;
use App\Models\Item;
use Illuminate\Support\Carbon;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ItemFilter $filters) {
        if($filters->request->query('status') === "ALL"){
            $items = Item::all();
            return resolveResponse(__('items.fetch_success'), $items);
        }else{
            $items = Item::with([])->filter($filters)->paginate($filters->limit);
            return resolveResponse(__('items.fetch_success'), $items);
        }
        
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            $item = Item::findOrFail($id);
            return resolveResponse(__('items.fetch_success'), $item);
        }catch(\Exception $e) {
            return rejectResponse(__('items.fetch_failed'), null);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request) {
        \DB::beginTransaction();
        try {
            $item = Item::create([
                'name' => $request->name
            ]);
            \DB::commit();
            return resolveResponse(__('items.create_success'), $item);
        }catch(\Exception $e) {
            \DB::rollback();
           
            return rejectResponse(__('items.create_failed'), null);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id) {
        \DB::beginTransaction();
        try {
           $item = Item::findOrFail($id);

           if($item){
               $item->is_completed = $request->is_completed ? $request->is_completed : false;
               $item->completed_at = $request->is_completed ? Carbon::now() : null;
           }
           $item->update([
               'name' => $request->name
           ]);
            \DB::commit();
            return resolveResponse(__('items.update_success'), $item);
        }catch(\Exception $e) {
            \DB::rollback();
           
            return rejectResponse(__('items.update_failed'), null);
        }
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        \DB::beginTransaction();
        try {
           $item = Item::findOrFail($id);
           $item->delete();
            \DB::commit();
            return resolveResponse(__('items.delete_success'), $item);
        }catch(\Exception $e) {
            \DB::rollback();
            return rejectResponse(__('items.delete_failed'), null);
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id) {
        \DB::beginTransaction();
        try {
            $item = Item::onlyTrashed()->findOrFail($id);
            $item->restore();
            \DB::commit();
            return resolveResponse(__('items.restore_success'), $item);
        }catch(\Exception $e) {
            \DB::rollback();
            return rejectResponse(__('items.restore_failed'), $e->getMessage());
        }
    }
}
