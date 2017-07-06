@extends('master3')

@section('content')
    <div class="box-footer clearfix">
        <h3>All Clients</h3>
        <table class="table" id="mytable">
            <thead>
            <th>Surname</th>
            <th>Firstname</th>
            <th>Email</th>
            {{--<th>Telephone (Mobile)</th>--}}
            <th></th>
            </thead>

            <tbody>
            @foreach($users as $u)
                <tr>
                    <form method="get" action="{{route('single')}}">
                        {{csrf_field()}}
                        <td>{{$u->surname}}</td>
                        <td>{{$u->firstname}}</td>
                        <td>{{$u->email}}</td>
                        <td></td>
                        <td><input name="email" value="{{$u->email}}" hidden></td>
                        <td><input name="id" value="{{$u->id}}" hidden></td>
                        <td>
                            <button class="btn btn-sm btn-primary" type="submit">More Details</button>
                        </td>
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="container">
            {{$users->links()}}
        </div>
    </div>
@stop