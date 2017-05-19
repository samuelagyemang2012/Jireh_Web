@extends('master3')

@section('content')
    <div class="box-footer clearfix">
        <h3>All Loans</h3>
        <table class="table">
            <thead>
            <tr>
                <th>Surname</th>
                <th>Firstname</th>
                <th>Email</th>
                <th>Telephone (Mobile)</th>
                <th>Amount Requested</th>
                <th></th>
                <th></th>
                {{--<th></th>--}}
            </tr>
            </thead>
            <tbody>

            @foreach($all as $a)
                <tr>
                    <form method="post" action="{{route('details')}}">
                        {{csrf_field()}}
                        <td>{{$a->surname}}</td>
                        <td>{{$a->firstname}}</td>
                        <td>{{$a->email}}</td>
                        <td>{{$a->telephone_mobile}}</td>
                        <td><span>GHC </span>{{$a->amount_requested}}</td>
                        <td><input name="email" value="{{$a->email}}" hidden></td>
                        <td><input name="id" value="{{$a->id}}" hidden></td>
                        <td>
                            <button type="submit" class="btn btn-sm btn-primary">More Details</button>
                        </td>
                    </form>
                </tr>
            @endforeach

            </tbody>
        </table>

        <table>
            <thead>
            <th>
                <a href="" class="btn btn-primary">Print</a>
                &nbsp;&nbsp;&nbsp;
            </th>
            <th>
                <form class="form-horizontal" method="get" action="{{route('export_excel')}}">
                    {{csrf_field()}}
                    <input value="all_loans" hidden name="function">
                    <select class="" name="type">
                        <option value="xlsx">Export as xlsx</option>
                        <option value="xls">Export as xls</option>
                        <option value="csv">Export as csv</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Export</button>
                </form>
            </th>

            </thead>
        </table>
    </div>
    {{--<hr>--}}
@stop
