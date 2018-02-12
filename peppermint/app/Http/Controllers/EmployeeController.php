<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Employee;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class EmployeeController extends Controller
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
     * Main page for Employee
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user = \Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        $employees = $admin->firm->employee;

        $data = array (
            'employees' => $employees
        );

        return view('employees.index', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $user = \Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        $firmID = $admin->firm->id;

        $data = array (
            'firmID' => $firmID
        );

        return view('employees.create', $data);
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
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'sin' => 'required|unique:employees,sin',
            'phone_number' => 'required',
            'address' => 'required',
            'wage' => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        // if the validation fails send back to the creation view
        if ($validator->fails()) {
            return Redirect::to('employees/create')
                ->withErrors($validator);
        } else {
            $employee = new Employee;
            $employee->fname = Input::get('fname');
            $employee->lname = Input::get('lname');
            $employee->sin = Input::get('sin');
            $employee->phone_number = Input::get('phone_number');
            $employee->address = Input::get('address');
            $employee->wage = Input::get('wage');
            $employee->firm_id = Input::get('firm_id');
            $employee->user_id = $employee->createUser(Input::get('email'), Input::get('password'));
            $employee->save();

            // redirect
            Session::flash('message', 'Successfully created employee!');
            return Redirect::to('employees');

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

        $employee = Employee::find($id);    // get employee
        $employeeUser = User::where('id', $employee->user_id)->first(); // get employee user

        $data = array (
            'firmID' => $admin->firm->id,
            'employee' => $employee
        );

        $data['employee']['email']  = $employeeUser->email;

        return view('employees.edit', $data);
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
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'sin' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'wage' => 'required|numeric'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('employees/' . $id . '/edit')
                ->withErrors($validator);

        } else {
            $employee = Employee::find($id);
            $employee->fname = Input::get('fname');
            $employee->lname = Input::get('lname');
            $employee->sin = Input::get('sin');
            $employee->phone_number = Input::get('phone_number');
            $employee->address = Input::get('address');
            $employee->wage = Input::get('wage');
            $employee->firm_id = Input::get('firm_id');
            $employee->save();

            $user = User::find($employee->user_id);
            $user->email = Input::get('email');
            $user->password = bcrypt(Input::get('password'));
            $user->save();

            // redirect
            Session::flash('message', 'Successfully updated employee!');
            return Redirect::to('employees');
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
        $employee = Employee::find($id);
        $user = User::find($employee->user_id);

        $employee->delete();
        $user->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the employee!');
        return Redirect::to('employees');
    }

    /**
     * Gets the hours for currently logged in employee
     *
     * @return mixed
     */
    public function getMonthHours(){
        $user = \Auth::user();
        $employee = Employee::where('user_id', $user->id)->first();

        return $employee->geHoursPerDayForMonth($employee->id);
    }

    /**
     * Gets all hours of all employees at firm which is currently logged in
     * Includes the wage
     *
     * @return array
     */
    public function getMonthlyReportWage(){
        $user = \Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        $employees = $admin->firm->employee;

        $data = array ();

        foreach ($employees as $employee ){
            $hours = $employee->geHoursPerDayForMonth($employee->id);
            $data[$employee->wage] = $hours;
        }

        return $data;
    }

    /**
     * Gets all hours of all employees at firm which is currently logged in
     * Includes name instead of wage
     *
     * @return array
     */
    public function getMonthlyReport(){
        $user = \Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        $employees = $admin->firm->employee;

        $data = array ();

        foreach ($employees as $employee ){
            $hours = $employee->geHoursPerDayForMonth($employee->id);
            $data[$employee->fname.' '.$employee->lname] = $hours;
        }

        return $data;
    }

    /**
     * Gets finance report for all employees of current firm
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employeesFinance(){
        $user = \Auth::user();
        $admin = Admin::where('user_id', $user->id)->first();

        $employees = $admin->firm->employee;

        foreach ($employees as $employee ){
            $hours = $employee->getHoursMonth($employee->id);
            $employee['monthly_hours'] = $hours;
        }

        $data = array (
            'employees' => $employees
        );

        return view('finances.expenditures.employee', $data);
    }
}
