



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
         id="element_{{$element->id}}"
         type="element"
         include="null"
         element_id="{{$element->id}}"
         locked="@if($element->security != null && $element->security != 'empty') 1 @else 0 @endif"
    >
        @include('locked-box')
    </div>
@else

    <div style="{{$element->style}}"
         name="{{$element->name}}"
         description="{{$element->description}}"
         old_style="{{$element->style}}"
         old_name="{{$element->name}}"
         old_description="{{$element->description}}"
         class=" bg-norepeat bg-su-lblack overflow-hidden w-100 mx-auto sm:px-6 lg:px-8 p-5 pt-4 mb-3"
         id="element_{{$element->id}}"
         type="element"
         include="null"
         element_id="{{$element->id}}"
         locked="@if($element->security != null && $element->security != 'empty') 1 @else 0 @endif"
    >
        @if($edit)
            @include('edit-bar')
        @endif

{{--            @include($element->blade)--}}
            ahoj

    </div>

@endif
