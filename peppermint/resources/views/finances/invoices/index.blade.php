@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron">
                <h1><span class="glyphicon glyphicon-file" aria-hidden="true"></span> Invoices</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-mid-2">
            <a style="margin-bottom: 20px;" type="button" class="btn btn-primary" href="/finances/invoices/create">Create Invoice</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table data-table table-striped table-hover">
                <thead>
                    <th>Invoice No.</th>
                    <th>Bill Total</th>
                    <th>Received</th>
                    <th>Sent</th>
                    <th class="no-sort"></th>
                    <th class="no-sort"></th>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{$invoice->id}}</td>
                            <td>{{$invoice->amount_billed}}</td>
                            <td>{{$invoice->sent}}</td>
                            <td>{{$invoice->received}}</td>

                            <td style="width: 49px;"><a href="/finances/invoices/{{$invoice->id}}/edit" class="btn btn-default btn-xs">Edit</a></td>
                            <td style="width: 63px;">
                                {{ Form::open(array('url' => '/finances/invoices/' . $invoice->id)) }}
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

