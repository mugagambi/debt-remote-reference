@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Find customer debt status</div>
                    <div class="body">
                        <h1 class="title text-center">Find Customer Debt Status</h1>
                        <form class="form-horizontal" role="form" method="POST">
                            {{csrf_field()}}
                            <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
                                <label for="search" class="col-md-4 control-label">Type of Search Key</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="search">
                                        <option value="phone">Phone Number</option>
                                        <option value="national_id">National ID</option>
                                    </select>

                                    @if ($errors->has('search'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('search') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                <label for="key" class="col-md-4 control-label">Search Key</label>

                                <div class="col-md-6">
                                    <input id="key" type="text" class="form-control" name="key" value="{{ old('key') }}" required autofocus>

                                    @if ($errors->has('key'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('key') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Search Customer
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection