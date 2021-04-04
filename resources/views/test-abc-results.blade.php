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
    <script src="/js/graph.js"></script>



    <script>

        window.graph_data = [
            {title: "A", x: "{{$graph->a_text}}", value: {{$graph->a_result}}, no:{{($graph->count - $graph->a_result)}}},
            {title: "B", x: "{{$graph->b_text}}", value: {{$graph->b_result}}, no:{{($graph->count - $graph->b_result)}}},
            {title: "C", x: "{{$graph->c_text}}", value: {{$graph->c_result}}, no:{{($graph->count - $graph->c_result)}}},
        ];


    </script>

    <div class="bg-white overflow-hidden mb-4 shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container p-6 ">
            <input onload="document.getElementById('graph').innerHTML = ''; drawGraph(window.graph_data); this.remove()">
            <label class="text-su-orange fw-bold h2 text-center w-100 cursor-help"  title="V grafu se zobrazují pouze první odevzdané výsledky!">První výsledky</label>
            <div id="graph" class=" text-su-orange fw-bold h2 text-center" style="height: 25rem;">
                Načítám graf
                <br>
                <div class="spinner-grow text-warning loading m-0 mx-auto" role="status"></div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container p-6 ">

            <div class="pageTitle mb-4 mt-8 text-su-shadow-white">Všechny výsledky</div>
            @csrf

            <div class="d-flex flex-wrap justify-content-around">
            @foreach($results as $result)


                <div class="box rounded-3 shadow m-2 p-3 bg-su-blue-gradient su-w-sm-100" style="min-width: 30%" type="results" element_id="{{$result -> id}}">

                    @if(Auth::permition()->edit_content == '1')
                    <div class="float-end">
                        <div class="spinner-grow text-black loading" role="status" hidden></div>
                        <div class="loading_request text-su-orange" role="status" hidden></div>
                        <div class=" edit-box-icon " onclick="removeElement(this.parentNode.parentNode, this.parentNode.getElementsByClassName('loading')[0])">
                            <svg  xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trash-fill" name="delete" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>
                        </div>
                    </div>
                    @endif

                    <div class="nameDiv">

                        <div class="nick">
                            {{$result -> nick}}
                        </div>

                        <div class="name">
                            {{$result -> name}}
                            {{$result -> surname}}
                        </div>

                    </div>

                        {{--                        Otázka A--}}
                    <div class="result-box bg-white rounded-3 p-0 my-3 shadow overflow-hidden">
                        <div class="d-flex flex-row justify-content-between w-100 px-4 pt-4 pb-1 bg-su-lblue bg-su-texture">
                            <span class="h2 fw-bold text-su-orange">A</span>
                            <span class="h2 text-su-orange">@if($result->a_result_val == "1") ANO @else NE @endif</span>
                            <span class="h2 fw-bold text-su-orange">
                                @if($result->a_result)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle-fill text-su-blue mx-auto cursor-help" viewBox="0 0 16 16">
                                        <title>Správná odpověď</title>
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill text-su-orange mx-auto cursor-help" viewBox="0 0 16 16">
                                        <title>Špatná odpověď</title>
                                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                    </svg>
                                @endif
                            </span>
                        </div>
                        <div class="w-100 h3 text-su-blue text-center">
                            {{$result->a_text}}
                        </div>
                    </div>

                    {{--                        Otázka B--}}
                    <div class="result-box bg-white rounded-3 p-0 my-3 shadow overflow-hidden">
                        <div class="d-flex flex-row justify-content-between w-100 px-4 pt-4 pb-1 bg-su-lblue bg-su-texture">
                            <span class="h2 fw-bold text-su-orange">B</span>
                            <span class="h2 text-su-orange">@if($result->b_result_val == "1") ANO @else NE @endif</span>
                            <span class="h2 fw-bold text-su-orange">
                            @if($result->b_result)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle-fill text-su-blue mx-auto cursor-help" viewBox="0 0 16 16">
                                    <title>Správná odpověď</title>
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill text-su-orange mx-auto cursor-help" viewBox="0 0 16 16">
                                    <title>Špatná odpověď</title>
                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                </svg>
                                @endif
                        </span>
                        </div>
                        <div class="w-100 h3 text-su-blue text-center">
                            {{$result->b_text}}
                        </div>
                    </div>

                    {{--                        Otázka C--}}
                    <div class="result-box bg-white rounded-3 p-0 my-3 shadow overflow-hidden">
                        <div class="d-flex flex-row justify-content-between w-100 px-4 pt-4 pb-1 bg-su-lblue bg-su-texture">
                            <span class="h2 fw-bold text-su-orange">C</span>
                            <span class="h2 text-su-orange">@if($result->c_result_val == "1") ANO @else NE @endif</span>
                            <span class="h2 fw-bold text-su-orange">
                            @if($result->c_result)
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
                        </div>
                        <div class="w-100 h3 text-su-blue text-center">
                            {{$result->c_text}}
                        </div>
                    </div>

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
