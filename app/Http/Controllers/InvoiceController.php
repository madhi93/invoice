<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\InvoiceList;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('invoice');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
//        dd($request->all());
        $invoice = new Invoice ;
        $invoice->provider_name = $request->provider_name;
        $invoice->participate_name = $request->participate_name;
        $invoice->invoice_no = $request->invoice_number;
        $invoice->invoice_date = $request->invoice_date;
        $upload = null;
        if ($request->file('invoice_upload')) {
            $file = $request->file('invoice_upload');
                    $destinationPath = 'uploads';
                    $file->move($destinationPath,$file->getClientOriginalName());
                    $upload = $destinationPath.'/'.$file->getClientOriginalName();
        }
        $invoice->invoice_upload = $upload;
        $invoice->total = $request->total;
        $invoice->save();
         $count = (int)$request->count_add_item;
       if($count > 0){
           for($i=0;$i<$count;$i++){
               $invoicelist = new InvoiceList;
               $invoicelist->start_date = $request->s_date[0];
               $invoicelist->invoice_id = $invoice->id;
               $invoicelist->end_date = $request->end_date[0];
               $invoicelist->credit_term = $request->c_term[0];
               $invoicelist->is_active = $request->active[0] == 1 ? 1 : 0;
               $invoicelist->support_item_no = $request->s_no[0];
               $invoicelist->description = $request->desc[0];
               $invoicelist->units = $request->unit[0];
               $invoicelist->price = $request->price[0];
               $invoicelist->gst_code = $request->gst_code[0];
               $invoicelist->amount = $request->amount[0];
               $invoicelist->save();
           }
       }
       return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $invoices = Invoice::withCount('invoicelist')->get();
        return view('invoicelist',compact('invoices'));
    }
}
