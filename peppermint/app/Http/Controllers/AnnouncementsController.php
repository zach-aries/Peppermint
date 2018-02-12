<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AnnouncementsController extends Controller
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

    /**
     * Create new Announcement
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $user = \Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        $data = array (
            'firmID' => $firmID = $admin->firm->id,
            'adminID' => $admin->id
        );

        return view('announcements.create', $data);
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
            'message' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // if the validation fails send back to the creation view
        if ($validator->fails()) {
            return Redirect::to('announcements/create')
                ->withErrors($validator);
        } else {
            $annoucnement = new Announcement;
            $annoucnement->message = Input::get('message');
            $annoucnement->admin_id = Input::get('admin_id');

            if(Input::get('publish') == 'on')
                $annoucnement->announced = Carbon::now();

            $annoucnement->save();

            // redirect
            Session::flash('message', 'Successfully created announcement!');
            return Redirect::to('/');

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

        $announcement = Announcement::find($id);    // get announcement

        $data = array (
            'adminID' => $admin->id,
            'announcement' => $announcement
        );

        // show the edit form and pass the nerd
        return view('announcements.edit', $data);
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
            'message' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('announcements/' . $id . '/edit')
                ->withErrors($validator);

        } else {
            $annoucnement = Announcement::find($id);
            $annoucnement->message = Input::get('message');
            $annoucnement->admin_id = Input::get('admin_id');

            if( $annoucnement->announced == null && Input::get('publish') == 'on')
                $annoucnement->announced = Carbon::now();

            $annoucnement->save();

            // redirect
            Session::flash('message', 'Successfully created announcement!');
            return Redirect::to('/');
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
        $announcement = Announcement::find($id);

        $announcement->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the announcement!');
        return Redirect::to('/');
    }
}
