

@php
    $lbx = "1";
foreach ($big_boxes_locks as $lock){

    if($lock->element_id == $big_box->id && $lock->locked == "0"){
        $lbx = "0";
        break;
    }
}
@endphp

@if(($big_box->security != null && $big_box->security != 'empty' && $lbx != '0' && Auth::permition()->edit_content != '1') )
    <div style=""
         name="{{$big_box->name}}"
         description="{{$big_box->description}}"
         id="big_box_{{$big_box->id}}"
         type="big_box"
         include="middle_box"
         element_id="{{$big_box->id}}"
         locked="@if($big_box->security != null && $big_box->security != 'empty') 1 @else 0 @endif">
        @include('locked-box')
    </div>
@else
    <div style="{{$big_box->style}}"
         name="{{$big_box->name}}"
         description="{{$big_box->description}}"
         old_style="{{$big_box->style}}"
         old_name="{{$big_box->name}}"
         old_description="{{$big_box->description}}"
         class="bg-white overflow-hidden box-su-shadow sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8 p-4 mb-5 su-animation-02 bg-norepeat"
         id="big_box_{{$big_box->id}}"
         type="big_box"
         include="middle_box"
         element_id="{{$big_box->id}}"
         locked="@if($big_box->security != null && $big_box->security != 'empty') 1 @else 0 @endif">

        @if($edit)
            @include('edit-bar')
        @endif

        @foreach($middle_boxes as $middle_box)
            @if($big_box->id == $middle_box->parent)
                @include('middle-box')
            @endif
        @endforeach

        @if($edit)
            @include('add-bar')
        @endif
    </div>
@endif



