@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Customer Profiles
                                <a href="{{ route('customer-create') }}" class="pull-right">Add Customer profile</a>
                            </div>
                            <div class="panel-body">
                                <h1 class="title text-center">Customer Profiles</h1>
                                <table class="table table-condensed">
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Nation Id</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th colspan="3">Actions</th>
                                    </tr>
                                    @foreach($profiles as $profile)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $profile->first_name }}</td>
                                            <td>{{ $profile->last_name }}</td>
                                            <td>{{ $profile->national_id }}</td>
                                            <td>{{ $profile->phone }}</td>
                                            <td>{{ $profile->email }}</td>
                                            <td>{{ $profile->address }}</td>
                                            <td><a href="{{ route('customer-edit', ['$profile' => $profile->id]) }}" class="btn btn-primary btn-sm" title="Edit customer profile" role="button">Edit</a> </td>
                                            <td><a href="{{ route('debt_status', ['$profile' => $profile->id]) }}" class="btn btn-default btn-sm" title="View Customer debt status" role="button">Debt</a> </td>
                                            <td><a href="{{ route('customer-delete', ['$profile' => $profile->id]) }}" class="btn btn-danger btn-sm" title="remove customer profile" role="button">Delete</a> </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
            </div>
        </div>
    </div>
@endsection