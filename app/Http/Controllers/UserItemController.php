<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\UserItemModel;
use App\Models\ItemModel;
class UserItemController extends Controller
{
    public function PriceInssert(Request $request)
    {
      // dd($request->user_price_value);
        
      //  dd($done);
      try {
            if ($request->user_id >0) {
              $done = UserItemModel::where('item_id','=',$request->item_ids)->where('user_id','=',$request->user_id)->update([
                'user_items_price' => $request->user_price_value
            ]);
              if ($done) {
                return 1;
            }
            }
            else{
              //dd("ALL");
              $done = ItemModel::where('id','=',$request->item_ids)->update([
                'price' => $request->user_price_value
            ]);
              if ($done) {
                return 1;
            }
            }
       
      } catch (\Throwable $th) {
          //throw $th;
          dd($th);
      }
    }
    public function PriceUpdate(Request $request)
    {
      try {
        //dd($request->all());
          $user_id = $request->user_id;
          $percentage = ($request->percentage) / 100;
         // dd($percentage);
          $query = DB::select("SELECT u.user_items_price FROM user_items u WHERE u.user_id = '".$user_id."'");
          //dd($query);
          if ($user_id > 0) {
            foreach ($query as $item) {

              $update =  UserItemModel::where('user_id','=',$user_id)->where('user_items_price','=',$item->user_items_price)->update([
                'user_items_price' => ($item->user_items_price) + ($item->user_items_price * $percentage),
              ]);
            }
            if ($query) {
              return 1;
            } 
          }
          if ($request->user_id == 'All'){
            $update = 0;
            $query = DB::select("SELECT i.price FROM items i");
            // dd("ELSE");
            foreach ($query as $item) {
             $update =  ItemModel::where('price','=',$item->price)->update([
                  'price' => ($item->price) + ($item->price * $percentage),
              ]);

            }
            if ($query) {
              return 1;
            }
           
          }
         

      } catch (\Throwable $th) {
        //throw $th;
        dd($th);
      }
    }
}
