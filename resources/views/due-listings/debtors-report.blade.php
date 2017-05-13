@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Debtors Report</div>
                    <div class="panel-body">
                        <h1 class="title text-center">Debtors Report</h1>
                        <div class="col-md-5 col-md-offset-3">
                            <h3>Import Debtors From Database:</h3>
                            <div style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;">
                                <a href="{{ url('downloadExcel/xls') }}">
                                    <button class="btn btn-success btn-sm">Download Excel xls</button>
                                </a>
                                <a href="{{ url('downloadExcel/csv') }}">
                                    <button class="btn btn-success btn-sm">Download CSV</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <debtors></debtors>
    </div>
@endsection