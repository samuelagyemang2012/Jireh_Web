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

    <div class="box-footer clearfix">
        <div class="container">
            <div class="row">
                <div class="col-4"></div>

                <div class="col-4">
                    <form method="post" action="{{route('update')}}">
                        {{csrf_field()}}

                        <div>
                            <img src="/uploads/{{$pic}}" height="200px" width="200px">
                        </div>
                        <br>

                        <div>
                            <label>Title</label>
                            <select name="title" id="fortitle" class="form-control" onchange="for_title()"
                                    style="width: 300px">
                                {{--<option value="1" >MARRIED</option>--}}
                                <option value="1" {{$title==1 ? 'selected="selected"':''}}>MR</option>
                                <option value="2"{{$title==2 ? 'selected="selected"':''}}>MISS</option>
                                <option value="3" {{$title==3 ? 'selected="selected"':''}}>MRS</option>
                                <option value="4" {{$title==4 ? 'selected="selected"':''}}>DR</option>
                                <option value="5" {{$title==5 ? 'selected="selected"':''}}>REV</option>
                                {{--                                <option value="6" {{$title==1 ? 'selected="selected"':''}}>OTHER</option>--}}
                            </select>
                        </div>
                        <br>

                        <label>Gender</label>
                        <select name="gender" id="gender" class="form-control" style="width: 300px">
                            <option value="Male" {{$gender=='Male' ? 'selected="selected"':''}}>Male</option>
                            <option value="Female" {{$gender=='Female' ? 'selected="selected"':''}}>Female</option>
                        </select>
                        <br>

                        <label>Surname</label>
                        <div>
                            <input type="text" class="form-control" name="surname" id="surname" required
                                   value="{{$surname}}" value="{{old('surname')}}" onblur="validate('surname')" min="2"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Firstname</label>
                        <div>
                            <input type="text" class="form-control" name="firstname" id="firstname" required
                                   value="{{$firstname}}" value="{{old('firstname')}}" onblur="validate('firstname')"
                                   min="2"
                                   style="width: 300px" style="width: 300px">
                        </div>
                        <br>

                        <label>Other names</label>
                        <div>
                            <input type="text" class="form-control" name="othernames" id="othernames"
                                   value="{{$othernames}}" value="{{old('othernames')}}" style="width: 300px">
                        </div>
                        <br>

                        <label>Name of Spouse</label>
                        <div>
                            <input type="text" class="form-control" name="spousename" id="spousename"
                                   value="{{$sname}}" value="{{old('spousename')}}" style="width: 300px">
                        </div>
                        <br>

                        <label>Spouse Address</label>
                        <div>
                            <input type="text" class="form-control" name="saddress" id="saddress"
                                   value="{{$saddress}}" value="{{old('saddress')}}" min="" style="width: 300px">
                        </div>
                        <br>

                        <label>Spouse Mobile Number</label>
                        <div>
                            <input type="tel" class="form-control" name="stel" id="stel" min="10"
                                   value="{{$stel}}" value="{{old('stel')}}" style="width: 300px">
                        </div>
                        <br>

                        <label>Occupation of Spouse</label>
                        <div>
                            <input type="text" class="form-control" name="soccup" id="soccup" min="10"
                                   value="{{$soccup}}" value="{{old('soccup')}}" style="width: 300px">
                        </div>
                        <br>

                        <label>Number of Children</label>
                        <div>
                            <input type="number" class="form-control" name="num_children" id="numchildren" required
                                   value="{{$numchildren}}" value="{{old('num_children')}}" style="width: 300px">
                        </div>
                        <br>

                        <label>Residential Address</label>
                        <div>
                            <input type="text" class="form-control" name="residential_address" id="raddress" required
                                   value="{{$raddress}}" value="{{old('residential_address')}}" min="6"
                                   onblur="validate('raddress')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Mailing Address</label>
                        <div>
                            <input type="text" class="form-control" name="mailing_address" id="maddress" required
                                   value="{{$maddress}}" value="{{old('mailing_address')}}" min="6"
                                   onblur="validate('maddress')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Telephone(Mobile)</label>
                        <div>
                            <input type="tel" class="form-control" name="telephone_mobile" id="telmob" min="10" required
                                   value="{{$telmob}}" value="{{old('telephone_mobile')}}" onblur="validate('telmob')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Telephone(Official)</label>
                        <div>
                            <input type="tel" name="telephone_official" class="form-control" id="teloff" min="10"
                                   required
                                   value="{{$teloff}}" value="{{old('telephone_official')}}" onblur="validate('teloff')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Date of Birth</label>
                        <div>
                            <input type="date" class="form-control" name="date_of_birth" id="dob" required
                                   value="{{$dob}}" value="{{old('date_of_birth')}}" onblur="validate('dob')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Email</label>
                        <div>
                            <input type="email" class="form-control" name="email" id="email" required
                                   value="{{$email}}" value="{{old('email')}}" min="6" onblur="validate('email')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Occupation</label>
                        <div>
                            <input type="text" class="form-control" name="occupation" id="occupation" required
                                   value="{{$occup}}" value="{{old('occupation')}}" min="5"
                                   onblur="validate('occupation')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Position Held</label>
                        <div>
                            <input type="text" class="form-control" name="position" id="position" required
                                   value="{{$pos}}" value="{{old('position')}}" min="5" onblur="validate('position')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Nationality</label>
                        <div>
                            <input type="text" class="form-control" name="nationality" id="nationality" required
                                   value="{{$nation}}" value="{{old('nationality')}}" min="5"
                                   onblur="validate('nationality')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Number of Years in Current Employment</label>
                        <div>
                            <input type="number" class="form-control" name="numyears" id="numyears" required
                                   value="{{$numyears}}" value="{{old('numyears')}}" min="1"
                                   onblur="validate('numyears')" style="width: 300px">
                        </div>
                        <br>

                        <label>Employer Name</label>
                        <div>
                            <input type="text" class="form-control" name="employer_name" id="empname" required
                                   value="{{$empname}}" value="{{old('employer_name')}}" min="5"
                                   onblur="validate('empname')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Employer Address</label>
                        <div>
                            <input type="text" class="form-control" name="employer_address" id="empaddress" required
                                   value="{{$empaddress}}" value="{{old('employer_address')}}" min="5"
                                   onblur="validate('empaddress')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Marital Status</label>
                        <select name="marital_status" id="mstatus" class="form-control" style="width: 300px"
                                value="{{$mstatus}}">
                            <option value="1" {{$mstatus==1 ? 'selected="selected"':''}}>MARRIED</option>
                            <option value="2" {{$mstatus==2 ? 'selected="selected"':''}}>DIVORCED</option>
                            <option value="3" {{$mstatus==3 ? 'selected="selected"':''}}>SINGLE</option>
                            <option value="4" {{$mstatus==4 ? 'selected="selected"':''}}>OTHER</option>
                        </select>
                        <br>

                        <label>Source of Funds</label>
                        <select name="source_of_funds" id="sof" class="form-control" style="width: 300px">
                            <option value="1" {{$sof==1 ? 'selected="selected"':''}}>SALARY</option>
                            <option value="2"{{$sof==2 ? 'selected="selected"':''}}>TRADING</option>
                            <option value="3"{{$sof==3 ? 'selected="selected"':''}}>INVESTMENT</option>
                            <option value="4"{{$sof==4 ? 'selected="selected"':''}}>OTHER</option>
                        </select>
                        <br>

                        <label>Monthly Income (GHS)</label>
                        <select name="monthly_income" id="mincome" class="form-control" style="width: 300px"
                                value="{{$mincome}}">
                            <option value="1" {{$mincome==1 ? 'selected="selected"':''}}>1---1000</option>
                            <option value="2"{{$mincome==2 ? 'selected="selected"':''}}>1001---2000</option>
                            <option value="3"{{$mincome==3 ? 'selected="selected"':''}}>2001---5001</option>
                            <option value="4" {{$mincome==4 ? 'selected="selected"':''}}>5001 Plus</option>
                        </select>
                        <br>

                        <label>Identification</label>
                        <select name="identification" id="iden" class="form-control" style="width: 300px">
                            <option value="1" {{$identification==1 ? 'selected="selected"':''}}>PASSPORT</option>
                            <option value="2" {{$identification==2 ? 'selected="selected"':''}}>VOTER</option>
                            <option value="3" {{$identification==3 ? 'selected="selected"':''}}>DRIVER'S LICENSE
                            </option>
                            <option value="4" {{$identification==4 ? 'selected="selected"':''}}>OTHER</option>
                        </select>
                        <br>

                        <label>ID Number</label>
                        <div>
                            <input type="text" class="form-control" name="identification_number" id="idnum" required
                                   value="{{$idnum}}"
                                   value="{{old('identification_number')}}" min="5" onblur="validate('idnum')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Date of Issue</label>
                        <div>
                            <input type="date" class="form-control" name="issuedate" id="issuedate" required
                                   value="{{$issuedate}}"
                                   value="{{old('issuedate')}}" onblur="validate('issuedate')" style="width: 300px">
                        </div>
                        <br>

                        <label>Expiry Date</label>
                        <div>
                            <input type="date" class="form-control" name="expirydate" id="expirydate" required
                                   value="{{$expdate}}"
                                   value="{{old('expirydate')}}" onblur="validate('expirydate')" style="width: 300px">
                        </div>
                        <br>

                        <label>Literacy</label>
                        <select name="literacy" id="lit" class="form-control" style="width: 300px"
                                value="{{$literacy}}">
                            <option value="1" {{$literacy==1 ? 'selected="selected"':''}}>UNIVERSITY</option>
                            <option value="2" {{$literacy==2 ? 'selected="selected"':''}}>COLLEGE/POLYTECHNIC</option>
                            <option value="3" {{$literacy==3 ? 'selected="selected"':''}}>SECONDARY</option>
                            <option value="4" {{$literacy==4 ? 'selected="selected"':''}}>PRIMARY</option>
                            <option value="5" {{$literacy==5 ? 'selected="selected"':''}}>NO FORMAL EDUCATION</option>
                            <option value="6" {{$literacy==6 ? 'selected="selected"':''}}>OTHER</option>
                        </select>
                        <br>

                        <label>Hometown</label>
                        <div>
                            <input type="text" class="form-control" name="hometown" id="hometown" required
                                   value="{{$hometown}}"
                                   value="{{old('hometown')}}" min="5" onblur="validate('hometown')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Social Security Number</label>
                        <div>
                            <input type="text" class="form-control" name="social_security" id="scnumber" required
                                   value="{{$soc}}" value="{{old('social_security')}}" min="5"
                                   onblur="validate('scnumber')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Number of Member in Household</label>
                        <div>
                            <input type="number" class="form-control" name="numhousehold" id="numhousehold" required
                                   value="{{$members}}" value="{{old('numhousehold')}}" min="1"
                                   onblur="validate('numhousehold')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Number of Dependants</label>
                        <div>
                            <input type="number" class="form-control" name="numdependants" id="numdependants" required
                                   value="{{$numdep}}" value="{{old('numdependants')}}" min="1"
                                   onblur="validate('numdependants')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Father's Name</label>
                        <div>
                            <input type="text" class="form-control" name="father" id="father" required
                                   value="{{$father}}" value="{{old('father')}}" min="2" onblur="validate('father')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Mother's Name</label>
                        <div>
                            <input type="text" class="form-control" name="mother" id="mother" required
                                   value="{{$mother}}" value="{{old('mother')}}" min="2" onblur="validate('mother')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Next of Kin's Name</label>
                        <div>
                            <input type="text" class="form-control" name="kname" id="kname" required value="{{$kname}}"
                                   value="{{old('kname')}}" min="2" onblur="validate('kname')" style="width: 300px">
                        </div>
                        <br>

                        <label>Next of Kin's Address</label>
                        <div>
                            <input type="text" class="form-control" name="kaddress" id="kaddress" required
                                   value="{{$kaddress}}" value="{{old('kaddress')}}" min="5"
                                   onblur="validate('kaddress')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Next of Kin's Mobile Number</label>
                        <div>
                            <input type="tel" class="form-control" name="ktel" id="ktel" min="10" required
                                   value="{{$ktel}}" value="{{old('ktel')}}" min="10" onblur="validate('ktel')"
                                   style="width: 300px">
                        </div>
                        <br>

                        <label>Relationship to Kin's Name</label>
                        <div>
                            <input type="text" class="form-control" name="krel" id="krel" required
                                   value="{{$krel}}" value="{{old('krel')}}"
                                   min="3" onblur="validate('krel')" style="width: 300px">
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

        {{--<label>Username</label>--}}
        {{--<div>--}}
        {{--<input type="text" class="form-control" name="username" id="username" required>--}}
        {{--</div>--}}
        {{--<br>--}}

        {{--<label>Password</label>--}}
        {{--<div>--}}
        {{--<input type="password" class="form-control" name="password" id="password" required min="6" onblur="validate('password')">--}}
        {{--</div>--}}
        {{--<br>--}}

        {{--<label>Confirm Password</label>--}}
        {{--<div>--}}
        {{--<input type="password" class="form-control" name="cpassword" id="cpassword" required min="6" onblur="validate('cpassword')">--}}
        {{--</div>--}}
        {{--<br>--}}

        {{--<h2>Declaration</h2>--}}
        {{--<p>--}}
        {{--I/We certify that the above statements are true and complete. By signing below, I/We agree to--}}
        {{--abide by--}}
        {{--the--}}
        {{--terms--}}
        {{--and conditions of this account and agree to be bound by them.--}}
        {{--</p>--}}
        {{--<br>--}}


        {{--<img src="" height="200px" width="200px">--}}
        {{--<br>--}}
        {{--<br>--}}
        {{--<label>Upload Picture</label>--}}
        {{--<div>--}}
        {{--<input type="file" class="form-control" name="pic" id="pic" required value="{{old('pic')}}" onblur="validate('pic')">--}}
        {{--</div>--}}
        {{--<br>--}}
        {{--<br>--}}

    </div>
@stop