<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewHistoryModel;
use Auth;
use DataTables;
use DB;
class ViewedHistoryController extends Controller
{
    public function viewHistory(Request $request)
    {
        try {
           // dd($request->all());
           if (Auth::user()->hasRole('vendor')) {
           
            $user_id = Auth::user()->id;
            $date = date("Y-m-d");
            ViewHistoryModel::create([
                'user_id' => $user_id,
                'item_id' => $request->view_id,
                'date' => $date
            ]);
        }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
    public function index()
    {
        try {
            return view('ViewHistory.index');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function getData()
    {
        try {
            $history = DB::select("SELECT
            v.id,
            v.date,
            i.item_name,
            i.item_code,
            u.first_name,
            u.last_name
        FROM
            view_history v
        JOIN items i ON
            i.id = v.item_id
        JOIN users u ON u.id = v.user_id
        ORDER BY v.id DESC");
             return Datatables::of($history) ->addColumn('name', function($row){
                return $row->first_name." ".$row->last_name;
          })->addColumn('action', function ($id) {
            return '<a href="item_edit/ '. $id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |
                <a href="view_item/ '. $id->id.'" data-view="'.$id->id.'" class="view_btn" style="color: green;cursor: pointer;" target="_blank"><i class="fa fa-eye"></i></a> |
                <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
              '; })->make(true);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
}
