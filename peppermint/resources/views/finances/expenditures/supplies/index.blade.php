@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron">
                <h1><span class="glyphicon glyphicon-tags" aria-hidden="true"></span> Supplies</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a style="margin-bottom: 20px;" type="button" class="btn btn-primary" href="/finances/expenditures/supplies/create">Add Supply</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table data-table table-striped table-hover">
                <thead>
                    <th>Type</th>
                    <th>Total Stock</th>
                    <th>Cost</th>
                    <th>In Stock</th>
                    <th>Quantity Ordered</th>
                    <th class="no-sort"></th>
                    <th class="no-sort"></th>
                </thead>
                <tbody>
                    @foreach($supplies as $supply)
                        <tr>
                            <td>{{$supply->type}}</td>
                            <td>{{$supply->total_stock}}</td>
                            <td>{{$supply->cost}}</td>
                            <td>{{$supply->in_stock}}</td>
                            <td>{{$supply->num_ordered}}</td>
                            <td style="width: 49px;"><a href="/finances/expenditures/supplies/{{$supply->id}}/edit" class="btn btn-default btn-xs">Edit</a></td>
                            <td style="width: 63px;">
                                {{ Form::open(array('url' => '/finances/expenditures/supplies/' . $supply->id, 'class' => 'pull-right')) }}
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

