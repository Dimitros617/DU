



<div  class="w-100 rounded-3 bg-su-blue-gradient shadow px-3 py-4 h2 text-white fw-bold text-su-shadow" placeholder="true" data-text="Zatím tu nejsou žádné zprávy...">@foreach($comments as $comment)

        <div class="w-100 my-2 p-3 pb-1 rounded text-su-shadow-none" style="background-color: #ffffff6b !important;" type="comments" element_id="{{$comment->id}}">
            <div class="w-100 d-flex flex-column-reverse flex-md-row justify-content-between">
                <a @if(Auth::permition()->new_user == "1") href="/users/{{$comment->user_id}}" @endif class="name text-decor-none d-flex flex-column flex-sm-row">
                    <spann class="h3 fw-bold text-su-orange pe-2">{{$comment->nick}}</spann>
                    <spann class="h5  text-su-blue pt-1"><span class="su-d-sm-none">|</span> {{$comment->name}} {{$comment->surname}}</spann>
                </a>
                <div class="d-flex flex-row justify-end mb-2 mb-sm-0">
                    <span class="fw-bold h6 text-su-blue">{{$comment->created_at}}</span>
                    @if(Auth::permition()->edit_content == "1" || Auth::user()->id == $comment->user_id)
                    <svg onclick="removeComment('{{$comment->id}}', this.parentNode.getElementsByClassName('loading')[0], this.parentNode.parentNode.parentNode)" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash-fill text-su-blue ms-2 su-hover-opacity cursor-pointer" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                    </svg>
                    @endif
                    <div class="spinner-grow text-warning loading m-0" role="status" hidden></div>
                    <div class="loading_request m-0 fw-bold text-su-orange " role="status" hidden></div>
                </div>
            </div>
            <div class="w-100 p-3 h5 mt-3  text-su-orange text-center text-sm-start" @if(Auth::permition()->edit_content == "1" || Auth::user()->id == $comment->user_id) origin="{{$comment->text}}" contenteditable onfocusout="if(this.innerText.trim() != this.getAttribute('origin')){ saveColumn(this.parentNode,this.parentNode.getElementsByClassName('loading')[0],this.parentNode.getElementsByClassName('loading_request')[0],this.innerText,'text') }" @endif>
                {{$comment->text}}
            </div>

        </div>

    @endforeach</div>

