@extends('master')

@section('header')
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <h2>Create Account</h2>
                <hr>
                <br>

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
                    <div class="alert alert-danger">
                        <p>{{ session('status') }}</p>
                    </div>
                @endif

            </div>
            <div class="col-4"></div>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4"></div>

            <div class="col-4">
                <form class="form-horizontal" action="/client" method="post">
                    {{csrf_field()}}
                    <div>
                        <label>Title</label>
                        <select name="title" id="title" class="form-control">
                            <option value="1">MR</option>
                            <option value="2">MISS</option>
                            <option value="3">MRS</option>
                            <option value="4">DR</option>
                            <option value="5">REV</option>
                            <option value="6">OTHER</option>
                        </select>
                    </div>
                    <br>

                    <label>Surname</label>
                    <div>
                        <input type="text" class="form-control" name="surname" id="surname">
                    </div>
                    <br>

                    <label>Firstname</label>
                    <div>
                        <input type="text" class="form-control" name="firstname" id="firstname" required>
                    </div>
                    <br>

                    <label>Other names</label>
                    <div>
                        <input type="text" class="form-control" name="othernames" id="othernames">
                    </div>
                    <br>

                    <label>Name of Spouse</label>
                    <div>
                        <input type="text" class="form-control" name="spousename" id="spousename" required>
                    </div>
                    <br>

                    <label>Number of Children</label>
                    <div>
                        <input type="number" class="form-control" name="num_children" id="numchildren">
                    </div>
                    <br>

                    <label>Residential Address</label>
                    <div>
                        <input type="text" class="form-control" name="residential_address" id="raddress" required>
                    </div>
                    <br>

                    <label>Mailing Address</label>
                    <div>
                        <input type="text" class="form-control" name="mailing_address" id="maddress" required>
                    </div>
                    <br>

                    <label>Telephone(Mobile)</label>
                    <div>
                        <input type="tel" class="form-control" name="telephone_mobile" id="telmob" min="10" required>
                    </div>
                    <br>

                    <label>Telephone(Official)</label>
                    <div>
                        <input type="tel" name="telephone_official" class="form-control" id="teloff" min="10" required>
                    </div>
                    <br>

                    <label>Date of Birth</label>
                    <div>
                        <input type="date" class="form-control" name="date_of_birth" id="dob" required>
                    </div>
                    <br>

                    <label>Email</label>
                    <div>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <br>

                    <label>Occupation</label>
                    <div>
                        <input type="text" class="form-control" name="occupation" id="occupation" required>
                    </div>
                    <br>

                    <label>Nationality</label>
                    <div>
                        <input type="text" class="form-control" name="nationality" id="nationality" required>
                    </div>
                    <br>

                    <label>Employer Name</label>
                    <div>
                        <input type="text" class="form-control" name="employer_name" id="empname" required>
                    </div>
                    <br>

                    <label>Employer Address</label>
                    <div>
                        <input type="text" class="form-control" name="employer_address" id="empaddress" required>
                    </div>
                    <br>

                    {{--<label>Mailing Address</label>--}}
                    {{--<div>--}}
                    {{--<input type="text" class="form-control" name="maddress" id="maddress" required>--}}
                    {{--</div>--}}
                    {{--<br>--}}

                    <label>Marital Status</label>
                    <select name="marital_status" id="mstatus" class="form-control">
                        <option value="1">MARRIED</option>
                        <option value="2">DIVORCED</option>
                        <option value="3">SINGLE</option>
                        <option value="4">OTHER</option>
                    </select>
                    <br>

                    <label>Source of Funds</label>
                    <select name="source_of_funds" id="sof" class="form-control">
                        <option value="1">SALARY</option>
                        <option value="2">TRADING</option>
                        <option value="3">INVESTMENT</option>
                        <option value="4">OTHER</option>
                    </select>
                    <br>

                    <label>Monthly Income (GHS)</label>
                    <select name="monthly_income" id="mincome" class="form-control">
                        <option value="1">1---1000</option>
                        <option value="2">1001---2000</option>
                        <option value="3">2001---5001</option>
                        <option value="4">5001 Plus</option>
                    </select>
                    <br>

                    <label>Identification</label>
                    <select name="identification" id="identification" class="form-control">
                        <option value="1">PASSPORT</option>
                        <option value="2">VOTER</option>
                        <option value="3">DRIVER'S LICENSE</option>
                        <option value="4">OTHER</option>
                    </select>
                    <br>

                    <label>ID Number</label>
                    <div>
                        <input type="text" class="form-control" name="identification_number" id="idnum" required>
                    </div>
                    <br>

                    <label>Date of Issue</label>
                    <div>
                        <input type="date" class="form-control" name="issuedate" id="issuedate" required>
                    </div>
                    <br>

                    <label>Expiry Date</label>
                    <div>
                        <input type="date" class="form-control" name="expirydate" id="expirydate" required>
                    </div>
                    <br>

                    <label>Literacy</label>
                    <select name="literacy" id="literacy" class="form-control">
                        <option value="1">UNIVERSITY</option>
                        <option value="2">COLLEGE/POLYTECHNIC</option>
                        <option value="3">SECONDARY</option>
                        <option value="4">PRIMARY</option>
                        <option value="5">NO FORMAL EDUCATION</option>
                        <option value="6">PRIMARY</option>
                    </select>
                    <br>

                    <label>Hometown</label>
                    <div>
                        <input type="text" class="form-control" class="form-control" name="hometown" id="hometown"
                               required>
                    </div>
                    <br>

                    <label>Social Security Number</label>
                    <div>
                        <input type="text" class="form-control" name="social_security" id="scnumber" required>
                    </div>
                    <br>

                    <label>Number of Member in Household</label>
                    <div>
                        <input type="number" class="form-control" name="numhousehold" id="numhousehold" required>
                    </div>
                    <br>

                    <label>Number of Dependants</label>
                    <div>
                        <input type="number" class="form-control" name="numdependants" id="numdependants" required>
                    </div>
                    <br>

                    <label>Father's Name</label>
                    <div>
                        <input type="text" class="form-control" name="father" id="father" required>
                    </div>
                    <br>

                    <label>Mother's Name</label>
                    <div>
                        <input type="text" class="form-control" name="mother" id="mother" required>
                    </div>
                    <br>

                    <label>Next of Kin's Name</label>
                    <div>
                        <input type="text" class="form-control" name="kname" id="kname" required>
                    </div>
                    <br>

                    <label>Next of Kin's Address</label>
                    <div>
                        <input type="text" class="form-control" name="kaddress" id="kaddress" required>
                    </div>
                    <br>

                    <label>Next of Kin's Mobile Number</label>
                    <div>
                        <input type="tel" class="form-control" name="ktel" id="ktel" min="10" required>
                    </div>
                    <br>

                    <label>Relationship to Kin's Name</label>
                    <div>
                        <input type="text" class="form-control" name="krel" id="krel" required>
                    </div>
                    <br>

                    <label>Spouse Address</label>
                    <div>
                        <input type="text" class="form-control" name="saddress" id="saddress" required>
                    </div>
                    <br>

                    <label>Spouse Mobile Number</label>
                    <div>
                        <input type="tel" class="form-control" name="stel" id="stel" min="10" required>
                    </div>
                    <br>

                    <label>Username</label>
                    <div>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <br>

                    <label>Password</label>
                    <div>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <br>

                    <label>Confirm Password</label>
                    <div>
                        <input type="password" class="form-control" name="cpassword" id="cpassword" required>
                    </div>
                    <br>

                    <h2>Declaration</h2>
                    <p>
                        I/We certify that the above statements are true and complete. By signing below, I/We agree to
                        abide by
                        the
                        terms
                        and conditions of this account and agree to be bound by them.
                    </p>
                    <br>


                    <img src="" height="200px" width="200px">
                    <br>
                    <br>
                    <label>Upload Picture</label>
                    <div>
                        <input type="file" class="form-control" name="pic" id="pic" required>
                    </div>
                    <br>
                    <br>
                    {{--<br>--}}
                    {{--<label>Spouse Address</label>--}}
                    <div>
                        <select name="agree" id="agree" class="form-control">
                            <option value="1">I Agree</option>
                            <option value="2">I Do Not Agree</option>
                        </select>
                    </div>
                    <br>

                    <div>
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                    </div>

                </form>
            </div>

            <div class="col-4"></div>
        </div>
    </div>
@stop