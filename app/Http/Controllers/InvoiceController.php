<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\InvoiceHeadModel;
use App\Models\InvoiceDetailModel;
use App\Models\ItemModel;
use DataTables;


class InvoiceController extends Controller
{
    public function InvoiceGenerate(Request $request)
    {
        $ids = $request->item_id;
        $vendor_id = $request->vendor_id;
        //dd("yes");
        return redirect('invoice_generate/'.$ids.'/'.$vendor_id);
    }
    public function InsertInvoice(Request $request)
    {
        
        try {
            //dd($request->all());
            $qty = implode(",",$request->qty);
            $array = explode(",",$qty);
           
           // dd($array);
            $item_id_st = implode(",",$request->item_id);
            $item_id_array = explode(",",$item_id_st);
            //dd($item_id_array);

            
           // dd($item_ids);
           $md5Name = md5_file($request->file('image')->getRealPath());
            //dd($md5Name);
            $image=$request->file('image');
            $file = $image->getClientOriginalName();
            $base_path = 'upload/';
            $image->move('upload',$md5Name);

            $date = date("Y-m-d");
            $user_id = Auth::user()->id;

                $vendor_id = $request->vendor_id;
                $invoice_head_id = InvoiceHeadModel::create([
            'vendor_id' => $user_id,
            // 'vendor_signature' => $base_path.$fileName,
            'invoice_file' => $base_path.$md5Name,
            'invoice_date' => $date,
            'is_completed' => '0',
            'created_by' => $user_id
        ]);
            $item_ids = explode(',',$request->item_ids);
         
            $date = date("Y-m-d");
            $user_id = Auth::user()->id;
      //  print_r($invoice_head_id->id);
     // dd($item_ids);
         foreach ($item_ids as $id) {
            // dd($invoice_head_id->id);
           
            //dd($id);
            if ($id != NULL || $id != "") {
              
                    InvoiceDetailModel::create([
                        'invoice_head_id' => $invoice_head_id->id,
                        'item_id' => $id,
                        'created_by' => $user_id
                    ]);
                
               
            }
            foreach ($array as $item) {
                if ($item != '') {
                    InvoiceDetailModel::whereIn('item_id',$item_id_array)->update([
                        'quantity' => $item
                    ]);
                }
            }
              
            
         }
         return redirect(route('invoice'))->with('status', 'Item Added Succesfully');
         
 
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
    public function GetInvoices(Request $request)
    {
        try {
            $ids = $request->item_id;
            $item_ids = explode(',',$ids);
           //dd($item_ids);
            if(is_array($item_ids))
            {
            $items = ItemModel::select('items.*')->whereIn("items.id",$item_ids)->get();
            $item = InvoiceDetailModel::select('invoice_details.*')->whereIn("invoice_details.item_id",$item_ids)->get();
            //dd($items);
            return view('Invoices.create',compact('items','item'));

            }
            //dd($items);


        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }        
    }

    public function index()
    {
        try {
            return view('Invoices.index');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
    public function getData()
    {
        try {
            $id = Auth::user()->id;
            if (Auth::user()->hasrole('vendor')) {
                $items = DB::select("SELECT
            inh.invoice_file,
            inh.invoice_date,
            inh.is_completed,
            inh.vendor_signature,
            inh.id,
            inh.vendor_id,
            CONCAT(u.first_name,' ',u.last_name) AS vendor_name
        FROM
            invoice_head inh
        LEFT JOIN users u ON u.id = inh.vendor_id 
        WHERE
            inh.is_deleted = 0 AND  inh.vendor_id = '".$id."'
         ORDER BY
         inh.id DESC");
       // dd($items);
            return Datatables::of($items)->addColumn('action', function ($id) {
                return '
                    <a href="invoice_view/'. $id->id.'" data-view="'.$id->id.'" class="view_btn" style="color: green;cursor: pointer;" target="_blank"><i class="fas fa-signature"></i></a>   
                    <a href="invoice_slip/'. $id->id.'" style="color: blue;cursor: pointer;margin-left:6%;" id="'.$id->id.'" data-invoice="'.$id->id.'" class="invoice_view" target="_blank"><i class="fas fa-file-invoice-dollar"></i></a>
                    <a  style="color: red;cursor: pointer;margin-left:6%;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a> 
                  '; })->addColumn('invoice_file', function ($row) {
                    return '<a href='. $row->invoice_file.' style="color: blue;cursor: pointer;" target="_blank">Downlaod File</a> 
                      
                      '; })->addColumn('status', function ($user) {
                        if ($user->is_completed == 1) return '<span class="btn btn-sm bg-success-light">Completed</span>';
                        if ($user->is_completed == 0) return '<span class="btn btn-sm bg-danger-light">InComplete</span>';
                        return 'Cancel';
                    })->rawColumns(['action','invoice_file','status'])->make(true); 
            }else{
            $items = DB::select("SELECT
            inh.invoice_file,
            inh.invoice_date,
            inh.is_completed,
            inh.vendor_signature,
            inh.id,
            inh.vendor_id,
            CONCAT(u.first_name,' ',u.last_name) AS vendor_name
        FROM
            invoice_head inh
        LEFT JOIN users u ON u.id = inh.vendor_id 
        WHERE
            inh.is_deleted = 0
         ORDER BY
         inh.id DESC");
       // dd($items);
            return Datatables::of($items)->addColumn('action', function ($id) {
                return '
                    <a href="invoice_view/'. $id->id.'" data-view="'.$id->id.'" class="view_btn" style="color: green;cursor: pointer;" target="_blank"><i class="fas fa-signature"></i></a> 
                    <a href="invoice_slip/'. $id->id.'" style="color: blue;cursor: pointer;margin-left:6%;" id="'.$id->id.'" data-invoice="'.$id->id.'" class="invoice_view" target="_blank"><i class="fas fa-file-invoice-dollar"></i></a>
                    <a  style="color: red;cursor: pointer;margin-left:6%;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a> 
                  '; })->addColumn('invoice_file', function ($row) {
                    return '<a href='. $row->invoice_file.' style="color: blue;cursor: pointer;" target="_blank">Download File</a> 
                      
                      '; })->addColumn('status', function ($user) {
                        if ($user->is_completed == 1) return '<span class="btn btn-sm bg-success-light">Completed</span>';
                        if ($user->is_completed == 0) return '<span class="btn btn-sm bg-danger-light">InComplete</span>';
                        return 'Cancel';
                    })->rawColumns(['action','invoice_file','status'])->make(true); 
                }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
    public function ViewInvoices($id)
    {
       try {
          // dd($id);
        $items = InvoiceHeadModel::select('invoice_head.*','invoice_details.item_id','invoice_details.quantity','items.item_code','items.item_name','items.item_numbers','items.item_make','items.item_model','items.item_year','items.item_note','items.metals','items.weight','items.item_image','items.price')->join('invoice_details','invoice_details.invoice_head_id','invoice_head.id')->join('items','invoice_details.item_id','items.id')->where("invoice_head.id","=",$id)->get();
        //dd($items);
        return view('Invoices.invoice_view',compact('items'));
       } catch (\Throwable $th) {
           //throw $th;
           dd($th);
       }
    }
    public function SignatureMobile($id)
    {
       try {
          //dd($id);
          $items = InvoiceHeadModel::find($id);
        //dd($items);
        return view('Invoices.mobile',compact('items'));
       } catch (\Throwable $th) {
           //throw $th;
           dd($th);
       }
    }

    public function Signature(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            $base_path = 'upload/';
            $signatureUri = str_replace('data:image/png;base64,', '', $request->signature);
         
                $signature = str_replace(' ', '+', $signatureUri);
                 
                $signatureData = base64_decode($signature);
                 
                $fileName = strtotime(now()).'_signature.png';
                 
                $sig_file = file_put_contents(('upload/').$fileName, $signatureData);
                //dd($sig_file);
            $invoice_head_id = $request->invoice_head_id;
            InvoiceHeadModel::where('id','=',$invoice_head_id)->update([
                 
            'vendor_signature' => $base_path.$fileName
            ]);
            return redirect(route('invoice'))->with('status', 'Item Added Succesfully');
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
    public function InvoiceSlip($id)
    {
       try {
        $items =  DB::select("SELECT
        h.vendor_id,
        h.vendor_signature,
        d.quantity,
        d.item_id,
        h.invoice_file,
        h.invoice_date,
        i.item_code,
        h.created_by,
        i.item_name,
        i.item_numbers,
        i.item_make,
        i.item_make,
        i.item_model,
        i.item_year,
        i.item_note,
        i.price
    FROM
        invoice_head h
    JOIN invoice_details d ON
        d.invoice_head_id = h.id
    JOIN items i ON
        i.id = d.item_id
    WHERE
        h.id = '".$id."'
        ORDER BY h.id DESC");
        //dd($items);
        return view('Invoices.invoice_slip',compact('items'));
       } catch (\Throwable $th) {
           //throw $th;
           dd($th);
       }
    }
    public function destroy($id)
    {
       $delete = InvoiceHeadModel::where('id','=',$id)->update([
            'is_deleted' => 1
        ]);
        if ($delete) {
           return 1;
        }
    }
    public function Quantity(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;
       $fire =  InvoiceDetailModel::where('item_id','=',$id)->update([
            'quantity' => $qty,
        ]);
        if ($fire) {
            return 1;
        }
    }
}
