<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\ItemModel;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ItemImport;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try {
             return view('Items.index');
         } catch (\Throwable $th) {
             //throw $th;
         }
    }
    public function getdata(Request $request){
        //dd($request->user_id);
        try {
            //$users = User::all();
            if ($request->user_id == 'All') {
                $items = DB::select("SELECT
                i.id,
                i.item_code,
                i.item_name,
                i.item_numbers,
                i.item_make,
                i.item_model,
                i.item_year,
                i.item_note,
                i.metals,
                i.weight,
                i.item_image,
                CONVERT(i.price,decimal(10,2)) AS price,
                CONCAT(i.platinum_percentage, '%') AS platinum_percentage,
                CONCAT(i.pladium_percentage, '%') AS pladium_percentage,
                CONCAT(i.rhodium_percentage,'%') AS rhodium_percentage,
                (SELECT COUNT(CASE WHEN i.id = v.item_id THEN 1 ELSE 0 END) FROM view_history v WHERE i.id = v.item_id) AS same_col
            FROM
                items i
            WHERE
                i.is_deleted = 0
             ORDER BY
             i.id DESC");
                return Datatables::of($items)->addColumn('action', function ($id) {
                    return '<a href="item_edit/ '. $id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |
                        <a href="view_item/ '. $id->id.'" data-view="'.$id->id.'" class="view_btn" style="color: green;cursor: pointer;" target="_blank"><i class="fa fa-eye"></i></a> |
                        <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
                      '; })->editColumn('select_items', function ($row) {
                        return '<input type="checkbox" name="items[]" value="'.$row->id.'" data-checkbox="'.$row->id.'"  class="checkedbox"/>';
                    })->editColumn('platinum_percentage', function ($item) {
                        return $item->platinum_percentage;
                 })->rawColumns(['action', 'select_items','platinum_percentage'])->make(true); 
            }
            else{
                
                $items = DB::select("SELECT
                i.id,
                i.item_code,
                i.item_name,
                i.item_numbers,
                i.item_make,
                i.item_model,
                i.item_year,
                i.item_note,
                i.metals,
                i.weight,
                i.item_image,
                CONVERT(i.price,decimal(10,2)) AS price,
                CONCAT(i.platinum_percentage, '%') AS platinum_percentage,
                CONCAT(i.pladium_percentage, '%') AS pladium_percentage,
                CONCAT(i.rhodium_percentage,'%') AS rhodium_percentage,
                (SELECT COUNT(CASE WHEN i.id = v.item_id THEN 1 ELSE 0 END) FROM view_history v WHERE i.id = v.item_id) AS same_col
            FROM
                items i
            WHERE
                i.is_deleted = 0
             ORDER BY
             i.id DESC");
                return Datatables::of($items)->addColumn('action', function ($id) {
                    return '<a href="item_edit/ '. $id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |
                        <a href="view_item/ '. $id->id.'" data-view="'.$id->id.'" class="view_btn" style="color: green;cursor: pointer;" target="_blank"><i class="fa fa-eye"></i></a> |
                        <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
                      '; })->editColumn('select_items', function ($row) {
                        return '<input type="checkbox" name="items[]" value="'.$row->id.'" data-checkbox="'.$row->id.'"  class="checkedbox"/>';
                    })->editColumn('platinum_percentage', function ($item) {
                        return $item->platinum_percentage;
                 })->rawColumns(['action', 'select_items','platinum_percentage'])->make(true); 
            }
            if ($request->user_id > 0) {
                $items = DB::select("SELECT
                i.id,
                i.item_code,
                i.item_name,
                i.item_numbers,
                i.item_make,
                i.item_model,
                i.item_year,
                i.item_note,
                i.metals,
                i.weight,
                i.item_image,
                u.item_id,
                u.date,
                u.user_id,
                
                CONVERT(u.user_items_price,decimal(10,2)) AS price,
                CONCAT(i.platinum_percentage, '%') AS platinum_percentage,
                CONCAT(i.pladium_percentage, '%') AS pladium_percentage,
                CONCAT(i.rhodium_percentage,'%') AS rhodium_percentage,
                (SELECT COUNT(CASE WHEN i.id = v.item_id THEN 1 ELSE 0 END) FROM view_history v WHERE i.id = v.item_id) AS same_col
            FROM
                items i
            JOIN user_items u ON
            i.id = u.item_id
            WHERE
                i.is_deleted = 0 AND u.user_id = '".$request->user_id."'
             ORDER BY
             i.id DESC");
                return Datatables::of($items)->addColumn('action', function ($id) {
                    return '<a href="item_edit/ '. $id->id.'" style="color: blue;cursor: pointer;"><i class="fa fa-edit"></i></a> |
                        <a href="view_item/ '. $id->id.'" data-view="'.$id->id.'" class="view_btn" style="color: green;cursor: pointer;" target="_blank"><i class="fa fa-eye"></i></a> |
                        <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a>
                      '; })->editColumn('select_items', function ($row) {
                        return '<input type="checkbox" name="items[]" value="'.$row->id.'" data-checkbox="'.$row->id.'"  class="checkedbox"/>';
                    })->editColumn('platinum_percentage', function ($item) {
                        return $item->platinum_percentage;
                 })->rawColumns(['action', 'select_items','platinum_percentage'])->make(true);
            }
           
         } catch (\Throwable $th) {
             //throw $th;
             dd($th);
         }
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
        try {
            
            $date = date("Y-m-d h:i:s");
            $id = Auth::user()->id;
            $image=$request->file('image');
            $file = $image->getClientOriginalName();
            $base_path = 'upload/';
            $image->move('upload',$file);
            DB::table('items')->insert([
                'item_image' => $base_path.$file,
                'item_code' => $request->code,
                'item_name' => $request->name,
                'item_numbers' => $request->number,
                'item_make' => $request->make,
                'item_model' => $request->model,
                'item_year' => $request->year,
                'item_note' => $request->note,
                'price' => $request->price,
                'platinum_percentage' => $request->platinum_percentage,
                'pladium_percentage' => $request->pladium_percentage,
                'rhodium_percentage' => $request->rhodium_percentage,
                'created_by' => $id,
                'created_at' => $date,
                'is_deleted' => '0',
            ]);
            return redirect(route('itemdata'))->with('status', 'Item Added Succesfully');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = DB::table('items')->find($id);
            return view('Items.show')->with('item', $item);
            
           } catch (\Throwable $th) {
               //throw $th;
           }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       try {
        $item = DB::table('items')->find($id);
        return view('Items.edit')->with('item', $item);
        
       } catch (\Throwable $th) {
           //throw $th;
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
          //  dd($request->all());
          $date = date("Y-m-d h:i:s");
            $user_id = Auth::user()->id;
            $image=$request->file('image');
            $file = $image->getClientOriginalName();
            $base_path = 'upload/';
            $image->move('upload',$file);
            ItemModel::where('id','=',$id)->update([
                'item_image' => $base_path.$file,
                'item_code' => $request->code,
                'item_name' => $request->name,
                'item_numbers' => $request->number,
                'item_make' => $request->make,
                'item_model' => $request->model,
                'item_year' => $request->year,
                'item_note' => $request->note,
                'price' => $request->price,
                'platinum_percentage' => $request->platinum_percentage,
                'pladium_percentage' => $request->pladium_percentage,
                'rhodium_percentage' => $request->rhodium_percentage,
                'modified_by' => $user_id,
                'modified_at' => $date
            ]);
            return redirect()->route('itemdata');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       try {
          $delete_item =  ItemModel::where('id','=',$id)->update([
                'is_deleted' => '1'
           ]);
           if ($delete_item) {
               return 1;
           }
       } catch (\Throwable $th) {
           //throw $th;
           dd($th);
       }
    }
    public function fileImport(Request $request) 
    {
       try {
        Excel::import(new ItemImport, $request->file('file')->store('temp'));
        return back();
       } catch (\Throwable $th) {
           //throw $th;
           dd($th);
       }
    }
}
