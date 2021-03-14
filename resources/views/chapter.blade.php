@section('title', 'Kapitola ' . $chapter->name )
@section('css', URL::asset('css/chapter.css'))
<x-app-layout>

    <x-slot name="header"></x-slot>

    <script src="/js/main.js"></script>
    <script src="/js/lock.js"></script>
    <script src="/js/content.js"></script>
    <script src="/js/edit-setting.js"></script>

    <form>
        @csrf
        <input type="text" name="table_name" value="chapters"  hidden>
        <input type="number" name="id" value="{{$chapter->id}}" hidden>
        <input type="text" class="hidden_input_name" name="name" value="{{$chapter->name}}" default="{{$chapter->name}}" hidden>
        <div class="text-center">
            <div class="spinner-grow text-warning loading" role="status" hidden></div>
            <div class="loading_request text-su-orange" role="status" hidden></div>
        </div>
        <div class="pageTitle mb-4 mt-8 text-su-shadow-white" contenteditable="" oninput="this.parentNode.getElementsByClassName('hidden_input_name')[0].value = this.innerHTML" onfocusout="saveText(this.parentNode,'chapters',{{$chapter->id}},this.parentNode.getElementsByClassName('loading')[0],this.parentNode.getElementsByClassName('loading_request')[0],'name')">
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

        <div class="mb-4 mt-8 p-4 text-su-orange font-weight-bold text-center h3 text-white text-su-shadow max-w-7xl mx-auto sm:px-6 lg:px-8" contenteditable="" oninput="this.parentNode.getElementsByClassName('hidden_input_value')[0].value = this.innerHTML" onfocusout="saveText(this.parentNode,'chapters',{{$chapter->id}},this.parentNode.getElementsByClassName('loading')[0],this.parentNode.getElementsByClassName('loading_request')[0],'description')">
            {{$chapter->description}}
        </div>
    </form>

    <div id="page" type="page" include="big_box" element_id="{{$chapter->id}}">

        @foreach($big_boxes as $big_box)

                @include('big-box')

        @endforeach

        @include('add-bar')
    </div>




</x-app-layout>
