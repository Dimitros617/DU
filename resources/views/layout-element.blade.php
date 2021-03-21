



@php
    $le = "1";
foreach ($elements_locks as $lock){

    if($lock->element_id == $element->id && $lock->locked == "0"){
        $le = "0";
        break;
    }
}
@endphp

@if(($element->security != null && $element->security != 'empty' && $le != '0' && Auth::permition()->edit_content != '1'))
    <div style=""
         name="{{$element->name}}"
         description="{{$element->description}}"
         id="elements_{{$element->id}}"
         type="elements"
         include="null"
         element_id="{{$element->id}}"
         locked="@if($element->security != null && $element->security != 'empty') 1 @else 0 @endif"
         @if($element->security == 'invisible' && Auth::permition()->edit_content != '1') hidden @endif

    >
        @include('locked-box')
    </div>
@else

                @include($element->blade)

@endif
