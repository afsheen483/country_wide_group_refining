<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\MetalPricesModel;
use Auth;
class MetalController extends Controller
{
    public function store(Request $request)
    {
       
       try {
        $date = date("Y-m-d h:i:s");
        $user_id = Auth::user()->id;
        MetalPricesModel::create([
            'metal_id' => $request->metal_id,
            'price' => $request->price,
            'datetime' => $date,
            'userid' => $user_id,
            'created_by' => $user_id,
        ]);
        return redirect('/itemdata');
       } catch (\Throwable $th) {
           //throw $th;
           dd($th);
       }
    }
}
