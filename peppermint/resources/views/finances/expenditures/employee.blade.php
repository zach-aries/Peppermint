@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <h1><span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span> Employees Expendatures</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table id="announcements" class="table data-table table-striped table-hover" width="100%">
            <thead>
                <th>Name</th>
                <th>Wage</th>
                <th>Hours</th>
                <th>Total</th>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->fname }}, {{ $employee->lname }}</td>
                        <td style="text-align: center;">{{ $employee->monthly_hours }} h</td>
                        <td style="text-align: right;">${{ $employee->wage }}</td>
                        <td style="text-align: right;">${{ $employee->monthly_hours * $employee->wage }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    /*$(document).ready(function() {

        $.getJSON( "/finances/expenditures/employees/getmonthlyreport", function( data ) {
            //console.log(data);

            var dataset = [];
            var labels = [];

            for (var obj in data) {
                if( data.hasOwnProperty(obj) ) {
                    var e = {
                        label:obj,
                        data:data[obj].hours,
                        backgroundColor: randomColour()
                    };
                    dataset.push(e)
                }
            }

            var d = new Date();
            var n = d.getMonth();
            var y = d.getYear();

            var daysInMonth = getDaysInMonth(n,y);

            for(var i = 1; i < daysInMonth.length + 1; i++)
                labels.push(i);

            console.log(dataset);

            var e_ctx = $("#expenditures");
            var expenditures = new Chart(e_ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: dataset
                }
            });
        });
    } );*/

    /**
     * @param {int} The month number, 0 based
     * @param {int} The year, not zero based, required to account for leap years
     * @return {Date[]} List with date objects for each day of the month
     */
    /*function getDaysInMonth(month, year) {
        var date = new Date(year, month, 1);
        var days = [];
        while (date.getMonth() === month) {
            days.push(new Date(date));
            date.setDate(date.getDate() + 1);
        }
        return days;
    }

    function randomColour() {
        return '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6);
    }*/
</script>
@endsection
