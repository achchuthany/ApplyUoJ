@component('mail::message')
Dear {{$name}},

We congratulate and inform you that your online application has been received for the {{$programme}} in University of Jaffna.

@component('mail::panel')
Your reference number is <b>{{$ref_no}}</b>
@endcomponent

<p>The details of documents which are required to be sent to the "Assistant Registrar, Admissions Branch, University of Jaffna" along with the printed version of the on-line application form is listed in <a href="{{ route('home')}}" target="_blank">{{ config('app.name') }}</a> web page.</p>

<p>To download all the documents , use your email address and password in  <a href="{{route('home') }}" target="_blank">Login page</a>.</p>

<p>Your registration will be confirmed when you have received notification about your registration number.</p>

<p>If you do not remember your password, simply click the <a href="{{ route('password.request')}}" target="_blank">Forgot Password</a> link and follow the instructions.</p>

Thanks,<br>
{{ config('app.name') }}

This is system generated email.
@endcomponent

