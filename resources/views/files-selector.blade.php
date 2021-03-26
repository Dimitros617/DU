


<div class="">

    <div class="images-gallery d-flex flex-wrap justify-center" style="min-height: 20rem" aria-placeholder="Seznam souborů">

        @include('files-selector-gallery')

    </div>
    <div class="w-100 overflow-hidden">
        <div class="spinner-grow text-warning loading m-0" role="status" hidden></div>
        <div class="loading_request m-0 fw-bold text-su-orange " role="status" hidden></div>
    </div>
    <div class="images-add-bar w-100">
        <div class="input-group flex-wrap justify-center">
            <input type="text" class="form-control images-selector-url-input mb-2" style="min-width: 25rem;" placeholder="URL souboru">
            <div class="input-group-append">
                <button class="su-button su-button-sucess su-button-text text-white m-0 ms-2" type="button" onclick="addFile(this.parentNode.parentNode.getElementsByClassName('images-selector-url-input')[0].value,this.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0], this.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0]); refreshGallery(this.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('images-gallery')[0],'/file_selector_gallery')">Vložit</button>
                <button class="su-button su-button-danger su-button-text text-white m-0 ms-2" type="button" onclick="this.parentNode.getElementsByClassName('file-selector-file-input')[0].click()" >Vybrat soubor</button>
                <form hidden>
                    @csrf
                   <input type="file" name="file" class="file-selector-file-input" onchange="saveFile(this.parentNode,this.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0],this.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0]); refreshGallery(this.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByClassName('images-gallery')[0],'/file_selector_gallery')">
                </form>

            </div>
        </div>
    </div>
    <input type="text" id="file-selector-output" hidden>
</div>

