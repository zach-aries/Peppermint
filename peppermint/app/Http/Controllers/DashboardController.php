<?php

namespace App\Http\Controllers;

use App\Firm;
use Illuminate\Http\Request;
use App\Admin;
use App\Employee;
use Carbon\Carbon;

class DashboardController extends Controller
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
     * Filter employees and admins
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();

        if ($user->hasRole('employee'))
            return $this->employeeDashboard($user);
        else
            return $this->adminDashboard($user);
    }

    /**
     * Show the employee dashboard page
     *
     * @param $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employeeDashboard($user){

        // setup info to pass to view
        $employee = Employee::where('user_id', $user->id)->first();
        $schedule = $employee->events;
        $betweenShift = false;
        $punchedin = false;
        $punchedout = false;
        $shiftstart = null;
        $shiftend = null;
        $eventid = null;

        $cd = new Carbon(); // grabs current datetime

        foreach ($schedule as $event => $value) {
            $start = new Carbon($value->start);
            $end = new Carbon($value->end);

            if( $cd->gte($start) && $cd->lt($end)) {    // if current date is between the start
                if($value->punched_in != null)          // and end of a shift then
                    $punchedin = true;                  // that means punchin is available
                if($value->punched_out != null)
                    $punchedout = true;
                                                        // also check if a person has already punched in
                $betweenShift = true;                   // or punched out and pass proper boolean
                $shiftstart = $start;
                $shiftend = $end;
                $eventid = $value->id;
            }
        }

        $hours = $employee->getHoursMonth($employee->id);       // get employee hours for the month

        $admin = Admin::where('firm_id', $employee->firm_id)->first();  // have to get admin of firm to get
        $announcements = $admin->announcements;                         // announcments
        $announcements = $announcements->sortByDesc(function($announcements)
        {
            return $announcements->announced;
        });

        $data = array (
            'employee' => $employee,
            'schedule' => $schedule,
            'between_shift' => $betweenShift,
            'shiftstart' => $shiftstart,
            'shiftend' => $shiftend,
            'eventid' => $eventid,
            'punched_in' => $punchedin,
            'punched_out' => $punchedout,
            'total_hours' => $hours,
            'announcements' => $announcements
        );

        return view('employeedashboard', $data);    // create view and pass the data
    }

    /**
     * @param $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminDashboard($user){
        $admin = Admin::where('user_id', $user->id)->first();

        $announcements = $admin->announcements;
        $announcements = $announcements->sortByDesc(function($announcements)
        {
            return $announcements->announced;
        });

        $data = array (
            'announcements' => $announcements
        );

        return view('admindashboard', $data);
    }
}
