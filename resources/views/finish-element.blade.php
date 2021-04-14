

<div style="width: 100%; {{$element->style}}"
     name="{{$element->name}}"
     description="{{$element->description}}"
     old_style="{{$element->style}}"
     old_name="{{$element->name}}"
     old_description="{{$element->description}}"
     class=" bg-transparent bg-norepeat  mx-auto sm:px-6 lg:px-8 p-5 pt-4 mb-3"
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
            $fin = false;

            foreach ($finished as $finish){
                if($finish->element_id == $element->id){
                    $fin = true;
                    break;
                }
            }
        @endphp

        @if(!$fin || $edit)
            @php
                $selected = $element->data == null ? "NENASTAVENO!" : $element->data;
            @endphp
        <button class="su-button text-center p-3 w-100 mx-auto d-grid" @if(!$edit && $element->data != null)onclick="finishElement(document.getElementById('elements_{{$element->id}}'))"@endif>
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class=" bi bi-flag-fill text-su-orange mx-auto mb-3" viewBox="0 0 16 16">
                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001"/>
            </svg>
            DOKONČIT
            <select class="mx-auto p-2 bg-transparent" style="width: max-content;"
            @if($edit)
                onchange="saveColumn(
                document.getElementById('elements_{{$element->id}}'),
                document.getElementById('elements_{{$element->id}}').getElementsByClassName('edit-bar')[0].getElementsByClassName('loading')[0],
                document.getElementById('elements_{{$element->id}}').getElementsByClassName('edit-bar')[0].getElementsByClassName('loading_request')[0],
                this.value,
                'data',
                '/save_finished');"
            @else
                hidden
            @endif
            >

                <option value="null">NEVYBRÁNO</option>
                <option value="chapters:{{$chapter->id}}"@if($selected == ("chapters:".$chapter->id)) selected @php $selected = 'Tuto kapitolu: '.$chapter->name; @endphp @endif>Tuto kapitolu: {{$chapter->name}}</option>
                @foreach($big_boxes as $big_boxx)
                    <option value="big_box:{{$big_boxx->id}}" @if($selected == ("big_box:".$big_boxx->id)) selected @php $selected = 'Velkou sekci: '.$big_boxx->name; @endphp @endif >Velkou sekci: {{$big_boxx->name}}</option>
                @endforeach
                @foreach($middle_boxes as $middle_boxx)
                    <option value="middle_box:{{$middle_boxx->id}}" @if($selected == ("middle_box:".$middle_boxx->id)) selected @php $selected = 'Část: '.$middle_boxx->name; @endphp @endif>Část: {{$middle_boxx->name}}</option>
                @endforeach
                @foreach($elements as $elementt)
                    <option value="elements:{{$elementt->id}}" @if($selected == ("elements:".$elementt->id)) selected @php $selected = 'Element: '.$elementt->name; @endphp @endif>Element: {{$elementt->name}}</option>
                @endforeach
            </select>
            @if(!$edit)
                <label> {{$selected}} </label>
            @endif
        </button>
        @else
            <div class="mx-auto text-center justify-center fw-bold text-su-orange">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-check-circle-fill mx-auto mb-3" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                <label class="h3"> Tuto část máš již označenou jako dokončenou! </label>
            </div>
        @endif

</div>
