

<div style="{{$element->style}}"
     name="{{$element->name}}"
     description="{{$element->description}}"
     old_style="{{$element->style}}"
     old_name="{{$element->name}}"
     old_description="{{$element->description}}"
     class=" bg-norepeat bg-su-lblack w-100 mx-auto sm:px-6 lg:px-8 p-5 pt-4 mb-3"
     id="elements_{{$element->id}}"
     type="elements"
     include="null"
     element_id="{{$element->id}}"
     locked="@if($element->security != null && $element->security != 'empty') 1 @else 0 @endif"
     @if($element->security == 'invisible' && Auth::permition()->edit_content != '1') hidden @endif
>
    @if($edit)
        @include('edit-bar')
    @endif

    <form>
        <input type="text" name="id" value="{{$element->id}}" hidden>
        <button class="su-button text-center p-3 w-100 mx-auto d-grid" @if(!$edit) onclick="download('{{$element->data}}')"@else onclick="fileSelector(this.getElementsByClassName('download-input')[0], this.getElementsByClassName('download-label')[0], this.getElementsByClassName('loading')[0]); return false;"     @endif>
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#ff9d09" class="bi bi-cloud-arrow-down-fill mx-auto" viewBox="0 0 16 16">
                <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z"/>
            </svg>
            Stáhnout zadání
            @php
                $name = explode('/', $element->data);
                $name = $name[count($name)-1];
            @endphp
            <label class=" download-label cursor-pointer">@if($element->data!=null) {{$name}} @else Zatím nevybrán soubor @endif</label>
            @if($edit) <label class="fw-light">(Kliknutím změníte)</label> @endif
            <div class="spinner-grow text-warning loading m-0 mx-auto" role="status" hidden></div>
            <div class="loading_request m-0 fw-bold text-su-orange mx-auto" role="status" hidden></div>
            @if($edit)<input type="text" name="file" class="download-input mx-auto my-3" hidden onclick="saveColumn(this.parentNode.parentNode.parentNode, this.parentNode.getElementsByClassName('loading')[0], this.parentNode.getElementsByClassName('loading_request')[0], this.value, 'data')">@endif
        </button>
    </form>
</div>
