@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('customers') }}">Customers Profiles</a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('customer-create') }}">Add Customer Profile</a>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('find_customer') }}">Find Customer Debt status</a>
                        </div>
                        @if (Auth::user()->role == 'roleB')
                            <div class="col-md-6">
                                <a class="btn btn-link" href="{{ route('debtors-report') }}">Debtors Report</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
