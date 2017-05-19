@extends('master3')

@section('content')
    <div class="box-footer clearfix">
        <h3>Refused Loans</h3>
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

            @foreach($rloans as $pend)
                <tr>
                    <form method="post" action="{{route('details')}}">
                        {{csrf_field()}}
                        <td>{{$pend->surname}}</td>
                        <td>{{$pend->firstname}}</td>
                        <td>{{$pend->email}}</td>
                        <td>{{$pend->telephone_mobile}}</td>
                        <td><span>GHC </span>{{$pend->amount_requested}}</td>
                        <td><input name="email" value="{{$pend->email}}" hidden></td>
                        <td><input name="id" value="{{$pend->id}}" hidden></td>
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
                <form method="get" action="{{route('export_pdf')}}">
                    {{csrf_field()}}
                    <input value="refused" name="function" hidden>
                    <button type="submit" class="btn btn-primary">Print</button>
                    &nbsp;&nbsp;
                </form>
            </th>
            <th>
                <form class="form-horizontal" method="get" action="{{route('export_excel')}}">
                    {{csrf_field()}}
                    <input value="refused" hidden name="function">
                    <select class="" name="type">
                        <option value="xlsx">Export as xlsx</option>
                        <option value="xls">Export as xls</option>
                        <option value="csv">Export as csv</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Export</button>
                </form>
            </th>
        </table>
    </div>
@stop
