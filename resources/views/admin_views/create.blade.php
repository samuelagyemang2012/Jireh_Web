@extends('master3')

@section('content')
    {{--<section class="col-lg-1 connectedSortable"></section>--}}
    @if(count($errors))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="col-lg-4 connectedSortable">

        <form method="post" action="{{route('add_admin')}}">
            {{csrf_field()}}
            <label>Surname</label>
            <input type="text" class="form-control" name="surname">

            <label>Firstname</label>
            <input type="text" class="form-control" name="firstname">

            <label>Email</label>
            <input type="text" class="form-control" name="email">

            <label>Password</label>
            <input type="password" class="form-control" name="password">

            <label>Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password">

            <br>

            <button type="submit" class=" btn btn-success">Submit</button>
        </form>

    </section>
@stop