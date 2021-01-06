<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
    <img src="{{URL::asset('assets/images/logo-dark.png')}}"  height="20px" alt="Logo">
@else
    <img src="{{URL::asset('assets/images/logo-dark.png')}}"  height="30px" alt="{{ $slot }}">
@endif
</a>
</td>
</tr>
