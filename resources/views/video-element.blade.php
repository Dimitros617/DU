

<div style="height: 40rem; {{$element->style}}"
     name="{{$element->name}}"
     src="@if($element->url == null) /user_files/default.mp4 @else{{$element->url}}@endif"
     description="{{$element->description}}"
     old_style="height: 40rem; {{$element->style}}"
     old_name="{{$element->name}}"
     old_description="{{$element->description}}"
     class=" bg-norepeat bg-su-lblack overflow-hidden w-100 mx-auto mb-3 su-animation-02"
     id="elements_{{$element->id}}"
     type="elements"
     element_type="video"
     include="null"
     element_id="{{$element->id}}"
     locked="@if($element->security != null && $element->security != 'empty') 1 @else 0 @endif"
     @if($element->security == 'invisible' && Auth::permition()->edit_content != '1') hidden @endif
>
    @if($edit)
        @include('edit-bar')
    @endif

        <script>
            function copyData(ele) {
                ele.parentNode.getElementsByClassName('this-element')[0].setAttribute('style', ele.parentNode.getAttribute('style'));
                ele.parentNode.getElementsByClassName('this-element')[0].setAttribute('src', ele.parentNode.getAttribute('src'));
            }
        </script>
        <input onload="copyData(this)" hidden>


        <iframe class="this-element w-100" src="/user_files/default.mp4">
        </iframe>

</div>
