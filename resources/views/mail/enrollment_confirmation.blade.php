@component('mail::message')
Dear {{$enroll->student->name_initials}},
## Congratulate !
We inform you that your enrolment has been <b>confirmed</b> for {{$enroll->programme->name}} at the University of Jaffna.

@component('mail::panel')
<p>Student Name: {{$enroll->student->full_name}}</p>
<p>Programme: {{$enroll->programme->name}}</p>
<p>Registration Number: {{$enroll->reg_no}}</p>
<p>Index Number: {{$enroll->index_no}}</p>
<p>Date of Registration: {{($enroll->registration_date)? \Carbon\Carbon::parse($enroll->registration_date)->toFormattedDateString() : ''}}</p>
<p>Enrolment Status: <b>{{$enroll->status}}</b></p>
@endcomponent
@component('mail::panel')
    Your reference number is <b>{{$enroll->getRefNo()}}</b>
@endcomponent
<p>If you need additional information</p>
<p>Call: +94 021 221 8120 / +94 021 222 6714 </p>
<p>E-mail: admissions@univ.jfn.ac.lk</p>

Thanks,<br>
{{ config('app.name') }}

<p>This is system generated email.</p>
@endcomponent

