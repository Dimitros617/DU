@section('title','Digitální učebnice')
@section('css', URL::asset('css/chapter-menu.css'))

<script src="/js/main.js"></script>
<script src="/js/chapters.js"></script>
<script src="/js/lock.js"></script>
<script src="/js/content.js"></script>

<x-app-layout>
    <x-slot name="header">



    </x-slot>
    <div class="bg-white overflow-hidden box-su-shadow sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8 bg-su-orange-texture">
    <div class="container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">

            <div class="button-bar">

                <div class="su-button" onclick="location.href = '/users'">

                    <div class="su-button-image">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill su-button-svg " viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg>
                    </div>
                    <div class="su-button-text">TŘÍDNICE</div>

                </div>

                <div class="su-button" onclick="location.href = '/permitions'">

                    <div class="su-button-image" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill su-button-svg" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                        </svg>
                    </div>
                    <div class="su-button-text">ROLE</div>

                </div>

                <div class="su-button" onclick="location.href = '/user/profile'">

                    <div class="su-button-image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill su-button-svg" viewBox="0 0 16 16">
                            <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                        </svg>
                    </div>
                    <div class="su-button-text">NASTAVENÍ</div>

                </div>


                <div class="su-button" onclick="this.children[0].submit()">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    </form>
                    <div class="su-button-image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-power su-button-svg" viewBox="0 0 16 16">
                            <path d="M7.5 1v7h1V1h-1z"/>
                            <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                        </svg>
                    </div>
                    <div class="su-button-text">ODHLÁSIT</div>

                </div>


            </div>

                </div>
    </div>
    </div>
    <div class="pageTitle mb-4 mt-8 text-su-shadow-white">Kapitoly</div>


                    <div class="chapter_box ">

                        @foreach($chapters as $chapter)

                            @php
                                $lc = "1";
                            foreach ($locked as $lock){

                                if($lock->element_id == $chapter->id && $lock->locked == "0"){
                                    $lc = "0";
                                    break;
                                }
                            }
                            @endphp

                            <a onclick="if(this.children[0] == event.target)checkLock({{$chapter->id}},'chapters',this.getElementsByClassName('loading')[0],this.getElementsByClassName('loading_request')[0], '/chapter/{{$chapter->id}}',this.children[0].children[0].value )"
                               style="text-decoration: none"
                               type="chapters"
                               element_id="{{$chapter->id}}"
                            >

                        <form method="post"
                              action="{{url('/save_image')}}"
                              enctype="multipart/form-data"
                              id="chapterImageChange-{{$chapter->id}}"
                              class="chapter  {{$lc}}  @if(($chapter->security != null && $chapter->security != 'empty' && $lc != '0') || ( $chapter->security != null && $chapter->security != 'empty' && Auth::permition()->edit_content == '1')) locked-chapter @endif"
                              locked=" @if($chapter->security != null && $chapter->security != 'empty') 1 @else 0 @endif"
                              type="chapters"
                              element_id="{{$chapter->id}}"
                              @if($chapter->security == 'invisible' && Auth::permition()->edit_content != '1') hidden @endif
                        >
                            @csrf

                        <div class="chapter_img" style="background-image: url('{{$chapter->img}}');" >
                            <div class="gray-box">


                                <div class="status status-icon">
                                    <svg onclick=" setTimeout(function (spinner){getStatus(spinner,'/get_chapter_status/{{$chapter->id}}')},50,this.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0]); return false" title="Přehled žáků" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightbulb-fill" viewBox="0 0 16 16">
                                        <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </div>

                                <div class="remove status-icon">
                                    <svg title="Smazat kapitolu" onclick=" setTimeout(function (ele,load){removeElement(ele, load)},50,this.parentNode.parentNode.parentNode.parentNode.parentNode,this.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0]); return false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </div>

                                <div class="move-up status-icon">
                                    <svg onclick="  setTimeout(function (ele,load, req){ moveElement(ele,'up', load, req)},50,this.parentNode.parentNode.parentNode.parentNode.parentNode,this.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0],this.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0]); return false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
                                        <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753l-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
                                    </svg>
                                </div>

                                <div class="move-down lock status-icon">
                                    <svg onclick="  setTimeout(function (ele,load, req){ moveElement(ele,'down', load, req)},50,this.parentNode.parentNode.parentNode.parentNode.parentNode,this.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0],this.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0]); return false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right float-end" viewBox="0 0 16 16">
                                        <path d="M6 12.796V3.204L11.481 8 6 12.796zm.659.753l5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z"/>
                                    </svg>
                                </div>

                                <div class="image status-icon">
                                    <svg title="Změnit obrázek" onclick="setTimeout(function (input, imageElement, spinner){imageSelector(input, imageElement, spinner)},50,this.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('input_chapter_img')[0],this.parentNode.parentNode.parentNode, this.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0]); return false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                    </svg>
                                </div>

                                <div class="lock status-icon">
                                    <svg onload="changeLockImg(this, this.parentNode.parentNode.parentNode.parentNode.getAttribute('locked').trim())" onclick=" setTimeout(function (ele,id,spinner,request, token){setLock(ele, id,'chapters',spinner,request, token)},50,this,{{$chapter->id}},this.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0], this.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0],this.parentNode.parentNode.parentNode.parentNode.children[0].value); return false" title="Nastavit zámek" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                    </svg>
                                </div>

                            </div>
                            <div class="spinner-grow text-warning loading" role="status" hidden></div>
                            <div class="loading_request" role="status" hidden></div>
                        </div>
                            <input type="text" class="input_chapter_img" name="img" value="" onclick="saveColumn(this.parentNode, this.parentNode.getElementsByClassName('loading')[0], this.parentNode.getElementsByClassName('loading_request')[0], this.value, 'img')" hidden>
                            <input type="text" name="table_name" value="chapters"  hidden>
                            <input type="number" name="id" value="{{$chapter->id}}" hidden>

                            <input type="text" class="hidden_input_name" name="name" value="{{$chapter->name}}" default="{{$chapter->name}}"  hidden>
                            <input type="number" name="chapter_id" value="{{$chapter->id}}" hidden>

                        <div class="chapter_name" contenteditable onclick="return false" oninput="this.parentNode.getElementsByClassName('hidden_input_name')[0].value = this.innerHTML" onfocusout="saveText(this.parentNode,'chapters',{{$chapter->id}},this.parentNode.getElementsByClassName('loading')[0],this.parentNode.getElementsByClassName('loading_request')[0],'name')">{{$chapter->name}}</div>


                        </form>
                            </a>
                        @endforeach

                            <form method="post" action="{{url('/add_chapter')}}" class="chapter">
                                @csrf
                                <input type="text" name="id" value="{{$book}}" hidden>
                                <div >
                                    <button onclick="addChapter(this.parentNode.parentNode, this.getElementsByClassName('loading')[0], this.getElementsByClassName('symbol')[0])" class="new_chapter">
                                        <div class="spinner-grow text-warning loading" role="status" hidden></div>
                                        <span class="symbol" style="font-size: xxx-large">&#43;</span>
                                        <br>
                                        Přidat kapitolu
                                    </button>
                                </div>
                            </form>
                    </div>







</x-app-layout>
