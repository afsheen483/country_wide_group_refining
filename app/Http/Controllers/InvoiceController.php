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
        return redirect('invoice_generate/'.$ids.'/'.$vendor_id);
    }
    public function InsertInvoice(Request $request)
    {
        
        try {
            //dd($request->all());
            
            
           // dd($item_ids);
            $image=$request->file('image');
            $file = $image->getClientOriginalName();
            $base_path = 'upload/';
            $image->move('upload',$file);

    //     $folderPath = public_path('upload/');
    //         //dd($folderPath);
    //     $image_parts = explode(";base64,", $request->signature);
    //    // dd($image_parts);
    //     $image_type_aux = explode("image/", $image_parts[0]);
    //        //dd($image_type_aux);
    //     $image_type = $image_type_aux[0];
    //        //dd($image_type);
    //     $image_base64 = base64_decode($image_parts[0]);
    //         //dd($image_base64);
    //     $signature = uniqid() . '.'.$image_type;
    //       // dd($signature);
    //     $filesi = $folderPath . $signature;
    //     $image_base64->move('upload',$signature);
    $date = date("Y-m-d");
    $user_id = Auth::user()->id;
    // $signatureUri = str_replace('data:image/png;base64,', '', $request->signature);
 
    //     $signature = str_replace(' ', '+', $signatureUri);
         
    //     $signatureData = base64_decode($signature);
         
    //     $fileName = strtotime(now()).'_signature.png';
         
    //     $sig_file = file_put_contents(public_path('upload/').$fileName, $signatureData);
         
        //$message = 'Signature Stored Successfully. <a target="_blank" href="signatures/'.$fileName.'">View Signature</a>';
            //dd($file);
        //file_put_contents($file, $image_base64);
        //$save = new Signature;
        //$save->invoice_file = $base_path.$file;
        //$save->signature = $signature;
          //      $save->save();
          $vendor_id = $request->vendor_id;
         $invoice_head_id = InvoiceHeadModel::create([
            // 'vendor_id' => $request->vendor_id,
            // 'vendor_signature' => $base_path.$fileName,
            'invoice_file' => $base_path.$file,
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
           // dd($item_ids);
            if(is_array($item_ids))
            {
            $items = ItemModel::select('items.*')->whereIn("items.id",$item_ids)->get();
            //dd($items);
            return view('Invoices.create',compact('items'));

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
            $items = DB::select("SELECT
            inh.invoice_file,
            inh.invoice_date,
            inh.is_completed,
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
                    <a href="invoice_view/'. $id->id.'" data-view="'.$id->id.'" class="view_btn" style="color: green;cursor: pointer;" target="_blank"><i class="fa fa-eye"></i></a> |
                    <a  style="color: red;cursor: pointer;" id="'.$id->id.'" data-delete="'.$id->id.'" class="delete_btn"><i class="fa fa-trash"></i></a> |
                    <a href="invoice_slip/'. $id->id.'" style="color: blue;cursor: pointer;" id="'.$id->id.'" data-invoice="'.$id->id.'" class="invoice_view" target="_blank"><i class="fas fa-file-invoice-dollar"></i></a>
                  '; })->addColumn('invoice_file', function ($row) {
                    return '<a href='. $row->invoice_file.' style="color: blue;cursor: pointer;" target="_blank">'.$row->invoice_file.'</a> 
                      
                      '; })->addColumn('status', function ($user) {
                        if ($user->is_completed == 1) return '<span class="btn btn-sm bg-success-light">Completed</span>';
                        if ($user->is_completed == 0) return '<span class="btn btn-sm bg-danger-light">InComplete</span>';
                        return 'Cancel';
                    })->rawColumns(['action','invoice_file','status'])->make(true); 
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
    public function ViewInvoices($id)
    {
       try {
          // dd($id);
        $items = InvoiceHeadModel::select('invoice_head.*','items.item_code','items.item_name','items.item_numbers','items.item_make','items.item_model','items.item_year','items.item_note','items.metals','items.weight','items.item_image','items.price')->join('invoice_details','invoice_details.invoice_head_id','invoice_head.id')->join('items','invoice_details.item_id','items.id')->where("invoice_head.id","=",$id)->get();
        //dd($items);
        return view('Invoices.invoice_view',compact('items'));
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
                 
                $sig_file = file_put_contents(public_path('upload/').$fileName, $signatureData);
            $invoice_head_id = $request->invoice_head_id;
            InvoiceHeadModel::where('id','=',$invoice_head_id)->update([
                 'vendor_id' => $request->user_id,
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
}
