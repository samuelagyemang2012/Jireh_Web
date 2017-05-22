<!DOCTYPE>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    {{--<link rel="stylesheet" href="{{asset('css\bootstrap.min.css')}}">--}}
</head>

<body>

<center><h2 style="color: #8A5241">Jireh Microfinance Ltd</h2></center>
<center><h3>{{$date}}</h3></center>
<br>
<center><h3>{{$title}}</h3></center>


<table class="table table-bordered">
    <thead>
    <th>Surname</th>
    <th>Firstname</th>
    <th>Email</th>
    <th>Telephone (Mobile)</th>
    <th>Amount Requested</th>
    </thead>

    <tbody>
    @foreach($loans as $loan)
        <tr>
            {{--<td>dsa</td>--}}
            {{--<td>dsa</td>--}}
            <td>{{$loan->surname}}</td>
            <td>{{$loan->firstname}}</td>
            <td>{{$loan->email}}</td>
            <td>{{$loan->telephone_mobile}}</td>
            <td>{{$loan->amount_requested}}</td>
        </tr>
        {{--<tr><p>dsadasd</p></tr>--}}
    @endforeach
    </tbody>
</table>
</body>
</html>
{{--@stop--}}