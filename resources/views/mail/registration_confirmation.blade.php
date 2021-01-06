@component('mail::message')
Dear {{$name}},

We congratulate and inform you that your online application has been received for the {{$programme}} in University of Jaffna.

The details of documents which are required to be sent to the "Assistant Registrar, Admission Branch, University of Jaffna" along with the printed version of the on-line application form is listed in <a href="{{ config('app.url')}}" target="_blank">{{ config('app.name') }}</a> web page.

To download all the documents , use your email address and password in  <a href="{{ url('login')}}" target="_blank">Login page</a>.

If you do not remember your password, simply click the <a href="{{ route('password.request')}}" target="_blank">Forgot Password</a> link and follow the instructions.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

