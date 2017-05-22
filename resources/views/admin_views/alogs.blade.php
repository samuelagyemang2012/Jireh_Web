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

            @foreach($alogs as $a)
                <tr>
                    <td>{{$a->done_by}}</td>
                    <td>{{$a->message}}</td>
            <td>{{$a->created_at}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@stop
