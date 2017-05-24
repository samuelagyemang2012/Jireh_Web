@extends('master3')

@section('content')

    @if(count($errors))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success">
            <p>{{ session('status') }}</p>
        </div>
    @endif

    <section class="col-lg-4 connectedSortable">
        <form method="post" action="{{route('edit_admin')}}">
            {{csrf_field()}}

            <label>Email</label>
            <input readonly type="text" class="form-control" name="email" value="{{$aemail}}">

            <label>New Password</label>
            <input type="password" class="form-control" name="password">

            <label>Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password">

            <br>

            <button type="submit" class=" btn btn-success">Submit</button>
        </form>
    </section>
@stop
