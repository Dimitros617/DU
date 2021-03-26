@foreach($files as $file)

    <div class="chapter_img mx-2 my-2 overflow-visible" file_id="{{$file->id}}" url="{{$file->url}}"  style="background-image: url('/user_files/default.png')" >
        <div class="gray-box">

            <div class="status status-icon">
                <svg xmlns="http://www.w3.org/2000/svg" onclick="window.open(this.parentNode.parentNode.parentNode.getAttribute('url'),'blank');" width="16" height="16" fill="currentColor" class="bi bi-arrows-fullscreen" viewBox="0 0 16 16">
                    <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z"/>
                </svg>
            </div>

            <div class="remove status-icon">
                <svg title="Smazat kapitolu" onclick="removeFile(this.parentNode.parentNode.parentNode,this.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0],this.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0])"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                </svg>
            </div>

            <div class="image status-icon">
                <svg xmlns="http://www.w3.org/2000/svg" onclick="document.getElementById('file-selector-output').value = this.parentNode.parentNode.parentNode.getAttribute('url'); document.getElementsByClassName('swal2-confirm')[0].click()" width="30" height="30" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
            </div>

        </div>
        <label class="w-100 text-center text-su-orange fw-bold">{{$file->name}}</label>
    </div>

@endforeach
