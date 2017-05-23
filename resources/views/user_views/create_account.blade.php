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

                    <label>Gender</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <br>

                    <label>Surname</label>
                    <div>
                        <input type="text" class="form-control" name="surname" id="surname" required
                                value="{{old('surname')}}" onblur="validate('surname')" min="2">
                    </div>
                    <br>

                    <label>Firstname</label>
                    <div>
                        <input type="text" class="form-control" name="firstname" id="firstname" required
                                value="{{old('firstname')}}" onblur="validate('firstname')"
                               min="2">
                    </div>
                    <br>

                    <label>Other names</label>
                    <div>
                        <input type="text" class="form-control" name="othernames" id="othernames"
                               value="{{old('othernames')}}">
                    </div>
                    <br>

                    <label>Name of Spouse</label>
                    <div>
                        <input type="text" class="form-control" name="spousename" id="spousename"
                               value="{{old('spousename')}}">
                    </div>
                    <br>

                    <label>Spouse Address</label>
                    <div>
                        <input type="text" class="form-control" name="saddress" id="saddress"
                                 value="{{old('saddress')}}" min="">
                    </div>
                    <br>

                    <label>Spouse Mobile Number</label>
                    <div>
                        <input type="tel" class="form-control" name="stel" id="stel" min="10" value="{{old('stel')}}">
                    </div>
                    <br>

                    <label>Occupation of Spouse</label>
                    <div>
                        <input type="text" class="form-control" name="soccup" id="soccup" min="10"
                               value="{{old('soccup')}}">
                    </div>
                    <br>

                    <label>Number of Children</label>
                    <div>
                        <input type="number" class="form-control" name="num_children" id="numchildren" required
                               value="{{old('num_children')}}">
                    </div>
                    <br>

                    <label>Residential Address</label>
                    <div>
                        <input type="text" class="form-control" name="residential_address" id="raddress" required
                               value="{{old('residential_address')}}" min="6" onblur="validate('raddress')">
                    </div>
                    <br>

                    <label>Mailing Address</label>
                    <div>
                        <input type="text" class="form-control" name="mailing_address" id="maddress" required
                               value="{{old('mailing_address')}}" min="6" onblur="validate('maddress')">
                    </div>
                    <br>

                    <label>Telephone(Mobile)</label>
                    <div>
                        <input type="tel" class="form-control" name="telephone_mobile" id="telmob" min="10" required
                               value="{{old('telephone_mobile')}}" onblur="validate('telmob')">
                    </div>
                    <br>

                    <label>Telephone(Official)</label>
                    <div>
                        <input type="tel" name="telephone_official" class="form-control" id="teloff" min="10" required
                               value="{{old('telephone_official')}}" onblur="validate('teloff')">
                    </div>
                    <br>

                    <label>Date of Birth</label>
                    <div>
                        <input type="date" class="form-control" name="date_of_birth" id="dob" required
                               value="{{old('date_of_birth')}}" onblur="validate('dob')">
                    </div>
                    <br>

                    <label>Email</label>
                    <div>
                        <input type="email" class="form-control" name="email" id="email" required
                               value="{{old('email')}}" min="6" onblur="validate('email')">
                    </div>
                    <br>

                    <label>Occupation</label>
                    <div>
                        <input type="text" class="form-control" name="occupation" id="occupation" required
                               value="{{old('occupation')}}" min="5" onblur="validate('occupation')">
                    </div>
                    <br>

                    <label>Position Held</label>
                    <div>
                        <input type="text" class="form-control" name="position" id="position" required
                               value="{{old('position')}}" min="5" onblur="validate('position')">
                    </div>
                    <br>

                    <label>Nationality</label>
                    <div>
                        <input type="text" class="form-control" name="nationality" id="nationality" required
                               value="{{old('nationality')}}" min="5" onblur="validate('nationality')">
                    </div>
                    <br>

                    <label>Number of Years in Current Employment</label>
                    <div>
                        <input type="number" class="form-control" name="numyears" id="numyears" required
                               value="{{old('numyears')}}" min="1" onblur="validate('numyears')">
                    </div>
                    <br>

                    <label>Employer Name</label>
                    <div>
                        <input type="text" class="form-control" name="employer_name" id="empname" required
                               value="{{old('employer_name')}}" min="5" onblur="validate('empname')">
                    </div>
                    <br>

                    <label>Employer Address</label>
                    <div>
                        <input type="text" class="form-control" name="employer_address" id="empaddress" required
                               value="{{old('employer_address')}}" min="5" onblur="validate('empaddress')">
                    </div>
                    <br>

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
                        <input type="text" class="form-control" name="identification_number" id="idnum" required
                               value="{{old('identification_number')}}" min="5" onblur="validate('idnum')">
                    </div>
                    <br>

                    <label>Date of Issue</label>
                    <div>
                        <input type="date" class="form-control" name="issuedate" id="issuedate" required
                               value="{{old('issuedate')}}" onblur="validate('issuedate')">
                    </div>
                    <br>

                    <label>Expiry Date</label>
                    <div>
                        <input type="date" class="form-control" name="expirydate" id="expirydate" required
                               value="{{old('expirydate')}}" onblur="validate('expirydate')">
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
                        <input type="text" class="form-control" name="hometown" id="hometown" required
                               value="{{old('hometown')}}" min="5" onblur="validate('hometown')">
                    </div>
                    <br>

                    <label>Social Security Number</label>
                    <div>
                        <input type="text" class="form-control" name="social_security" id="scnumber" required
                               value="{{old('social_security')}}" min="5" onblur="validate('scnumber')">
                    </div>
                    <br>

                    <label>Number of Member in Household</label>
                    <div>
                        <input type="number" class="form-control" name="numhousehold" id="numhousehold" required
                               value="{{old('numhousehold')}}" min="1" onblur="validate('numhousehold')">
                    </div>
                    <br>

                    <label>Number of Dependants</label>
                    <div>
                        <input type="number" class="form-control" name="numdependants" id="numdependants" required
                               value="{{old('numdependants')}}" min="1" onblur="validate('numdependants')">
                    </div>
                    <br>

                    <label>Father's Name</label>
                    <div>
                        <input type="text" class="form-control" name="father" id="father" required
                               value="{{old('father')}}" min="2" onblur="validate('father')">
                    </div>
                    <br>

                    <label>Mother's Name</label>
                    <div>
                        <input type="text" class="form-control" name="mother" id="mother" required
                               value="{{old('mother')}}" min="2" onblur="validate('mother')">
                    </div>
                    <br>

                    <label>Next of Kin's Name</label>
                    <div>
                        <input type="text" class="form-control" name="kname" id="kname" required
                               value="{{old('kname')}}" min="2" onblur="validate('kname')">
                    </div>
                    <br>

                    <label>Next of Kin's Address</label>
                    <div>
                        <input type="text" class="form-control" name="kaddress" id="kaddress" required
                               value="{{old('kaddress')}}" min="5" onblur="validate('kaddress')">
                    </div>
                    <br>

                    <label>Next of Kin's Mobile Number</label>
                    <div>
                        <input type="tel" class="form-control" name="ktel" id="ktel" min="10" required
                               value="{{old('ktel')}}" min="10" onblur="validate('ktel')">
                    </div>
                    <br>

                    <label>Relationship to Kin's Name</label>
                    <div>
                        <input type="text" class="form-control" name="krel" id="krel" required value="{{old('krel')}}"
                               min="3" onblur="validate('krel')">
                    </div>
                    <br>

                    {{--<label>Username</label>--}}
                    {{--<div>--}}
                    {{--<input type="text" class="form-control" name="username" id="username" required>--}}
                    {{--</div>--}}
                    {{--<br>--}}

                    <label>Password</label>
                    <div>
                        <input type="password" class="form-control" name="password" id="password" required min="6"
                               onblur="validate('password')">
                    </div>
                    <br>

                    <label>Confirm Password</label>
                    <div>
                        <input type="password" class="form-control" name="cpassword" id="cpassword" required min="6"
                               onblur="validate('cpassword')">
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
                        <input type="file" class="form-control" name="pic" id="pic" required value="{{old('pic')}}"
                               onblur="validate('pic')">
                    </div>
                    <br>
                    <br>

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