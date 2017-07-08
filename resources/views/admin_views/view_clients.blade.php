@extends('master3')

@section('content')
    <div class="box-footer clearfix">
        {{--<h3>Client Details</h3>--}}

        <table class="table table-bordered">

            <thead style="background-color: #222D32; color: #ffffff">
            <th>Client Details</th>
            </thead>

            <thead>
            <th>Title:</th>
            <td> {{$clients->title==1 ? 'MR':''}} {{$clients->title==2 ? 'MISS':''}} {{$clients->title==3 ? 'MRS':''}} {{$clients->title==4 ? 'DR':''}} {{$clients->title==5 ? 'REV':''}}</td>
            </thead>

            <thead>
            <th>Gender:</th>
            <td>{{$clients->gender=='Male' ? 'Male':'Female'}}</td>
            </thead>

            <thead>
            <th>Surname:</th>
            <td>{{$users->surname}}</td>
            </thead>

            <thead>
            <th>Firstname:</th>
            <td>{{$users->firstname}}</td>
            </thead>

            <thead>
            <th>Othernames:</th>
            <td>{{$users->othernames}}</td>
            </thead>

            <thead>
            <th>Name of Spouse</th>
            <td>{{$spouses->name}}</td>
            </thead>

            <thead>
            <th>Address of Spouse</th>
            <td>{{$spouses->address}}</td>
            </thead>

            <thead>
            <th>Number of Spouse</th>
            <td>{{$spouses->number}}</td>
            </thead>

            <thead>
            <th>Occupation of Spouse</th>
            <td>{{$spouses->spouse_occupation}}</td>
            </thead>

            <thead>
            <th>Number of children</th>
            <td>{{$clients->num_children}}</td>
            </thead>

            <thead>
            <th>Residential Address</th>
            <td>{{$clients->residential_address}}</td>
            </thead>

            <thead>
            <th>Mailing Address</th>
            <td>{{$clients->mailing_address}}</td>
            </thead>

            <thead>
            <th>Telephone (Mobile)</th>
            <td>{{$clients->telephone_mobile}}</td>
            </thead>

            <thead>
            <th>Telephone (Official)</th>
            <td>{{$clients->telephone_official}}</td>
            </thead>

            <thead>
            <th>Date of Birth</th>
            <td>{{$clients->date_of_birth}}</td>
            </thead>

            <thead>
            <th>Email</th>
            <td>{{$clients->email}}</td>
            </thead>

            <thead>
            <th>Occupation</th>
            <td>{{$clients->occupation}}</td>
            </thead>

            <thead>
            <th>Positon Held</th>
            <td>{{$clients->position_held}}</td>
            </thead>

            <thead>
            <th>Nationality</th>
            <td>{{$clients->nationality}}</td>
            </thead>

            <thead>
            <th>Number of Years in Current Employment</th>
            <td>{{$clients->number_of_years}}</td>
            </thead>

            <thead>
            <th>Employer Address</th>
            <td>{{$emps->address}}</td>
            </thead>

            <thead>
            <th>Martial Status</th>
            <td>{{$clients->marital_status_id ==1 ? 'MARRIED':''}}
                {{$clients->marital_status_id ==2 ? 'DIVORCED':''}}
                {{$clients->marital_status_id ==3 ? 'SINGLE':''}}
                {{$clients->marital_status_id ==4 ? 'OTHER':''}}
            </td>
            </thead>

            <thead>
            <th>Source of Funds</th>
            <td>{{$clients->source_of_funds_id ==1 ?'SALARY':''}}
                {{$clients->source_of_funds_id ==2 ?'TRADING':''}}
                {{$clients->source_of_funds_id ==3 ?'INVESTMENT':''}}
                {{$clients->source_of_funds_id ==4 ?'OTHER':''}}
            </td>
            </thead>


            <thead>
            <th>Monthly Income (GHC)</th>
            <td>{{$clients->monthly_income_id ==1 ?'1---1000':''}}
                {{$clients->monthly_income_id ==2 ?'1001---2000':''}}
                {{$clients->monthly_income_id ==3 ?'2001---5001':''}}
                {{$clients->monthly_income_id ==4 ?'5000 Plus':''}}
            </td>
            </thead>

            <thead>
            <th>Identification</th>
            <td>{{$clients->identification_number==1 ?'PASSPORT':''}}
                {{$clients->identification_number==2 ?'VOTER':''}}
                {{$clients->identification_number==3 ?"DRIVER'S LICENSE":''}}
                {{$clients->identification_number==4 ?'OTHER':''}}
            </td>
            </thead>

            <thead>
            <th>ID Number</th>
            <td>{{$clients->id_number}}</td>
            </thead>

            <thead>
            <th>Date of Issue</th>
            <td>{{$clients->date_of_issue}}</td>
            </thead>

            <thead>
            <th>Expiry Date</th>
            <td>{{$clients->expiry_date}}</td>
            </thead>

            <thead>
            <th>Literacy</th>
            <td>{{$clients->literacy_level_id==1 ? 'UNIVERSITY':''}}
                {{$clients->literacy_level_id==2 ? 'COLLEGE/POLYTECHNIC':''}}
                {{$clients->literacy_level_id==3 ? 'SECONDARY':''}}
                {{$clients->literacy_level_id==4 ? 'PRIMARY':''}}
                {{$clients->literacy_level_id==5 ? 'NO FORMAL EDUCATION':''}}
                {{$clients->literacy_level_id==6 ? 'OTHER':''}}
            </td>
            </thead>

            <thead>
            <th>Hometown</th>
            <td>{{$clients->hometown}}</td>
            </thead>

            <thead>
            <th>Social Security</th>
            <td>{{$clients->social_security}}</td>
            </thead>

            <thead>
            <th>Number of Member in Household</th>
            <td>{{$clients->household_members}}</td>
            </thead>

            <thead>
            <th>Father's Name</th>
            <td>{{$clients->father}}</td>
            </thead>

            <thead>
            <th>Mother's Name</th>
            <td>{{$clients->mother}}</td>
            </thead>

            <thead>
            <th>Next of Kin's Name</th>
            <td>{{$clients->kin_name}}</td>
            </thead>

            <thead>
            <th>Next of Kin's Address</th>
            <td>{{$clients->kin_address}}</td>
            </thead>

            <thead>
            <th>Next of Kin's Mobile Number</th>
            <td>{{$clients->kin_telephone}}</td>
            </thead>

            <thead>
            <th>Relationship to Kin's Name</th>
            <td>{{$clients->kin_relationship}}</td>
            </thead>
        </table>
    </div>
@stop