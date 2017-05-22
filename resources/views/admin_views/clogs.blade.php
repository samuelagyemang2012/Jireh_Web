@extends('master3')


@section('content')

    <div class="box-footer clearfix">
        {{--<h3>All Loans</h3>--}}
        <table class="table">
            <thead>
            <tr>
                <th>By</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
            </thead>

            <tbody>

            @foreach($clogs as $c)
                <tr>
                    <td>{{$c->done_by}}</td>
                    <td>{{$c->message}}</td>
                    <td>{{$c->created_at}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <div class="container">
        {{$clogs->links()}}
    </div>
@stop