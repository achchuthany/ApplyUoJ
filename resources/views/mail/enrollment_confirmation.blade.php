@component('mail::message')
Dear {{$enroll->student->full_name}},
## Congratulate !
We inform you that your registration has been <b>confirmed</b> for the {{$enroll->programme->name}} in University of Jaffna.

@component('mail::panel')
<p>Student Name: {{$enroll->student->full_name}}</p>
<p>Course: {{$enroll->programme->name}}</p>
<p>Registration Number: {{$enroll->reg_no}}</p>
<p>Index Number: {{$enroll->index_no}}</p>
<p>Date of Registration: {{($enroll->registration_date)? \Carbon\Carbon::parse($enroll->registration_date)->toFormattedDateString() : ''}}</p>
<p>Enrollment Status: <b>{{$enroll->status}}</b></p>
@endcomponent
@component('mail::panel')
    Your reference number is <b>{{$enroll->getRefNo()}}</b>
@endcomponent
<p>If you require further information please call +940212218120 / +940212226714 or email us at admissions@univ.jfn.ac.lk</p>

Thanks,<br>
{{ config('app.name') }}

<p>This is system generated email.</p>
@endcomponent

