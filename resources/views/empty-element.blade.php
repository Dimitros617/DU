

<div style="{{$element->style}}"
     name="{{$element->name}}"
     description="{{$element->description}}"
     old_style="{{$element->style}}"
     old_name="{{$element->name}}"
     old_description="{{$element->description}}"
     class=" bg-norepeat bg-su-lblack overflow-hidden w-100 mx-auto sm:px-6 lg:px-8 p-5 pt-4 mb-3"
     id="elements_{{$element->id}}"
     type="elements"
     include="null"
     element_id="{{$element->id}}"
     locked="@if($element->security != null && $element->security != 'empty') 1 @else 0 @endif"
>
    @if($edit)
        @include('edit-bar')
    @endif


    {{-- TODO ZDE vložte vlastní kod--}}

</div>
