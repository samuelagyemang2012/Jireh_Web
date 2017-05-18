@extends('master3')

@section('content')
    <div class="box-footer clearfix">
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

            @foreach($pending as $pend)
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
                <button class="btn btn-sm btn-primary">Print</button>&nbsp;
            </th>
            <th>
                <button class="btn btn-sm btn-primary">Download</button>
            </th>
            </thead>
        </table>
    </div>
@stop
