<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\ItemModel;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DataTables;
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
    public function getdata(){
        try {
            //$users = User::all();
            $items = DB::table('items')->orderBy('id', 'desc');
            return Datatables::of($items)->addColumn('action', function ($id) {
                return '<a href="item_edit/ '. $id->id.'" class="btn btn-primary">Edit</a>
                    <a href="view_item/ '. $id->id.'" class="btn btn-success" target="_blank">View</a>
                        <button class="btn btn-danger" data-remote="/member/' . $id->id . '">Delete</button>
                  '; })->rawColumns(['image', 'action'])->make(true); 
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
            return redirect()->route('items');
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
        DB::table('items')->where('id', $id)->delete();
        return redirect(route('items'))->with('status', 'Item Deleted Succesfully');
    }
}
