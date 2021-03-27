
@if(!$test_results)

<div style="{{$element->style}}"
     name="{{$element->name}}"
     description="{{$element->description}}"
     old_style="{{$element->style}}"
     old_name="{{$element->name}}"
     old_description="{{$element->description}}"
     class=" bg-norepeat bg-su-lblack  w-100 mx-auto sm:px-6 lg:px-8 p-5 pt-4 mb-3"
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
            $selected = $element->data == null ? "NENASTAVENO!" : $element->data;
        @endphp
        <button class="su-button text-center p-3 w-100 mx-auto d-grid" @if(!$edit && $element->data != null)onclick="finishTest('{{$element->data}}', this.getElementsByClassName('loading')[0], this.getElementsByClassName('loading_request')[0])"@endif>
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class=" bi bi-flag-fill text-su-orange mx-auto mb-3" viewBox="0 0 16 16">
                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001"/>
            </svg>
            ODEVZDAT ODPOVĚDI
            <select class="mx-auto p-2 bg-transparent" style="width: max-content;"
                    @if($edit)
                    onchange="saveColumn(
                        document.getElementById('elements_{{$element->id}}'),
                        document.getElementById('elements_{{$element->id}}').getElementsByClassName('edit-bar')[0].getElementsByClassName('loading')[0],
                        document.getElementById('elements_{{$element->id}}').getElementsByClassName('edit-bar')[0].getElementsByClassName('loading_request')[0],
                        this.value,
                        'data'
                        );"
                    @else
                    hidden
                @endif
            >

                <option value="null">NEVYBRÁNO</option>
                <option value="chapters:{{$chapter->id}}"@if($selected == ("chapters:".$chapter->id)) selected @php $selected = 'Z celé kapitoly: '.$chapter->name; @endphp @endif>Z celé kapitoly: {{$chapter->name}}</option>
                @foreach($big_boxes as $big_boxx)
                    <option value="big_box:{{$big_boxx->id}}" @if($selected == ("big_box:".$big_boxx->id)) selected @php $selected = 'Z velké sekce: '.$big_boxx->name; @endphp @endif >Z velké sekce: {{$big_boxx->name}}</option>
                @endforeach
                @foreach($middle_boxes as $middle_boxx)
                    <option value="middle_box:{{$middle_boxx->id}}" @if($selected == ("middle_box:".$middle_boxx->id)) selected @php $selected = 'Z části: '.$middle_boxx->name; @endphp @endif>Z části: {{$middle_boxx->name}}</option>
                @endforeach
            </select>
            @if(!$edit)
                <label> {{$selected}} </label>
            @endif
            <div class="spinner-grow text-warning loading m-0 mx-auto" role="status" hidden></div>
            <div class="loading_request m-0 fw-bold text-su-orange mx-auto" role="status" hidden></div>
        </button>

        @if(!$test_results)
            <div class="check-results w-100 d-block rounded mt-2"  style="    height: 4rem;">
                @php
                    $element->data = str_replace(':','_', $element->data)
                @endphp
                <a href="/chapter/{{$chapter->id}}/results/{{$element->data}}" class="text-decor-none w-content mx-auto mx-md-0 float-md-end text-su-blue fw-bold d-grid text-center bg-su-blue-gradient rounded-3 shadow p-3 su-animation-02 cursor-pointer su-hover-shadow text-su-shadow-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-lightbulb-fill text-su-orange mx-auto mb-2 su-svg-shadow-white" viewBox="0 0 16 16">
                        <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5z"/>
                    </svg>
                    VÝSLEDKY
                </a>
            </div>
        @endif
</div>
    @endif
