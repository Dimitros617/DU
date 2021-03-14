

<div style="" class="bg-su-lblue overflow-hidden  sm:rounded-lg  mx-auto sm:px-6 lg:px-8 p-5 pt-4 mb-3" id="middle-box-{{$middle_box->id}}" type="middle_box" include="element" element_id="{{$middle_box->id}}" locked="@if($middle_box->security != null && $middle_box->security != 'empty') 1 @else 0 @endif">
    @include('edit-bar')
    HELOOO

    @include('add-bar')
</div>
