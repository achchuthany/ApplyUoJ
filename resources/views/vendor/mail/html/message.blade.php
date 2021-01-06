@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')

Please do not reply to this email. Replies to this email will not be responded to or read.

You're receiving this email because you're a registered {{ config('app.name') }}. We'll send you timely updates - meant just for {{ config('app.name') }}.

If you do not wish to receive these updates, please contact help@maco.jfn.ac.lk.

© {{ date('Y') }} <a target="_blank" href="{{config('app.url')}}"> {{ config('app.name') }}</a>. @lang('All rights reserved.')


Developed by <a target="_blank" href="https://cv.achchuthan.org">ACHCHUTHAN.ORG</a>
@endcomponent
@endslot
@endcomponent
