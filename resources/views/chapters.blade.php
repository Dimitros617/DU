@section('title','Digitální učebnice')
@section('css', URL::asset('css/chapter-menu.css'))

@section('title_name',$title_name)

<script src="/js/main.js"></script>
<script src="/js/chapters.js"></script>
<script src="/js/lock.js"></script>
<script src="/js/content.js"></script>

<x-app-layout>
    <x-slot name="header">



    </x-slot>
    @include('button-bar')
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

                            <a @if(Auth::permition()->edit_content == "1")
                               onclick="if(this.children[0] == event.target)checkLock({{$chapter->id}},'chapters',this.getElementsByClassName('loading')[0],this.getElementsByClassName('loading_request')[0], '/chapter/{{$chapter->id}}',this.children[0].children[0].value )"
                               @else
                               onclick="checkLock({{$chapter->id}},'chapters',this.getElementsByClassName('loading')[0],this.getElementsByClassName('loading_request')[0], '/chapter/{{$chapter->id}}',this.children[0].children[0].value )"
                               @endif

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
                            @if(Auth::permition()->edit_content == "1")
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
                                    <svg onload="changeLockImg(this, this.parentNode.parentNode.parentNode.parentNode.getAttribute('locked').trim())" onclick=" setTimeout(function (ele,id,spinner,request, token){setLock(ele, id,'chapters',spinner,request, token)},50,this.parentNode.parentNode.parentNode.parentNode,{{$chapter->id}},this.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0], this.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0],this.parentNode.parentNode.parentNode.parentNode.children[0].value); return false" title="Nastavit zámek" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                    </svg>
                                </div>

                            </div>
                            @endif
                            <div class="spinner-grow text-warning loading @if(Auth::permition()->edit_content != "1") mt-2 @endif" role="status" hidden></div>
                            <div class="loading_request" role="status" hidden></div>
                        </div>
                            <input type="text" class="input_chapter_img" name="img" value="" onclick="saveColumn(this.parentNode, this.parentNode.getElementsByClassName('loading')[0], this.parentNode.getElementsByClassName('loading_request')[0], this.value, 'img')" hidden>
                            <input type="text" name="table_name" value="chapters"  hidden>
                            <input type="number" name="id" value="{{$chapter->id}}" hidden>

                            <input type="text" class="hidden_input_name" name="name" value="{{$chapter->name}}" default="{{$chapter->name}}"  hidden>
                            <input type="number" name="chapter_id" value="{{$chapter->id}}" hidden>

                        <div class="chapter_name" @if(Auth::permition()->edit_content == "1") contenteditable onclick="return false" oninput="this.parentNode.getElementsByClassName('hidden_input_name')[0].value = this.innerHTML" onfocusout="saveText(this.parentNode,'chapters',{{$chapter->id}},this.parentNode.getElementsByClassName('loading')[0],this.parentNode.getElementsByClassName('loading_request')[0],'name')"    @endif>{{$chapter->name}}</div>


                        </form>
                            </a>
                        @endforeach
                            @if(Auth::permition()->edit_content == "1")
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
                                @endif
                    </div>







</x-app-layout>
