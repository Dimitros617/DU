@section('title',"Seznam uživatelů")
@section('css', URL::asset('css/user.css'))
@section('css2', URL::asset('css/results.css'))
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Výsledky') }}
        </h2>
    </x-slot>
    <script src="/js/main.js"></script>
    <script src="/js/content.js"></script>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container p-6 ">

            <div class="pageTitle mb-4 mt-8 text-su-shadow-white">Všechny výsledky</div>
            @csrf

            <div class="d-flex flex-wrap">
            @foreach($results as $result)

                @php
                    $url_name = explode('/', $result->data);
                    $url_name = $url_name[count($url_name)-1];
                @endphp

                <div class="box rounded-3 shadow m-2 p-3 bg-su-blue-gradient" style="min-width: 30%" type="results" element_id="{{$result -> id}}">

                    <div class="nameDiv">

                        <div class="nick">
                            {{$result -> nick}}
                        </div>

                        <div class="name">
                            {{$result -> name}}
                            {{$result -> surname}}
                        </div>

                    </div>

                    <a class="file_download cursor-pointer "  href="{{$result -> data}}" download="{{$url_name}}" title="Stáhnout soubor">
                        <div class="p-3 shadow rounded su-animation-02 su-hover-shadow my-3 bg-su-blue-orange-gradient ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-file-earmark text-su-orange mx-auto su-svg-shadow-white" viewBox="0 0 16 16">
                            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                        </svg>
                        <label class="text-center w-100 h3 text-su-shadow-white text-su-orange cursor-pointer mt-1">{{$url_name}}</label>
                        <label class="text-center w-100 text-su-shadow-white text-su-orange cursor-pointer mt-1 ">{{$result -> updated_at}}</label>
                        </div>
                    </a>

                    <div class="result" >
                        <input type="text" title="Hodnocení" class="su-input-white w-100" placeholder="Hodnocení..." value="{{$result -> result}}" onchange="saveColumn(this.parentNode.parentNode, this.parentNode.parentNode.getElementsByClassName('loading')[0], this.parentNode.parentNode.getElementsByClassName('loading_request')[0],this.value,'result')">
                    </div>

                    <div class="comment mt-2 text-white p-2" title="Komentář"  contentEditable=true data-text="Komentář..."
                         onfocusout="saveColumn(this.parentNode, this.parentNode.getElementsByClassName('loading')[0], this.parentNode.getElementsByClassName('loading_request')[0],this.innerHTML,'comments')"
                    >@if($result -> result != null){{$result -> comments}}@endif</div>
                    <div class="w-100 d-flex">
                        <div class="spinner-grow text-warning loading m-0 mx-auto" role="status" hidden></div>
                        <div class="loading_request m-0 fw-bold text-su-orange mx-auto" role="status" hidden></div>
                    </div>
                </div>

            @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
