

<div style="width: 100%; {{$element->style}}"
     name="{{$element->name}}"
     description="{{$element->description}}"
     old_style="width: 100%; {{$element->style}}"
     old_name="{{$element->name}}"
     old_description="{{$element->description}}"
     class="d-inline-block bg-norepeat bg-su-lblack  mx-auto sm:px-2 lg:px-4 p-5 pt-4 mb-2 su-animation-02 "
     id="elements_{{$element->id}}"
     type="elements"
     element_type="text"
     include="null"
     element_id="{{$element->id}}"
     locked="@if($element->security != null && $element->security != 'empty') 1 @else 0 @endif"
     @if($element->security == 'invisible' && Auth::permition()->edit_content != '1') hidden @endif
>
    @if($edit)
        @include('edit-bar')
    @endif



        <div class="this-element text-editor-setting mt-2" style="z-index: 999; position: relative;" >
            <div id="editor_{{$element->id}}" class=" @if(!$edit) ql-editor @endif editor-content d-content mt-2" style="font-size: 150%">
                @php
                echo $element->data;
                @endphp
            </div>
        </div>

    @if($edit)
            <script src="/js/text-editor.js"></script>
            <input onload="initTextEditor('editor_{{$element->id}}')" hidden>

    @endif


</div>
