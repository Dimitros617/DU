@section('title','Digitální učebnice')
@section('css', URL::asset('css/chapter-menu.css'))

<script src="/js/main.js"></script>
<script src="/js/chapters.js"></script>
<script src="/js/lock.js"></script>

<x-app-layout>
    <x-slot name="header">



    </x-slot>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                NECO

                </div>
    </div>
    </div>
                    <div class="chapter_box">
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

                            <a onclick="if(this.children[0] == event.target)checkLock({{$chapter->id}},'chapters',this.getElementsByClassName('loading')[0],this.getElementsByClassName('loading_request')[0], '/chapter/{{$chapter->id}}',this.children[0].children[0].value )" style="text-decoration: none">
                        <form method="post" action="{{url('/save_image')}}" enctype="multipart/form-data" id="chapterImageChange-{{$chapter->id}}" class="chapter {{$chapter->security}} {{$lc}}  @if($chapter->security != null && $chapter->security != 'empty' && $lc != '0') locked-chapter @endif">
                            @csrf

                        <div class="chapter_img" style="background-image: url('/user_files/{{$chapter->chapter_img}}');" >
                            <div class="gray-box">


                                <div class="status status-icon">
                                    <svg onclick=" setTimeout(function (ele,id){getStatusChapter(ele, id)},50,this,{{$chapter->id}}); return false" title="Přehled žáků" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightbulb-fill" viewBox="0 0 16 16">
                                        <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </div>

                                <div class="remove status-icon">
                                    <svg  title="Smazat kapitolu" onclick=" setTimeout(function (ele,id){removeChapterBox(ele, id)},50,this,{{$chapter->id}}); return false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                    </svg>
                                </div>

                                <div class="image status-icon">
                                    <svg title="Změnit obrázek" onclick="this.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('input_chapter_img')[0].click(); return false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                    </svg>
                                </div>

                                <div class="lock status-icon">
                                    <svg onclick=" setTimeout(function (ele,id,spinner,request, token){setLock(ele, id,'chapters',spinner,request, token)},50,this,{{$chapter->id}},this.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0], this.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0],this.parentNode.parentNode.parentNode.parentNode.children[0].value); return false" title="Nastavit zámek" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                    </svg>
                                </div>

                            </div>
                            <div class="spinner-grow text-warning loading" role="status" hidden></div>
                            <div class="loading_request" role="status" hidden></div>
                        </div>
                        <input type="file" class="input_chapter_img" name="chapter_img" value="" onchange="saveChapterBox(this,{{$chapter->id}})" hidden>
                        <input type="text" name="chapter_name" value="{{$chapter->name}}"  hidden>

                        <div class="chapter_name" contenteditable onclick="return false" oninput="this.parentNode.children[3].value = this.innerHTML" onfocusout="saveChapterBox(this,{{$chapter->id}})">{{$chapter->name}}</div>
                        <input type="number" name="chapter_id" value="{{$chapter->id}}" hidden>

                        </form>
                            </a>
                        @endforeach

                            <form method="post" action="{{url('/add_chapter')}}" class="chapter">
                                @csrf
                                <div >
                                    <button type="submit" class="new_chapter"><span style="font-size: xxx-large">&#43;</span> <br>Přidat kapitolu</button>
                                </div>
                            </form>
                    </div>





        </div>
    </div>
    </div>
</x-app-layout>
