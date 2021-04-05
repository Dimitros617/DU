



<div>

    <div class="pageTitle mb-4 mt-8 text-su-shadow-white"> {{$name}} diskuze</div>

    <div id="chat-box">
    @include('chat-comments')
    </div>

    <div class="w-100 d-flex flex-column flex-sm-row mt-5">
        <div class=" chat-message w-100 me-3 h5 fw-bold p-2 text-center text-sm-start text-su-blue" contentEditable="true" data-text="Sem můžete psát zprávu..." ></div>
        <button class="su-button-text text-white  su-button su-button-sucess m-0 " style="flex-basis: auto;"
        onclick="addComment(this.getElementsByClassName('loading')[0],'{{$table_name}}','{{$element_id}}',this.parentNode.getElementsByClassName('chat-message')[0])"
        >
            ODESLAT
            <div class="spinner-grow text-warning loading m-0" role="status" hidden></div>
        </button>
    </div>
</div>

