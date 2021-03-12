@section('title', 'Kapitola ' . $chapter->name )
@section('css', URL::asset('css/chapter.css'))
<x-app-layout>

    <x-slot name="header"></x-slot>

    <script src="/js/main.js"></script>

    <form>
        @csrf
        <input type="text" name="table_name" value="chapters"  hidden>
        <input type="number" name="id" value="{{$chapter->id}}" hidden>
        <input type="text" class="hidden_input_name" name="name" value="{{$chapter->name}}"hidden>

        <div class="pageTitle mb-4 mt-8 text-su-shadow-white" contenteditable="" oninput="this.parentNode.getElementsByClassName('hidden_input_name')[0].value = this.getElementsByClassName('raw-data')[0].innerHTML" onfocusout="saveName(this.parentNode,'chapters',{{$chapter->id}},this.getElementsByClassName('loading')[0],this.getElementsByClassName('loading_request')[0])">
            <div class="raw-data">{{$chapter->name}}</div>
            <div class="spinner-grow text-warning loading" role="status" hidden></div>
            <div class="loading_request" role="status" hidden></div>
        </div>
    </form>

    <div class="bg-white overflow-hidden box-su-shadow sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">

        @for ($i = 0; $i < 10; $i++)
            @include('add-bar')
        @endfor


    </div>

</x-app-layout>
