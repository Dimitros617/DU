

<div style="@if($element->style == null)background-image: url('/user_files/default.png ') !important;@endif height: 30rem !important; {{$element->style}}"
     name="{{$element->name}}"
     description="{{$element->description}}"
     old_style="background-image: url('/user_files/default.png') !important; height: 30rem !important; {{$element->style}}"
     old_name="{{$element->name}}"
     old_description="{{$element->description}}"
     class="  bg-white overflow-hidden w-50 mx-auto sm:px-6 lg:px-8 p-5 pt-4 mb-3 bg-su-image-center bg-norepeat su-animation-02"
     id="elements_{{$element->id}}"
     type="elements"
     element_type="image"
     include="null"
     element_id="{{$element->id}}"
     locked="@if($element->security != null && $element->security != 'empty') 1 @else 0 @endif"
     @if($element->security == 'invisible' && Auth::permition()->edit_content != '1') hidden @endif
>
    @if($edit)
        @include('edit-bar')
    @endif


</div>
