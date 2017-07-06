@extends('master3')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            <p>{{ session('status') }}</p>
        </div>
    @endif



    <div class="box-footer clearfix">
        <h3>Pending Loans</h3>
        <table class="table table-responsive">

            <thead style="">
            <th class="thead">Surname</th>
            <th class="thead">First Name</th>
            <th class="thead">Amount Requested</th>
            <th class="thead">Telephone (Mobile)</th>
            <th class="thead">Date Issued</th>
            <th></th>
            </thead>

            <tbody>

            @foreach($pending as $pend)
                <tr>
                    <form method="get" action="{{route('details')}}">
                        {{csrf_field()}}

                        <td>{{$pend->surname}}</td>
                        <td>{{$pend->firstname}}</td>
                        <td>{{$pend->amount_requested}}</td>
                        <td>{{$pend->telephone_mobile}}</td>
                        <td>{{$pend->date_applied}}</td>

                        {{--<td>{{$pend->date_applied}}</td>--}}

                        <input hidden value="{{$pend->email}}" name="email">
                        <input hidden value="{{$pend->id}}" name="id">
                        <td>
                            <button type="submit" class="btn btn-primary">More Details</button>
                        </td>
                    </form>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <div class="container">
        {{$pending->link()}}
    </div>
@stop

