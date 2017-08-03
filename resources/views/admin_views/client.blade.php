@extends('master3')

@section('content')

    <div class="container">
        <div class="container">
            {{--            <h1>{{$data->pic}}</h1>--}}
            <img src="uploads/{{$data->pic}}" height="200px" width="200px">
        </div>
    </div>

    <div class="box-footer ">
        <table class="table table-bordered">
            <thead style="background-color: #222D32; color: #ffffff">
            <th>Personal Details</th>
            </thead>

            <thead>
            <th>Surname:</th>
            <th>{{$data->surname}}</th>
            </thead>

            <thead>
            <th>Firstname:</th>
            <th>{{$data->firstname}}</th>
            </thead>

            <thead>
            <th>Email:</th>
            <th>{{$data->email}}</th>
            </thead>

            <thead>
            <th>Date of Birth:</th>
            <th>{{$data->date_of_birth}}</th>
            </thead>

            <thead>
            <th>Residential Address:</th>
            <th>{{$data->residential_address}}</th>
            </thead>

            <thead>
            <th>Mailing Address:</th>
            <th>{{$data->mailing_address}}</th>
            </thead>

            <thead>
            <th>Telephone (Mobile):</th>
            <th>{{$data->telephone_mobile}}</th>
            </thead>

            <thead>
            <th>Telephone (Official):</th>
            <th>{{$data->telephone_official}}</th>
            </thead>

            <thead>
            <th>Occupation:</th>
            <th>{{$data->occupation}}</th>
            </thead>

            <thead>
            <th>Position Held:</th>
            <th>{{$data->position_held}}</th>
            </thead>

            <thead>
            <th>Nationality:</th>
            <th>{{$data->nationality}}</th>
            </thead>
        </table>
    </div>
    <br>

    <div class="box-footer ">
        <table class="table table-bordered">

            <thead style="background-color: #222D32; color: #ffffff">
            <th>Loan Details</th>
            </thead>

            <thead>
            <th>Net Monthly Salary:</th>
            <th>GHC {{$data->net_monthly_salary}}</th>
            </thead>

            <thead>
            <th>Other Source of Income:</th>
            <th> {{$data->other_source}}</th>
            </thead>

            <thead>
            <th>Bank:</th>
            <th>{{$data->bank_branch}}</th>
            </thead>

            <thead>
            <th>Date:</th>
            <th>{{$data->salary_date}}</th>
            </thead>

            <thead>
            <th>Number of Current Loans:</th>
            <th>{{$data->num_cur_loans}}</th>
            </thead>

            <thead>
            <th>Total Monthly Payments:</th>
            <th>{{$data->total_monthly_payments}}</th>
            </thead>

            <thead>
            <th>Name of Institution:</th>
            <th>{{$data->name_of_insti}}</th>
            </thead>

            <thead>
            <th>Amount Requested:</th>
            <th>GHC {{$data->amount_requested}}</th>
            </thead>

            <thead>
            <th>Loan Period:</th>
            <th>{{$data->loan_period}}</th>
            </thead>

            <thead>
            <th>Purpose of Loan (Official):</th>
            <th>{{$data->purpose_of_loan}}</th>
            </thead>

            <thead>
            <th>Collateral Details:</th>
            <th>{{$data->collateral_details}}</th>
            </thead>

            <thead>
            <th>Cash Collection Service:</th>
            <th>{{$data->cash_collection_service == 4 ?'YES':''}}</th>
            <th>{{$data->cash_collection_service == 5 ? 'NO':''}}</th>
            </thead>
        </table>
    </div>
    <br>

    <div class="box-footer">
        <table class="table table-bordered">
            <thead style="background-color: #222D32; color: #ffffff">
            <th>Witness Details</th>
            </thead>

            <thead>
            <th>Witness Name:</th>
            <th>{{$data->witness_name}}</th>
            </thead>

            <thead>
            <th>Witness Employer:</th>
            <th>{{$data->witness_employer}}</th>
            </thead>

            <thead>
            <th>Witness Telephone:</th>
            <th>{{$data->witness_tel}}</th>
            </thead>
        </table>

    </div>
@stop