@extends('layouts.pdf')
@section('header')
    <p style="float: right">Form No. 01</p>
@endsection

@section('footer')
    <div class="page-number" style=" margin:0 50px;text-align:left;font-size: 10px">  | {{\Carbon\Carbon::now('Asia/Colombo')->toFormattedDateString().' '. \Carbon\Carbon::now('Asia/Colombo')->toTimeString()}} <span style="font-size: 10px;float: right">Personal Data of Student | University of Jaffna</span></div>

@endsection
@section('content')
    <table width="100%" style="margin-bottom: 10px">
        <tr>
            <td style="width: 15%" >
                <div style="width: 35mm;height: 45mm;border: 1px solid black;">
                    <div style="text-align: center" ><p>Photo</p></div>
                </div>
            </td>
            <td  style="width: 85%;text-align: center">
                <img src="{{URL::asset('assets/images/logo-sm.png')}}" style="height: 30mm">
                <div >University of Jaffna, Sri Lanka.</div>
                <h3 >PERSONAL DATA OF STUDENTS</h3>
            </td>
        </tr>
    </table>


    <table style="table-layout: fixed; border-collapse: collapse; width: 100%; border: none;">
        <tr>
            <th class="p-2" width="40%">Name of the Course of Study</th>
            <td class="p-2 pl-3 py-3 text-wrap">: {{$enroll->programme->name}}</td>
        </tr>

        <tr>
            <th class="p-2">Faculty</th>
            <td class="p-2">: {{$enroll->programme->faculty->name}}</td>
        </tr>

        <tr>
            <th class="p-2">Registration No.</th>
            <td class="p-2">: {{$enroll->reg_no? $enroll->reg_no: $NotAssigned}}</td>
        </tr>
    </table>
    <div class="mt-5 b">1. NAME</div>
    <table style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <th class="p-2" style="width: 40%">i. Title</th>
            <td class="p-2" style="width: 60%">: {{$student->title}}</td>
        </tr>
        <tr>
            <th class="p-2">ii. Last Name or Surname</th>
            <td class="p-2 {{$student->last_name? '': 'text-info'}}">: {{$student->last_name? $student->last_name: $NotAssigned}} </td>
        </tr>

        <tr>
            <th class="p-2">iii. Name with Initials</th>
            <td class="p-2 {{$student->name_initials? '': 'text-info'}}">: {{$student->name_initials? $student->name_initials: $NotAssigned}}</td>
        </tr>

        <tr>
            <th class="p-2">iv. Full Name</th>
            <td class="p-2 pl-3 py-3">: {{$student->full_name}}</td>
        </tr>
    </table>
    <div class="mt-5 b">2. ADDRESS</div>
    <table class="table-borderless text-wrap" style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <th class="p-2" style="width: 40%">i. Permanent Address</th>
            <td class="p-2" style="width: 60%;">: {{$permanentAddress}}</td>
        </tr>
        <tr>
            <th class="p-2">ii. Contact Address</th>
            <td class="p-2">: {{$contactAddress}}</td>
        </tr>
        <tr>
            <th class="p-2">iii. Province</th>
            <td class="p-2 {{$student->province? '': 'text-info'}}">: {{$student->province? $student->province: 'Not Assigned'}}</td>
        </tr>
        <tr>
            <th class="p-2">iv. District</th>
            <td class="p-2 {{$student->district? '': 'text-info'}}">: {{$student->district? $student->district: 'Not Assigned'}}</td>
        </tr>
        <tr>
            <th class="p-2">v. National Identity Card / &nbsp;&nbsp;&nbsp;&nbsp;Passport No. </th>
            <td class="p-2">: {{$student->nic}}</td>
        </tr>
        <tr>
            <th class="p-2">vi. Mobile</th>
            <td class="p-2">: {{$student->mobile}}</td>
        </tr>
        <tr>
            <th class="p-2">vii. Email</th>
            <td class="p-2">: {{$student->email}}</td>
        </tr>
    </table>

    <div class="mt-5 b">3. EDUCATIONAL QUALIFICATIONS</div>
    <table style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <th class="p-2" style="width: 50%">i. Year of the G.C.E(A/L) Examination</th>
            <td class="p-2" style="width: 50%">: {{$student->al_exam_year}}</td>
        </tr>
        <tr>
            <th class="p-2">ii. Index No. of the G.C.E(A/L) Examination</th>
            <td class="p-2">: {{$student->al_index_number}}</td>
        </tr>
        <tr>
            <th class="p-2">iii. Average Z Score</th>
            <td class="p-2">: {{$student->al_z_score}}</td>
        </tr>
        <tr>
            <th class="p-2" colspan="2">iv. G.C.E(A/L) Examination Results</th>
        </tr>
        @foreach($enroll->student->student_al_exams as $al_exam)
        <tr>
            <td class="p-2" style="padding-left:60px">{{$al_exam->subject}} </td>
            <td class="p-2">: {{$al_exam->grade}}</td>
        </tr>
        @endforeach
    </table>

    <div class="mt-5 b">4.	DETAILS OF CITIIZENSHIP</div>
    <table class="table-borderless text-wrap" style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <th class="p-2" style="width: 25%">i. Race</th>
            <td class="p-2 pl-3 py-3" style="width: 25%">: {{$race}}</td>

            <th class="p-2" style="width: 25%">ii. Gender</th>
            <td class="p-2 pl-3 py-3" style="width: 25%">: {{$gender}}</td>
        </tr>

        <tr>
            <th class="p-2" style="width: 25%">iii. Civil Status</th>
            <td class="p-2 pl-3 py-3" style="width: 25%">: {{$civil_status}}</td>

            <th class="p-2" style="width: 25%">iv. Religion</th>
            <td class="p-2 pl-3 py-" style="width: 25%;">: {{$religion}}</td>
        </tr>

        <tr>
            <th class="p-2">v. Date of Birth</th>
            <td class="p-2 pl-3 py-3">: {{$dob}}</td>
            <th class="p-2">vi. Age</th>
            <td class="p-2 pl-3 py-3">: {{$age}} years</td>
        </tr>

        <tr>
            <th class="p-2">vii. Citizenship</th>
            <td class="p-2 pl-3 py-3">: {{$student->citizenship}}</td>
            <td class="p-2">If Sri Lanka</td>
            <td class="p-2 pl-3 py-3">: {{$student->citizenship_type}}</td>
        </tr>

    </table>

    <div class="mt-5 b">5.	DETAILS OF PARENTS/GUARDIAN</div>
    <table style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <th class="p-2" style="width: 30%">i. Full name of Father / &nbsp;&nbsp;&nbsp;&nbsp;Mother / Guardian</th>
            <td class="p-2 pl-3 py-3" style="width: 70%">: {{$student->parent_full_name}}</td>
        </tr>
        <tr>
            <th class="p-2">ii. Occupation</th>
            <td class="p-2 pl-3 py-3">: {{$student->parent_occupation}}</td>
        </tr>
        <tr>
            <th class="p-2">iii. Address of the <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;place of work</th>
            <td class="p-2 pl-3 py-3">: {{$student->parent_address_work}}</td>
        </tr>
        <tr>
            <th class="p-2">iv. Telephone No.</th>
            <td class="p-2 pl-3 py-3">: {{$student->parent_mobile}}, {{$student->parent_landline}}</td>
        </tr>

        <tr>
            <th class="p-2" colspan="2">v. Name and the telephone no of the person to be informed in case of an Emergency</th>
        </tr>
        <tr>
            <td class="p-2" style="padding-left: 50px">Name</td>
            <td class="p-2">: {{$student->emergency_contact_name}}</td>
        </tr>
        <tr>
            <td class="p-2" style="padding-left: 50px">Mobile</td>
            <td class="p-2">: {{$student->emergency_contact_mobile}}</td>
        </tr>
    </table>

    <div class="page-break"></div>
    <p style="margin: auto"></p>
    <h3 style="text-align: center;text-transform: uppercase;width: 100%;">Declaration</h3>
    </br>
    <p class="text-justify">
        I ……………………………………………………………………… declare that I shall abide by the Statutes, By Laws, Regulations and rules of the University of Jaffna so far as they are applicable to me, pay due respect to the Teachers, Officers and other employees, of the University of Jaffna and conduct myself in a manner which will in no way be prejudicial to the good name of the University. I am also aware that if I fail to adhere to the terms of the declaration, I will be liable to expel from the University of Jaffna or for other disciplinary action.
    </p>
    <p class="text-justify">
        I hereby declare that I agree to accept and conduct myself according to the laws in the “Prohibition of Ragging and other forms of Violence” in Educational Institutions Act No. 20 of 1998. In addition, I shall at all times refrain from encouraging such undesirable activities,
        disciplinary action.
    </p>
    <p class="text-justify">
        Further, I declare that the particulars given in this application are true and correct to the best of my knowledge. I am aware that the University has the right to cancel my registration if any information given above is found to be incorrect.
    </p>

    <table style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
        <tr>
            <td>................................................</td>
            <td class="">....../....../............</td>
        </tr>
        <tr>
            <td class="p-2">Signature of the Student</td>
            <td class="p-2">Date</td>
        </tr>
    </table>
    <p class="text-justify" style="width: 100%">
        <b>Attestation:</b>
        I hereby certify that this applicant, who is known to me personally, has enclosed all information relevant to this registration form correctly and that he/she signed this application in my presence.

    </p>
    <table style="table-layout: fixed;border-collapse: collapse;width: 100%;border: none;">
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
            <td class="p-2" colspan="2">Official Stamp of the Justice of Peace/Commissioner for Oaths/Principal of the applicant</td>
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

