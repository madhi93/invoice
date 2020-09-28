
@extends('layouts.app2')

@section('content')
    <div class="container">
    <table>
        <tr>
            <th>S.no</th>
            <th>Provider name </th>
            <th>participate name</th>
            <th>Invoice number</th>
            <th> Invoice Date</th>
            <th>Lines added </th>
        </tr>

        @foreach($invoices as $key => $invoice)
            <tr>
            <td>{{$invoice->id}}</td>
            <td>{{$invoice->provider_name}} </td>
            <td>{{$invoice->participate_name}}</td>
            <td>{{$invoice->invoice_no}}</td>
            <td> {{$invoice->invoice_date}}</td>
            <td>{{$invoice->invoicelist_count}} </td>
            </tr>
        @endforeach
    </table>


    </div>
@endsection




