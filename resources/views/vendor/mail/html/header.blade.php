<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
    <img src="{{URL::asset('assets/images/logo-dark.png')}}"  height="40px" alt="University of Jaffna">
@else
    <img src="{{URL::asset('assets/images/logo-dark.png')}}"  height="40px" alt="{{ $slot }}">
@endif
</a>
</td>
</tr>
