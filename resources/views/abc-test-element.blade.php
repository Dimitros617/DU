

<div style="{{$element->style}}"
     name="{{$element->name}}"
     description="{{$element->description}}"
     old_style="{{$element->style}}"
     old_name="{{$element->name}}"
     old_description="{{$element->description}}"
     class="test bg-norepeat bg-su-lblack overflow-hidden w-100 mx-auto p-2 sm:px-4 lg:px-8  pt-4 mb-3"
     test_type="abc"
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
    $data_json = json_decode($element->data_json);

    if($test_results){
        $my_result = null;
        foreach ($elements_results as $element_result){
            if($element_result->element_id == $element->id){
                $my_result = json_decode($element_result->data_json);
                break;
            }
        }
    }
    @endphp

        <input onload="removeOtherElements({{$result_element}})" hidden>

        <div class="d-flex flex-column w-100 mx-auto p-3">

            {{--Odpověd A--}}
            <div class="w-100 px-1 px-md-5 py-3 mt-3 rounded-3 bg-white d-inline-flex pt-4 flex-column-reverse flex-md-row text-center text-md-start @if($test_results)@if($my_result != null && $element->data_json != null && $my_result->a_result == $data_json->a_result) correct-answer @else bad-answer @endif @endif">

                <div class="switch-box d-grid text-center ">
                    <label class="switch  ms-auto me-auto">
                        <input type="checkbox"   class="a-radio radio-rule-slider" @if($element->data_json != null && $data_json->a_result && $edit)value="{{$data_json->a_result}}" checked @elseif($test_results && $my_result != null && $my_result->a_result == '1') value="1" checked @else value="0" @endif>
                        <span class="slider round shadow-none" for="radio-rule-slider" onclick="changeSwitch(this, this.parentNode.children[0], this.parentNode.parentNode.children[1],'ANO','NE',this.parentNode.parentNode.children[3])"></span>
                    </label>
                    <div class="switch-label mt-2 font-weight-bolder text-su-blue fw-bold ">@if($element->data_json != null && $data_json->a_result &&  $edit)ANO @elseif($test_results && $my_result != null && $my_result->a_result == '1') ANO @else NE @endif</div>
                    <input class="d-none a" type="text" name="test-a-{{$element->id}}"  value="0" >
                </div>

                <span class="w-100 p-4 m-0 ms-md-4 text-su-blue h4 a-text" @if($edit) contentEditable=true @endif data-text="Zadejte odpověď A">@if($element->data_json != null){{$data_json->a_text}}@endif</span>
                @if($test_results)
                    <span class="my-1 my-sm-4">
                    @if($my_result != null && $element->data_json != null && $my_result->a_result == $data_json->a_result)
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle-fill text-su-blue mx-auto" viewBox="0 0 16 16">
                            <title>Správná odpověď</title>
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill text-su-orange mx-auto" viewBox="0 0 16 16">
                            <title>Špatná odpověď</title>
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                    @endif
                    </span>
                @endif
            </div>


            {{--Odpověd B--}}
            <div class="w-100 px-1 px-md-5 py-3 mt-3 rounded-3 bg-white d-inline-flex pt-4 flex-column-reverse flex-md-row text-center text-md-start  @if($test_results) @if($my_result != null && $element->data_json != null && $my_result->b_result == $data_json->b_result) correct-answer @else bad-answer @endif @endif">

                <div class="switch-box d-grid text-center ">
                    <label class="switch  ms-auto me-auto">
                        <input type="checkbox"   class="b-radio radio-rule-slider" @if($element->data_json != null && $data_json->b_result && $edit)value="{{$data_json->b_result}}" checked @elseif($test_results && $my_result != null && $my_result->b_result == '1') value="1" checked @else value="0" @endif>
                        <span class="slider round shadow-none" for="radio-rule-slider" onclick="changeSwitch(this, this.parentNode.children[0], this.parentNode.parentNode.children[1],'ANO','NE',this.parentNode.parentNode.children[3])"></span>
                    </label>
                    <div class="switch-label mt-2 font-weight-bolder text-su-blue fw-bold ">@if($element->data_json != null && $data_json->b_result &&  $edit)ANO @elseif($test_results && $my_result != null && $my_result->b_result == '1') ANO @else NE @endif</div>
                    <input class="d-none b" type="text" name="test-b-{{$element->id}}"  value="0" >
                </div>

                <span class="w-100 p-4 m-0 ms-md-4 text-su-blue h4 b-text" @if($edit) contentEditable=true @endif data-text="Zadejte odpověď B">@if($element->data_json != null){{$data_json->b_text}}@endif</span>

                @if($test_results)
                    <span class="my-1 my-sm-4">
                    @if($my_result != null && $element->data_json != null && $my_result->b_result == $data_json->b_result)
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle-fill text-su-blue mx-auto" viewBox="0 0 16 16">
                            <title>Správná odpověď</title>
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill text-su-orange mx-auto" viewBox="0 0 16 16">
                            <title>Špatná odpověď</title>
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                        @endif
                    </span>
                @endif
            </div>

            {{--Odpověd C--}}
            <div class="w-100 px-1 px-md-5 py-3 mt-3 rounded-3 bg-white d-inline-flex pt-4 flex-column-reverse flex-md-row text-center text-md-start  @if($test_results) @if($my_result != null && $element->data_json != null && $my_result->c_result == $data_json->c_result) correct-answer @else bad-answer @endif @endif">

                <div class="switch-box d-grid text-center ">
                    <label class="switch  ms-auto me-auto">
                        <input type="checkbox"   class="c-radio radio-rule-slider" @if($element->data_json != null && $data_json->c_result && $edit)value="{{$data_json->c_result}}" checked @elseif($test_results && $my_result != null && $my_result->c_result == '1') value="1" checked @else value="0" @endif>
                        <span class="slider round shadow-none" for="radio-rule-slider" onclick="changeSwitch(this, this.parentNode.children[0], this.parentNode.parentNode.children[1],'ANO','NE',this.parentNode.parentNode.children[3])"></span>
                    </label>
                    <div class="switch-label mt-2 font-weight-bolder text-su-blue fw-bold ">@if($element->data_json != null && $data_json->c_result &&  $edit)ANO @elseif($test_results && $my_result != null && $my_result->c_result == '1') ANO @else NE @endif</div>
                    <input class="d-none c" type="text" name="test-c-{{$element->id}}"  value="0" >
                </div>

                <span class="w-100 p-4 m-0 ms-md-4 text-su-blue h4 c-text" @if($edit) contentEditable=true @endif data-text="Zadejte odpověď C">@if($element->data_json != null){{$data_json->c_text}}@endif</span>
                @if($test_results)
                    <span class="my-1 my-sm-4">
                    @if($my_result != null && $element->data_json != null && $my_result->c_result == $data_json->c_result)
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle-fill text-su-blue mx-auto" viewBox="0 0 16 16">
                            <title>Správná odpověď</title>
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill text-su-orange mx-auto" viewBox="0 0 16 16">
                            <title>Špatná odpověď</title>
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                        @endif
                    </span>
                @endif
            </div>

            {{--Nastavení--}}
            @if($edit)
                <div class="w-100 px-1 px-md-5 py-3 mt-3 rounded-3 bg-white d-flex flex-wrap justify-content-between text-center text-md-start flex-column flex-md-row">
                    <div class="py-3">
                        <label class="fw-bold text-su-orange h5 p-1 m-0">Správně: </label>
                        <input class=" rounded-2 fw-bold text-su-shadow-white px-2 text-su-blue correct text-center text-md-start" type="number" title="+1 bod" placeholder="+1 bod" value="@if($element->data != null){{$element->data}}@else +1 @endif">
                    </div>
                    <div class="py-3">
                        <label class="fw-bold text-su-orange h5 p-1 m-0">Špatně: </label>
                        <input class=" rounded-2 fw-bold text-su-shadow-white px-2 text-su-blue bad text-center text-md-start" type="number" title="-1 bod" placeholder="-1 bod" value="@if($element->data1 != null){{$element->data1}}@else -1 @endif">
                    </div>
                    <button class="su-button-text text-white  su-button su-button-sucess m-0 " style="flex-basis: auto;"
                    onclick="saveABCtest(this.parentNode.parentNode.parentNode, this.parentNode.getElementsByClassName('loading')[0], this.parentNode.getElementsByClassName('loading_request')[0])"
                    >Nastavit odpovědi</button>

                    <div class="spinner-grow text-warning loading m-0 mx-auto" role="status" hidden></div>
                    <div class="loading_request m-0 fw-bold text-su-orange mx-auto" role="status" hidden></div>
                </div>
            @endif

            @if(Auth::permition()->edit_content == '1' &&  !$test_results)
                <div class="check-results w-100 d-block rounded mt-2" >
                    <a href="/element_abc_results/{{$element->id}}" class="text-decor-none w-content mx-auto mx-md-0 float-md-end text-su-blue fw-bold d-grid text-center bg-su-blue-gradient rounded-3 shadow p-3 su-animation-02 cursor-pointer su-hover-shadow text-su-shadow-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-lightbulb-fill text-su-orange mx-auto mb-2 su-svg-shadow-white" viewBox="0 0 16 16">
                            <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        VÝSLEDKY
                    </a>
                </div>
            @endif

        </div>

</div>
