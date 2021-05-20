@component('mail::message')
Dear {{$enroll->student->full_name}},

We inform you that your registration has been <b>{{$enroll->status}}</b> for the {{$enroll->programme->name}} in University of Jaffna.

{{$message}}

@component('mail::panel')
<p>Student Name: {{$enroll->student->full_name}}</p>
<p>Course: {{$enroll->programme->name}}</p>
<p>Enrollment Status: <b>{{$enroll->status}}</b></p>
<p>Your reference number is <b>{{$enroll->getRefNo()}}</b><p></p>

@endcomponent

@if($enroll->status=="Invited")
<p>To complete your application, use your email address and password in  <a href="{{route('student.registration.index') }}" target="_blank">Login page</a>.</p>
<p>Your registration will be confirmed when you receive notification of your registration number.</p>
@endif

<p>If you require further information please call +940212218120 / +940212226714 / email us at admissions@univ.jfn.ac.lk</p>

Thanks,<br>
{{ config('app.name') }}

<p>This is system generated email.</p>
@endcomponent

