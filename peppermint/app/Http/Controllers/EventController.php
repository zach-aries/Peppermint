<?php

namespace App\Http\Controllers;

use App\Event;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
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
     * Main page for employee scedule
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id){


        $employee = Employee::find($id);    // get employee
        $schedule = $employee->events;

        $data = array (
            'employee' => $employee,
            'schedule' => $schedule
        );

        return view('employees.schedule.index', $data);
    }

    /**
     * Punches in employee at id
     *
     * @param $id
     * @return mixed
     */
    public function punchIn($id){
        $event = Event::find($id);
        $event->punched_in = Carbon::now()->format('Y-m-d H:i:s');
        $event->save();

        // redirect
        Session::flash('message', 'Successfully punched in!');
        return Redirect::to('/');
    }

    /**
     * Punch out employee at id
     *
     * @param $id
     * @return mixed
     */
    public function punchOut($id){
        $event = Event::find($id);
        $event->punched_out = Carbon::now()->format('Y-m-d H:i:s');
        $event->save();

        // redirect
        Session::flash('message', 'Successfully punched out!');
        return Redirect::to('/');
    }

    /**
     * Create an Employee Schedule Event
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createEmployeeEvent($id){

        $employee = Employee::find($id);    // get employee

        $data = array (
            'employee' => $employee
        );

        return view('employees.schedule.create', $data);
    }

    /**
     * Store Employee Schedule event
     *
     * @param $id
     * @return mixed
     */
    public function storeEvent($id){

        // validate
        $rules = array(
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        // if the validation fails send back to the creation view
        if ($validator->fails()) {
            return Redirect::to('employees/schedule/' . $id . '/create')
                ->withErrors($validator);
        } else {
            $event = new Event;
            $event->start = Input::get('start_date').' '.Input::get('start_time');
            $event->end = Input::get('end_date').' '.Input::get('end_time');
            $event->employee_id = $id;
            $event->save();

            // redirect
            Session::flash('message', 'Successfully created event!');
            return Redirect::to('employees/schedule/'.$id.'/edit');

        }
    }

    /**
     * View for edit event
     *
     * @param $emp_id
     * @param $event_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editEmployeeEvent($emp_id, $event_id){
        $employee = Employee::find($emp_id);    // get employee
        $event = Event::find($event_id);

        // split sent and received into parts to use on the form
        $startParts = preg_split('/\s+/', $event->start);
        $endParts = preg_split('/\s+/', $event->end);

        $event['start_date']  = $startParts[0];
        $event['start_time']  = $startParts[1];

        $event['end_date'] = $endParts[0];
        $event['end_time'] = $endParts[1];

        $data = array (
            'employee' => $employee,
            'event' => $event
        );

        return view('employees.schedule.edit', $data);
    }

    /**
     * Store employee edit event
     *
     * @param $id
     * @return mixed
     */
    public function update($id){
        // validate
        $rules = array(
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        // if the validation fails send back to the creation view
        if ($validator->fails()) {
            return Redirect::to('employees/schedule/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            $event = Event::find($id);
            $employee = Employee::find($event->employee_id);

            $event->start = Input::get('start_date').' '.Input::get('start_time');
            $event->end = Input::get('end_date').' '.Input::get('end_time');
            $event->save();

            // redirect
            Session::flash('message', 'Successfully created event!');
            return Redirect::to('employees/schedule/'.$employee->id.'/edit');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($emp_id, $event_id)
    {
        // delete
        $event = Event::find($event_id);

        $event->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the event!');
        return Redirect::to('employees/schedule/'.$emp_id.'/edit');
    }
}
