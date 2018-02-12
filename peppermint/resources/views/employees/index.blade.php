@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Employees</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="page-header">
                    <a style="margin-bottomtype="button" class="btn btn-primary" href="/employees/create">Add Employee</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table data-table table-striped table-hover">
                <thead>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>SIN</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Wage</th>
                    <th class="no-sort"></th>
                    <th class="no-sort"></th>
                    <th class="no-sort"></th>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->fname }}</td>
                            <td>{{ $employee->lname }}</td>
                            <td>{{ $employee->sin }}</td>
                            <td>{{ $employee->phone_number }}</td>
                            <td>{{ $employee->address }}</td>
                            <td>{{ $employee->wage }}</td>
                            <td style="width: 49px;"><a href="/employees/schedule/{{ $employee->id }}/edit" class="btn btn-default btn-xs">Edit Schedule</a></td>
                            <td style="width: 49px;"><a href="/employees/{{ $employee->id }}/edit" class="btn btn-default btn-xs">Edit</a></td>
                            <td style="width: 63px;">
                                {{ Form::open(array('url' => 'employees/' . $employee->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop

