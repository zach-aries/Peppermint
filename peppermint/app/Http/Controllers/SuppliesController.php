<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Supplies;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SuppliesController extends Controller
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

    public function getData(){

        $user = \Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        $supplies = $admin->firm->supplies;

        return $supplies;
    }

    public function index(){


        $user = \Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        $supplies = $admin->firm->supplies;


        return view('finances.expenditures.supplies.index', compact('supplies'));
    }

    public function create(){
        $user = \Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        $firmID = $admin->firm->id;

        $data = array (
            'firmID' => $firmID
        );

        return view('finances.expenditures.supplies.create', $data);
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
            'type' => 'required',
            'total_stock' => 'required|Numeric',
            'cost' => 'required|Numeric',
            'in_stock' => 'required|Numeric',
            'num_ordered' => 'required|Numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // if the validation fails send back to the creation view
        if ($validator->fails()) {
            return Redirect::to('finances/expenditures/supplies/create')
                ->withErrors($validator);
        } else {
            $supply = new Supplies;
            $supply->type = Input::get('type');
            $supply->total_stock = Input::get('total_stock');
            $supply->cost = Input::get('cost');
            $supply->in_stock = Input::get('in_stock');
            $supply->num_ordered = Input::get('num_ordered');
            $supply->firm_id = Input::get('firm_id');
            $supply->save();

            // redirect
            Session::flash('message', 'Successfully created supply item!');
            return Redirect::to('finances/expenditures/supplies');

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

        $supply = Supplies::find($id);    // get employee

        $data = array (
            'firmID' => $admin->firm->id,
            'supply' => $supply
        );

        // show the edit form and pass the nerd
        return view('finances.expenditures.supplies.edit', $data);
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
        // read more on validation at http://laravel.com/docs/validation
        // validate
        $rules = array(
            'type' => 'required',
            'total_stock' => 'required|Numeric',
            'cost' => 'required|Numeric',
            'in_stock' => 'required|Numeric',
            'num_ordered' => 'required|Numeric'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('finances/expenditures/supplies/' . $id . '/edit')
                ->withErrors($validator);

        } else {
            $supply = Supplies::find($id);
            $supply->type = Input::get('type');
            $supply->total_stock = Input::get('total_stock');
            $supply->cost = Input::get('cost');
            $supply->in_stock = Input::get('in_stock');
            $supply->num_ordered = Input::get('num_ordered');
            $supply->firm_id = Input::get('firm_id');
            $supply->save();

            // redirect
            Session::flash('message', 'Successfully updated supply item!');
            return Redirect::to('finances/expenditures/supplies');
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
        $supply = Supplies::find($id);
        $supply->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the supply item!');
        return Redirect::to('finances/expenditures/supplies');
    }
}
