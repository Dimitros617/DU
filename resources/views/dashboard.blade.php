@section('title','Digitální učebnice')
@section('css', URL::asset('css/chapter-menu.css'))

<script src="/js/main.js"></script>
<script src="/js/chapters.js"></script>

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
                        <form method="post" action="{{url('/save_image')}}" enctype="multipart/form-data" id="chapterImageChange-{{$chapter->id}}" class="chapter">
                            @csrf

                        <div class="chapter_img" style="background-image: url('/user_files/{{$chapter->chapter_img}}');" onclick="this.parentNode.children[2].click()">
                            <div class="spinner-grow text-warning loading" role="status" hidden></div>
                            <div class="loading_request" role="status" hidden></div>
                        </div>
                        <input type="file" name="chapter_img" onchange="saveChapterImage(this,{{$chapter->id}})" hidden>
                        <input type="text" name="chapter_name" value="{{$chapter->name}}" hidden>

                        <div class="chapter_name" contenteditable oninput="this.parentNode.children[3].value = this.innerHTML">{{$chapter->name}}</div>
                        <input type="number" name="chapter_id" value="{{$chapter->id}}" hidden>

                        </form>
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
