<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="" style="height: 100px; margin-top: 1rem;" alt="Digitální učebnice">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
