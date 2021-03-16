

@php
    $lmx = "1";
foreach ($middle_boxes_locks as $lock){

    if($lock->element_id == $middle_box->id && $lock->locked == "0"){
        $lmx = "0";
        break;
    }
}
@endphp

@if(($middle_box->security != null && $middle_box->security != 'empty' && $lmx != '0' && Auth::permition()->edit_content != '1'))
    <div style=""
         name="{{$middle_box->name}}"
         description="{{$middle_box->description}}"
         id="middle_box_{{$middle_box->id}}"
         type="middle_box"
         include="elements"
         element_id="{{$middle_box->id}}"
         locked="@if($middle_box->security != null && $middle_box->security != 'empty') 1 @else 0 @endif"
    >
        @include('locked-box')
    </div>
@else

    <div style="{{$middle_box->style}}"
         name="{{$middle_box->name}}"
         description="{{$middle_box->description}}"
         old_style="{{$middle_box->style}}"
         old_name="{{$middle_box->name}}"
         old_description="{{$middle_box->description}}"
         class=" bg-norepeat bg-su-lblack   sm:rounded-lg  mx-auto sm:px-6 lg:px-8 p-5 pt-4 mb-3 su-animation-02"
         id="middle_box_{{$middle_box->id}}"
         type="middle_box"
         include="elements"
         element_id="{{$middle_box->id}}"
         locked="@if($middle_box->security != null && $middle_box->security != 'empty') 1 @else 0 @endif"
    >
        @if($edit)
            @include('edit-bar')
        @endif

        @foreach($elements as $element)
            @if($middle_box->id == $element->parent)
                @include('layout-element')
            @endif
        @endforeach

        @if($edit)
            @include('add-bar')
        @endif

    </div>

@endif

