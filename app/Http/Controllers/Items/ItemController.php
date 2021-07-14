<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Item\ItemRequest;
use App\Helpers\ItemFilter;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ItemFilter $filters) {

        return resolveResponse(__('items.fetch_success'), $filters->request->all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request) {
        \DB::beginTransaction();
        try {
           
            \DB::commit();
            return resolveResponse(__('items.create_success'), $item);
        }catch(\Exception $e) {
            \DB::rollback();
           
            return rejectResponse(__('items.create_failed'), null);
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
          
            return resolveResponse(__('items.fetch_success'), $item);
        }catch(\Exception $e) {
            return rejectResponse(__('items.fetch_failed'), null);
        }
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, $id) {
        \DB::beginTransaction();
        try {
           

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
           
            \DB::commit();
            return resolveResponse(__('products.restore_success'), $item);
        }catch(\Exception $e) {
            \DB::rollback();
            return rejectResponse(__('products.restore_failed'), null);
        }
    }
}
