<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Invoice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class InvoicesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $user = \Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        $invoices = $admin->firm->invoices;

        $data = array (
            'invoices' => $invoices
        );

        return view('finances.invoices.index', $data);
    }

    public function create(){
        $user = \Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        $firmID = $admin->firm->id;

        $data = array (
            'firmID' => $firmID
        );

        return view('finances.invoices.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // validate
        $rules = array(
            'amount_billed' => 'required|Numeric',
            'company_name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // if the validation fails send back to the creation view
        if ($validator->fails()) {
            return Redirect::to('finances/expenditures/invoices/create')
                ->withErrors($validator);
        } else {
            $invoice = new Invoice;
            $invoice->amount_billed = Input::get('amount_billed');
            $invoice->firm_id = Input::get('firm_id');
            $invoice->company_name = Input::get('company_name');

            if(Input::get('sent_date') != '')
                $invoice->sent = Input::get('sent_date').' '.Input::get('sent_time');
            if(Input::get('received_date') != '')
                $invoice->received = Input::get('received_date').' '.Input::get('received_time');

            $invoice->save();

            // redirect
            Session::flash('message', 'Successfully created invoice!');
            return Redirect::to('finances/invoices');

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = \Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        $invoice = Invoice::find($id);    // get invoice

        // split sent and received into parts to use on the form
        $sentParts = preg_split('/\s+/', $invoice->sent);
        $receivedParts = preg_split('/\s+/', $invoice->received);

        $invoice['sent_date']  = $sentParts[0];
        $invoice['sent_time']  = $sentParts[1];

        $invoice['received_date'] = $receivedParts[0];
        $invoice['received_time'] = $receivedParts[1];

        $data = array (
            'firmID' => $admin->firm->id,
            'invoice' => $invoice
        );

        // show the edit form and pass the nerd
        return view('finances.invoices.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        // validate
        $rules = array(
            'amount_billed' => 'required|Numeric',
            'company_name' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // if the validation fails send back to the creation view
        if ($validator->fails()) {
            return Redirect::to('finances/expenditures/invoices/create')
                ->withErrors($validator);
        } else {
            $invoice = Invoice::find($id);
            $invoice->amount_billed = Input::get('amount_billed');
            $invoice->firm_id = Input::get('firm_id');
            $invoice->company_name = Input::get('company_name');

            if(Input::get('sent_date') != '')
                $invoice->sent = Input::get('sent_date').' '.Input::get('sent_time');
            if(Input::get('received_date') != '')
                $invoice->received = Input::get('received_date').' '.Input::get('received_time');

            $invoice->save();

            // redirect
            Session::flash('message', 'Successfully created invoice!');
            return Redirect::to('finances/invoices');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $invoice = Invoice::find($id);
        $invoice->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the invoice!');
        return Redirect::to('finances/invoices');
    }

    public function getData(){
        $user = \Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        $invoices = $admin->firm->invoices;

        return $invoices;
    }
}
