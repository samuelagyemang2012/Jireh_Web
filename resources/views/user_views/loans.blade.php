@extends('master')

@section('header')
    <div class="container">
        <div class="row">
            {{--<div class="col-4"></div>--}}

            <div class="col-12">
                <center><h2 class="myfont">Personal Loan Application</h2></center>
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

                    <label class="myfont">Net Monthly Salary/Sales (GHS)</label>
                    <div>
                        <input type="number" class="form-control" name="num_monthly" id="net_monthly" required
                               value="{{old('num_monthly')}}" onblur="validate('num_monthly','nm','1')">
                    </div>
                    <span id="nm"></span>
                    <br>

                    <label class="myfont">Any Other Source of Income</label>
                    <div>
                        <input type="text" class="form-control" name="other_source" id="other_source"
                               value="{{old('other_source')}}" onblur="validate('other_source','os','2')">
                    </div>
                    <span id="os"></span>
                    <br>

                    <label class="myfont">Bank/Branch</label>
                    <div>
                        <input type="text" class="form-control" name="bank" id="bank" required value="{{old('bank')}}"
                               onblur="validate('bank','b','2')">
                    </div>
                    <span id="b"></span>
                    <br>

                    <label class="myfont">Salary Date</label>
                    <div>
                        <input type="date" class="form-control" name="salary_date" id="salary_date" required
                               value="{{old('salary_date')}}" onblur="validate('salary_date','sd','7')">
                    </div>
                    <span id="sd"></span>
                    <br>
                    <br>

                    <h2 class="myfont">LOANS</h2>
                    <hr>
                    {{--<br>--}}

                    <label class="myfont">Number of Current Loans</label>
                    <div>
                        <input type="number" class="form-control" name="numloans" id="numloans" required
                               value="{{old('numloans')}}" onblur="validate('numloans','nl','0')">
                    </div>
                    <span id="nl"></span>
                    <br>

                    <label class="myfont">Total Monthly Payments</label>
                    <div>
                        <input type="number" class="form-control" name="total_monthly_payments"
                               id="total_monthly_payments"
                               required value="{{old('total_monthly_payments')}}"
                               onblur="validate('total_monthly_payments','tmp','0')">
                    </div>
                    <span id="tmp"></span>
                    <br>

                    <label class="myfont">Name of Institution(s)</label>
                    <div>
                        <input type="text" class="form-control" name="name_insti" id="name_insti" required
                               value="{{old('name_insti')}}" onblur="validate('name_insti','ni','2')">
                    </div>
                    <span id="ni"></span>
                    <br>

                    <h2 class="myfont">LOAN REQUEST</h2>
                    <hr>

                    <label class="myfont">Amount Requested</label>
                    <div>
                        <input type="number" class="form-control" name="amount" id="amount" required
                               value="{{old('amount')}}" onblur="validate('amount','a','1')">
                    </div>
                    <span id="a"></span>
                    <br>

                    <label class="myfont">Proposed Loan Period</label>
                    <div>
                        <input type="number" class="form-control" name="loan_period" id="loan_period" required
                               value="{{old('loan_period')}}" onblur="validate('loan_period','lp','1')">
                    </div>
                    <span id="lp"></span>
                    <br>

                    <label class="myfont">Purpose of Loan</label>
                    <div>
                        <textarea class="form-control" name="purpose" id="purpose" rows="3" required
                                  value="{{old('purpose')}}" onblur="validate('purpose','p','5')"></textarea>
                    </div>
                    <span id="p"></span>
                    <br>

                    <label class="myfont">Collateral Details</label>
                    <div>
                        <textarea class="form-control" name="collateral" id="collateral" rows="3" required
                                  value="{{old('collateral')}}" onblur="validate('collateral','c','5')"></textarea>
                    </div>
                    <span id="c"></span>
                    <br>

                    <label class="myfont">Cash Collection Service</label>
                    <div>
                        <select name="cash_service" class="form-control" value="{{old('cash_service')}}">
                            <option value="4">YES</option>
                            <option value="5">NO</option>
                        </select>
                    </div>
                    <br>

                    <h2 class="myfont">WITNESS</h2>
                    <hr>

                    <label class="myfont">Witness' Name</label>
                    <div>
                        <input type="text" class="form-control" name="wname" id="wname" required
                               value="{{old('wname')}}" onblur="validate('wname','wn','2')">
                    </div>
                    <span id="wn"></span>
                    <br>

                    <label class="myfont">Witness' Employer</label>
                    <div>
                        <input type="text" class="form-control" name="wemployer" id="wemployer" required
                               value="{{old('wemployer')}}" onblur="validate('wemployer','we','2')">
                    </div>
                    <span id="we"></span>
                    <br>

                    <label class="myfont">Witness' Telephone Number</label>
                    <div>
                        <input type="tel" class="form-control" name="wtel" id="wtel" required value="{{old('wtel')}}"
                               onblur="validate('wtel','wt','10')">
                    </div>
                    <span id="wt"></span>
                    <br>

                    <h2 class="myfont">DECLARATION</h2>
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

                    <button type="submit" class="btn btn-primary" style="background-color: #8A5241; border: none">
                        Submit
                    </button>
                </form>
            </div>

            <div class="col-4"></div>
        </div>
    </div>

@stop
