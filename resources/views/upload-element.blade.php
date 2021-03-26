

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
     @if($element->security == 'invisible' && Auth::permition()->edit_content != '1') hidden @endif
>
    @if($edit)
        @include('edit-bar')
    @endif

    @php

    $label = 'Zatím neodevzdáno!';
    $time = '';
    $res = 'Zatím nehodnoceno';
    $comment = '';

    foreach($results as $result){
        if($result->user_id == Auth::user()->id && $result->element_id == $element->id){

            $name = explode('/', $result->data);
            $name = $name[count($name)-1];
            $label = 'Odevzdáno: ' . $name;
            $time = $result->updated_at;
            $res = 'Hodnocení: '. ($result->result == null ? 'Zatím nic...' : $result->result);
            $comment = ($result->comments == null ? '' : 'Komentář: ' .$result->comments);
        }
    }

    @endphp

    <form class="text-center text-su-orange fw-bold w-100 d-grid">
            @csrf
            <input type="text" name="element_id" value="{{$element->id}}" hidden>
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#ff9d09" class="bi bi-cloud-arrow-down-fill mx-auto" viewBox="0 0 16 16">
                <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z"/>
            </svg>
            <span>Odevzdat zadání</span>
            <label class="upload-label text-su-blue mt-2">{{$label}}</label>
            <label class="upload-time text-su-blue fw-light">{{$time}}</label>

            <label class="upload-result text-su-blue mt-4">{{$res}}</label>
            <label class="upload-comment text-su-blue fw-light">{{$comment}}</label>

            <input type="file" name="file" class="mx-auto my-3" onchange="upload(this.parentNode, this.parentNode.getElementsByClassName('loading')[0], this.parentNode.getElementsByClassName('loading_request')[0],this.parentNode.getElementsByClassName('upload-label')[0] ),
             this.parentNode.getElementsByClassName('upload-time')[0].innerHTML = 'Teď';
             this.parentNode.getElementsByClassName('upload-result')[0].innerHTML = '';
             this.parentNode.getElementsByClassName('upload-comment')[0].innerHTML = '';
            ">

            <div class="spinner-grow text-warning loading m-0 mx-auto" role="status" hidden></div>
            <div class="loading_request m-0 fw-bold text-su-orange mx-auto" role="status" hidden></div>
{{--            @if($edit)<input type="text" name="file" class="download-input mx-auto my-3" hidden onclick="saveColumn(this.parentNode.parentNode.parentNode, this.parentNode.getElementsByClassName('loading')[0], this.parentNode.getElementsByClassName('loading_request')[0], this.value, 'data')">@endif--}}

    </form>
</div>
