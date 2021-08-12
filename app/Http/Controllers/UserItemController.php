<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\UserItemModel;
class UserItemController extends Controller
{
    public function PriceInssert(Request $request)
    {
      // dd($request->user_price_value);
        
      //  dd($done);
      try {
        $done = UserItemModel::where('item_id','=',$request->item_ids)->where('user_id','=',$request->user_id)->update([
            'user_items_price' => $request->user_price_value
        ]);
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
          $query[] = DB::select("SELECT u.user_items_price * '".$percentage."' AS user_items_price FROM user_items u WHERE u.user_id = '".$user_id."'");
          //dd($query);
          if ($user_id > 0) {
                UserItemModel::where('user_id','=',$user_id)->update([
                  'user_items_price' => $query,
                ]);
           
          }
         

      } catch (\Throwable $th) {
        //throw $th;
        dd($th);
      }
    }
}
