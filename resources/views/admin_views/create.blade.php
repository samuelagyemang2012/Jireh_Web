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

    @if (session('status'))
        <div class="alert alert-success">
            <p>{{ session('status') }}</p>
        </div>
    @endif

    <section class="col-lg-4 connectedSortable">

        <form method="post" action="{{route('add_admin')}}">
            {{csrf_field()}}
            <label>Surname</label>
            <input type="text" class="form-control" name="surname" required value="{{old('surname')}}">

            <label>Firstname</label>
            <input type="text" class="form-control" name="firstname" required value="{{old('firstname')}}">

            <label>Email</label>
            <input type="text" class="form-control" name="email" required value="{{old('email')}}">

            <label>Password</label>
            <input type="password" class="form-control" name="password"  required>

            <label>Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" required>

            <br>

            <button type="submit" class=" btn btn-success">Submit</button>
        </form>

    </section>
@stop