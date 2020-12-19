@extends('layouts.pdf')
@section('header')
    <div class="h6 text-uppercase text-right mt-5"><p>Form No. 01</p></div>
@endsection

@section('footer')
    <div class="page-number float-right mr-5" style="font-size: 10px"></div>
    <div class="ml-5 text-left text-uppercase" style="font-size: 10px">University of Jaffna | Personal Data of Student</div>
@endsection
@section('content')
    <table class="table">
        <tr>
            <td style="width: 15%" >
                <div style="width: 35mm;height: 45mm;border: 1px solid black;">
                    <div class="h5 text-center" ><p>Photo</p></div>
                </div>
            </td>
            <td class="text-center" style="width: 65%">
                <img src="{{URL::asset('assets/images/logo-sm.png')}}" style="height: 30mm">
                <div class="h5">University of Jaffna, Sri Lanka.</div>
                <div class="h4 text-uppercase">Personal Data of Students</div>
            </td>
            <td style="width: 20%">

            </td>
        </tr>

    </table>


    <table class="table table-striped" style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <td class="p-2" style="width:5cm">Name of the Course of Study</td>
        </tr>
        <tr>
            <td class="p-2 pl-3 py-3 text-wrap">{{$enroll->programme->name}}</td>
        </tr>

        <tr>
            <td class="p-2">Faculty</td>
        </tr>
        <tr>
            <td class="p-2 pl-3 py-3 text-wrap">{{$enroll->programme->faculty->name}}</td>
        </tr>

        <tr>
            <td class="p-2">Registration No.</td>
        </tr>
        <tr>
            <td class="p-2 pl-3 py-3 text-wrap {{$enroll->reg_no? '': 'text-info'}} ">{{$enroll->reg_no? $enroll->reg_no: $NotAssigned}}</td>
        </tr>
    </table>
    <h6 class="text-uppercase mt-3">1. Name</h6>
    <table class="table-borderless text-wrap" style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <td class="p-2" style="width: 30%">i. Title</td>
            <td class="p-2 pl-3 py-3 text-wrap" style="width: 70%">{{$student->title}}</td>
        </tr>
        <tr>
            <td class="p-2 text-wrap">ii. Last Name/Surname</td>
            <td class="p-2 pl-3 py-3 {{$student->last_name? '': 'text-info'}}">{{$student->last_name? $student->last_name: $NotAssigned}} </td>
        </tr>

        <tr>
            <td class="p-2">iii. Name with Initials</td>
            <td class="p-2 pl-3 py-3 text-wrap {{$student->name_initials? '': 'text-info'}}">{{$student->name_initials? $student->name_initials: $NotAssigned}}</td>
        </tr>

        <tr>
            <td class="p-2">iv. Full Name</td>
            <td class="p-2 pl-3 py-3">{{$student->full_name}}</td>
        </tr>
    </table>
    <h6 class="text-uppercase mt-3">2. Address</h6>
    <table class="table-borderless text-wrap" style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <td class="p-2" style="width: 30%">i. Permanent Address</td>
            <td class="p-2 pl-3 py-3" style="width: 70%;">{{$permanentAddress}}</td>
        </tr>
        <tr>
            <td class="p-2">ii. Contact Address</td>
            <td class="p-2 pl-3 py-3">{{$contactAddress}}</td>
        </tr>
        <tr>
            <td class="p-2">iii. Province</td>
            <td class="p-2 pl-3 py-3 {{$student->province? '': 'text-info'}}">{{$student->province? $student->province: 'Not Assigned'}}</td>
        </tr>
        <tr>
            <td class="p-2">iv. District</td>
            <td class="p-2 pl-3 py-3 {{$student->district? '': 'text-info'}}">{{$student->district? $student->district: 'Not Assigned'}}</td>
        </tr>
        <tr>
            <td class="p-2">v. National Identity Card / &nbsp;&nbsp;&nbsp;&nbsp;Passport No. </td>
            <td class="p-2 pl-3 py-3">{{$student->nic}}</td>
        </tr>
        <tr>
            <td class="p-2">vi. Mobile</td>
            <td class="p-2 pl-3 py-3">{{$student->mobile}}</td>
        </tr>
        <tr>
            <td class="p-2">vii. Email</td>
            <td class="p-2 pl-3 py-3">{{$student->email}}</td>
        </tr>
    </table>

    <h6 class="text-uppercase mt-3">3. Educational Qualifications</h6>
    <table class="table-borderless text-wrap" style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <td class="p-2" style="width: 50%">i. Year of the G.C.E(A/L) Examination</td>
            <td class="p-2 pl-3 py-3" style="width: 50%">{{$student->al_exam_year}}</td>
        </tr>
        <tr>
            <td class="p-2">ii. Index No. of the G.C.E(A/L) Examination</td>
            <td class="p-2 pl-3 py-3">{{$student->al_index_number}}</td>
        </tr>
        <tr>
            <td class="p-2">iii. Average Z Score</td>
            <td class="p-2 pl-3 py-3">1.{{$student->al_z_score}}</td>
        </tr>
        <tr>
            <td class="p-2" colspan="2">iv. G.C.E(A/L) Examination Results</td>
        </tr>
        @foreach($enroll->student->student_al_exams as $al_exam)
        <tr>
            <td class="p-2 pl-4">{{$al_exam->subject}} </td>
            <td class="p-2 pl-3 py-2">{{$al_exam->grade}}</td>
        </tr>
        @endforeach
    </table>

    <h6 class="text-uppercase mt-3">4. Details of Citizenship</h6>
    <table class="table-borderless text-wrap" style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <th class="p-2" style="width: 25%">i. Race</th>
            <td class="p-2 pl-3 py-3" style="width: 25%">{{$race}}</td>

            <th class="p-2" style="width: 25%">ii. Gender</th>
            <td class="p-2 pl-3 py-3" style="width: 25%">{{$gender}}</td>
        </tr>

        <tr>
            <th class="p-2" style="width: 25%">iii. Civil Status</th>
            <td class="p-2 pl-3 py-3" style="width: 25%">{{$civil_status}}</td>

            <th class="p-2" style="width: 25%">iv. Religion</th>
            <td class="p-2 pl-3 py-" style="width: 25%;">{{$religion}}</td>
        </tr>

        <tr>
            <th class="p-2">v. Date of Birth</th>
            <td class="p-2 pl-3 py-3">{{$dob}}</td>
            <th class="p-2">vi. Age</th>
            <td class="p-2 pl-3 py-3">{{$age}} years</td>
        </tr>

        <tr>
            <th class="p-2">vii. Citizenship</th>
            <td class="p-2 pl-3 py-3">{{$student->citizenship}}</td>
            <td class="p-2">If Sri Lanka</td>
            <td class="p-2 pl-3 py-3">{{$student->citizenship_type}}</td>
        </tr>

    </table>

    <h6 class="text-uppercase mt-3">5. Details of Parents / Guardian</h6>
    <table class="table-borderless text-wrap" style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <td class="p-2" style="width: 30%">i. Full name of Father / &nbsp;&nbsp;&nbsp;&nbsp;Mother / Guardian</td>
            <td class="p-2 pl-3 py-3" style="width: 70%">{{$student->parent_full_name}}</td>
        </tr>
        <tr>
            <td class="p-2">ii. Occupation</td>
            <td class="p-2 pl-3 py-3">{{$student->parent_occupation}}</td>
        </tr>
        <tr>
            <td class="p-2">iii. Address of the <br>&nbsp;&nbsp;&nbsp;&nbsp;place of work</td>
            <td class="p-2 pl-3 py-3">{{$student->parent_address_work}}</td>
        </tr>
        <tr>
            <td class="p-2">iv. Telephone No.</td>
            <td class="p-2 pl-3 py-3">{{$student->parent_mobile}}, {{$student->parent_landline}}</td>
        </tr>

        <tr>
            <td class="p-2" colspan="2">v. Name and the telephone no of the person to be informed in case of an Emergency</td>
        </tr>
        <tr>
            <td class="p-2 pl-4">Name</td>
            <td class="p-2 pl-3 py-3">{{$student->emergency_contact_name}}</td>
        </tr>
        <tr>
            <td class="p-2 pl-4">Mobile</td>
            <td class="p-2 pl-3 py-3">{{$student->emergency_contact_mobile}}</td>
        </tr>

    </table>
    <div class="page-break"></div>

    <div class="text-center text-uppercase h5">Declaration</div>
    <p class="text-justify">
        I......................................................... declare that I shall abide by the Statutes, By Laws, Regulations and rules of the University of Jaffna so far as they are applicable to me, pay due respect to
        the Teachers, officers and other employees, of the University of Jaffna and conduct myself in a manner
        which will in no way be prejudicial to the good name of the University, I am also aware that if I fail to
        adhere to the terms of the declaration, I will be liable to expel from the University of Jaffna or for other disciplinary action.
    </p>
    <p class="text-justify">
        I hereby declare that I agree to accept and conduct myself according to the laws in the "Prohibition of
        Ragging and other forms of Violence" in Educational Institutions Act No. 20 of 1998. In addition, I shall at
        all times refrain from encouraging such undesirable activities,
        disciplinary action.
    </p>
    <p class="text-justify">
        Further, I declare that the particulars given in this application are true and correct to the best of my
        knowledge. I am aware that the University has the right to cancel my registration if any information
        given above is found to be incorrect.
    </p>

    <table class="table-borderless text-wrap" style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <td class="">................................................</td>
            <td class="">....../....../............</td>
        </tr>
        <tr>
            <td class="p-2">Signature of the Student</td>
            <td class="p-2">Date</td>
        </tr>
    </table>
    <p class="text-justify pt-5" style="width: 100%">
        I hereby certify that this applicant, who is known to me personally, has enclosed all information
        relevant to this registration form correctly and that he/she signed this application in my
        presence.
    </p>
    <table class="table-borderless text-wrap" style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <td class="p-2" style="width: 50%">Name of the Applicant</td>
            <td class="p-2" style="width: 50%;border-bottom: 1px dotted black;"></td>
        </tr>
        <tr>
            <td class="p-2">National Identity Card No of the applicant</td>
            <td class="p-2" style="border-bottom: 1px dotted black;"></td>
        </tr>
        <tr>
            <td class="p-2">Signature of the applicant</td>
            <td class="p-2" style="border-bottom: 1px dotted black;"></td>
        </tr>
        <tr>
            <td class="p-2" colspan="2">Name of the Justice of Peace/ Commissioner for Oaths/Principal of the School of the applicant</td>
        </tr>
        <tr>
            <td class="p-2" colspan="2" style="border-bottom: 1px dotted black;"></td>
        </tr>
        <tr>
            <td class="p-2" colspan="2">Signature of the Justice of Peace/Commissioner for Oaths/Principal of the school</td>
        </tr>
        <tr>
            <td class="p-2" colspan="2" style="border-bottom: 1px dotted black;"></td>
        </tr>
        <tr>
            <td class="p-2" colspan="2">Official Stamp of the Justice of Peace/Commissioner for Oaths/Principal of the school</td>
        </tr>
        <tr>
            <td class="p-2" colspan="2" style="border-bottom: 1px dotted black;"></td>
        </tr>

        <tr>
            <td class="p-2" style="border-bottom: 1px dotted black;">Date: </td>
            <td class="p-2" style="border-bottom: 1px dotted black;">Place: </td>
        </tr>
    </table>

@endsection

