<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
            Customer Debt status
        </div>
        <div class="panel-body">
            <h1 class="title text-center">Customer Debt Status</h1>
            <h3 class="title text-center"><u>Customer Details</u></h3>
            <div class="row">
                <div class="col-md-6">
                    <p><b>First Name: </b>{{$profile->first_name}}</p>
                    <p><b>Email: </b>{{ $profile->email }}</p>
                    <p><b>Address: </b>{{ $profile->address }}</p>
                </div>
                <div class="col-md-6">
                    <p><b>Last Name: </b>{{$profile->last_name}}</p>
                    <p><b>Phone Number: </b>{{ $profile->phone }}</p>
                    <p><b>National Id: </b>{{ $profile->national_id }}</p>
                </div>
            </div>
            <h3 class="title text-center"><u>Debt Report</u></h3>
            <h3 class="title pull-right">Total Debt: ksh. {{$total_debt}}</h3>
            <table class="table table-condensed">
                <tr>
                    <th>#</th>
                    <th>Amount</th>
                    <th>Date Credited</th>
                </tr>
                @foreach($debts as $debt)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>Ksh. {{$debt->amount}}</td>
                        <td>{{$debt->date_credited}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>