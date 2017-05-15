@extends('master')

@section('header')
    <div class="container">
        <div class="row">
            {{--<div class="col-4"></div>--}}

            <div class="col-12">
                <center><h2>Personal Loan Application</h2></center>
                <hr>
            </div>

            {{--<div class="col-4"></div>--}}
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-4"></div>

            <div class="col-4">
                @if(count($errors))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="col-4"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-4"></div>

            <div class="col-4">
                <br>
                @if (session('loan'))
                    <div class="alert alert-success">
                        <p>{{ session('loan') }}</p>
                    </div>
                @endif
                <br>
            </div>

            <div class="col-4"></div>
        </div>
    </div>
@stop

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-4"></div>

            <div class="col-4">
                <form class="form-horizontal" method="post" action="/loan">

                    {{csrf_field()}}
                    <br>

                    <label>Net Monthly Salary/Sales (GHS)</label>
                    <div>
                        <input type="number" class="form-control" name="num_monthly" id="net_monthly" required>
                    </div>
                    <br>

                    <label>Any Other Source of Income</label>
                    <div>
                        <input type="text" class="form-control" name="other_source" id="other_source">
                    </div>
                    <br>

                    <label>Bank/Branch</label>
                    <div>
                        <input type="text" class="form-control" name="bank" id="bank" required>
                    </div>
                    <br>

                    <label>Salary Date</label>
                    <div>
                        <input type="date" class="form-control" name="salary_date" id="salary_date" required>
                    </div>
                    <br>
                    <br>

                    <h2>LOANS</h2>
                    <hr>
                    {{--<br>--}}

                    <label>Number of Current Loans</label>
                    <div>
                        <input type="number" class="form-control" name="numloans" id="numloans" required>
                    </div>
                    <br>

                    <label>Total Monthly Payments</label>
                    <div>
                        <input type="number" class="form-control" name="total_monthly_payments"
                               id="total_monthly_payments"
                               required>
                    </div>
                    <br>

                    <label>Name of Institution(s)</label>
                    <div>
                        <input type="text" class="form-control" name="name_insti" id="name_insti" required>
                    </div>
                    <br>

                    <h2>LOAN REQUEST</h2>
                    <hr>

                    <label>Amount Requested</label>
                    <div>
                        <input type="number" class="form-control" name="amount" id="amount" required>
                    </div>
                    <br>

                    <label>Proposed Loan Period</label>
                    <div>
                        <input type="number" class="form-control" name="loan_period" id="loan_period" required>
                    </div>
                    <br>

                    <label>Purpose of Loan</label>
                    <div>
                        <textarea class="form-control" name="purpose" id="purpose" rows="3" required></textarea>
                    </div>
                    <br>

                    <label>Collateral Details</label>
                    <div>
                        <textarea class="form-control" name="collateral" id="collateral" rows="3" required></textarea>
                    </div>
                    <br>

                    <label>Cash Collection Service</label>
                    <div>
                        <select name="cash_service" class="form-control">
                            <option value="4">YES</option>
                            <option value="5">NO</option>
                        </select>
                    </div>
                    <br>

                    <h2>WITNESS</h2>
                    <hr>

                    <label>Witness' Name</label>
                    <div>
                        <input type="text" class="form-control" name="wname" id="wname" required>
                    </div>
                    <br>

                    <label>Witness' Employer</label>
                    <div>
                        <input type="text" class="form-control" name="wemployer" id="wemployer" required>
                    </div>
                    <br>

                    <label>Witness' Telephone Number</label>
                    <div>
                        <input type="tel" class="form-control" name="wtel" id="wtel" required>
                    </div>
                    <br>

                    <h2>DECLARATION</h2>
                    <hr>

                    <p style="text-align: justify">
                        I have applied for a loan as detailed above and hereby declare that information
                        given is in all respects true and accurate. I promise to repay the loan in accordance with the
                        repayment terms agreed with JIREH MICROFINANCE LTD.
                    </p>

                    <p>
                        I agree to allow JML to verify information given on this loan application form from any source.
                        In case of late payment, JIREH MICROFINANCE LTD. is entitled to follow up on payments and may
                        ask for the remaining balance inclusive of interest accrued to be paid in a lump sum without
                        recourse to the repayment installment agreed on.
                    </p>

                    <p>
                        JIREH MICROFINANCE LTD will obtain information about you from the credit bureaus to check status
                        and identity. The bureaus will record our enquiries about you.
                        JIREH MICROFINANCE shall also disclose your credit transactions to credit
                        bureau in accordance with the Credit Reporting
                        Act, 2007(Act 726)
                    </p>

                    <br>

                    <select name="agree" class="form-control">
                        <option value="1">Agree</option>
                        <option value="2">I Do Not Agree</option>
                    </select>
                    <br>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <div class="col-4"></div>
        </div>
    </div>

@stop
