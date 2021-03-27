@section('title', 'Kapitola ' . $chapter->name )
@section('css', URL::asset('css/chapter.css'))
@section('css2', URL::asset('css/test.css'))
@section('title_name',$title_name)

<x-app-layout>

    <x-slot name="header"></x-slot>

    <script src="/js/main.js"></script>
    <script src="/js/lock.js"></script>
    <script src="/js/content.js"></script>
    <script src="/js/edit-setting.js"></script>
    <script src="/js/test.js"></script>


    @if(Auth::permition()->edit_content == "1" && !$edit && !$test_results)
    <div class="d-inline-block w-100 edit-bar" style="margin-top: -2rem;">

        <div class="d-flex float-end p-2 edit-box me-4">

            <div class=" edit-box-icon " onclick="this.classList.add('rotating-1'), this.children[0].classList.remove('setting-menu-gear'), setTimeout(function (){location.href = window.location.pathname +'/edit'},100)">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-gear-fill setting-menu-gear" name="setting" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                </svg>
            </div>

        </div>

    </div>
    @else
        <div class="d-inline-block w-100 edit-bar" style="margin-top: -2rem;">

            <div class="d-flex float-end p-2 edit-box me-4">

                <div class=" edit-box-icon " onclick="window.history.back();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-gear-fill" name="setting" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                </div>

            </div>

        </div>
    @endif

    <form>
        @csrf
        <input type="text" name="table_name" value="chapters"  hidden>
        <input type="number" name="id" value="{{$chapter->id}}" hidden>
        <input type="text" class="hidden_input_name" name="name" value="{{$chapter->name}}" default="{{$chapter->name}}" hidden>
        <div class="text-center">
            <div class="spinner-grow text-warning loading" role="status" hidden></div>
            <div class="loading_request text-su-orange" role="status" hidden></div>
        </div>
        <div class="pageTitle mb-4 mt-8 text-su-shadow-white"         @if($edit) contenteditable="" oninput="this.parentNode.getElementsByClassName('hidden_input_name')[0].value = this.innerHTML" onfocusout="saveText(this.parentNode,'chapters',{{$chapter->id}},this.parentNode.getElementsByClassName('loading')[0],this.parentNode.getElementsByClassName('loading_request')[0],'name')" @endif>
            {{$chapter->name}}
        </div>
    </form>


    <form>
        @csrf
        <input type="text" name="table_name" value="chapters"  hidden>
        <input type="number" name="id" value="{{$chapter->id}}" hidden>
        <input type="text" class="hidden_input_value" name="description" value="{{$chapter->description}}" default="{{$chapter->description}}" hidden>

        <div class="text-center">
            <div class="spinner-grow text-warning loading" role="status" hidden></div>
            <div class="loading_request text-su-orange" role="status" hidden></div>
        </div>

        <div class="mb-4 mt-8 p-4 text-su-orange font-weight-bold text-center h3 text-white text-su-shadow max-w-7xl mx-auto sm:px-6 lg:px-8"         @if($edit) contenteditable="" oninput="this.parentNode.getElementsByClassName('hidden_input_value')[0].value = this.innerHTML" onfocusout="saveText(this.parentNode,'chapters',{{$chapter->id}},this.parentNode.getElementsByClassName('loading')[0],this.parentNode.getElementsByClassName('loading_request')[0],'description')" @endif>
            {{$chapter->description}}
        </div>
    </form>

    <div id="chapters_{{$chapter->id}}" class="max-w-7xl mx-auto" type="chapters" include="big_box" element_id="{{$chapter->id}}" style="@if($test_results) pointer-events: none; @endif">

        @foreach($big_boxes as $big_box)

                @include('big-box')

        @endforeach

        @if($edit)
            @include('add-bar')
        @endif
    </div>




</x-app-layout>
