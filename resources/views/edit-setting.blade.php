
<div class="h-6 bg-su-blue w-100 z-50" id="su-dragable-header">

</div>

<div class="edit-setting pt-16 pb-4 mt-2">

{{--    Informace--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">
        <label class="edit-setting-box-name bg-su-lwhite w-100 text-left mb-2 font-weight-bolder text-su-orange text-su-shadow-white ps-4 pt-4 pb-3 shadow h2 bg-su-texture">Informace</label>

        <div class="edit-setting-box-mini p-3 d-flex flex-column text-left ">
            <label class="edit-setting-label h3 text-su-blue text-su-shadow-white">Jméno
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle-fill text-su-shadow-white float-end su-svg-shadow-white su-tooltip"  viewBox="0 0 16 16">
                    <title>Jméno slouží především pro lepší orientaci, když vybíráte zámek elementu.</title>
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
                </svg>
            </label>
            <input type="text" placeholder="" class="w-100 p-2 su-input-white rounded mb-3">

            <label class="edit-setting-label h3 text-su-blue text-su-shadow-white">Popisek</label>
            <input type="text" placeholder="" class="w-100 p-2 su-input-white rounded mb-3" value="">

        </div>

    </div>

{{--    Pozadí--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">
        <label class="edit-setting-box-name bg-su-lwhite w-100 text-left mb-2 font-weight-bolder text-su-orange text-su-shadow-white ps-4 pt-4 pb-3 shadow h2 bg-su-texture">Pozadí</label>

        <div class="edit-setting-box-mini p-3 d-flex flex-column text-left ">
            <label class="edit-setting-label h3 text-su-blue text-su-shadow-white">Barva</label>
            <input type="color" placeholder="Vyberte barvu" class="w-100 h-1rem rounded mb-3">

            <label class="edit-setting-label h3 text-su-blue text-su-shadow-white">Obrázek</label>
            <input type="text" placeholder="URL obrázku" class="w-100 p-2 su-input-white rounded mb-3">

        </div>

    </div>


    {{--    Sloupce / floating--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">
        <label class="edit-setting-box-name bg-su-lwhite w-100 text-left mb-2 font-weight-bolder text-su-orange text-su-shadow-white ps-4 pt-4 pb-3 shadow h2 bg-su-texture">Sloupce
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle-fill text-su-orange me-3 text-su-shadow-white float-end su-svg-shadow-white su-tooltip"  viewBox="0 0 16 16">
                <title>Slouží k určení sloupce, pokud chcete mít dva sloupce vedle sebe, jeden element nastavte jako sloupec v pravo, a druhý jako sloupec v levo.</title>
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
            </svg>
        </label>

        <div class="edit-setting-box-mini p-3 d-flex flex-row text-left justify-content-around">

            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-square-half cursor-pointer text-su-orange su-animation-02 su-svg-shadow-white su-hover-opacity" viewBox="0 0 16 16">
                <title>Zarovnat na sloupec do leva</title>
                <path d="M8 15V1h6a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H8zm6 1a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12z"/>
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-square-fill cursor-pointer text-su-orange su-animation-02 su-svg-shadow-white su-hover-opacity" viewBox="0 0 16 16">
                <title>Roztáhnout na celou šířku</title>
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z"/>
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-square-half cursor-pointer text-su-orange su-animation-02 su-svg-shadow-white su-hover-opacity" viewBox="0 0 16 16" style="transform: rotate(180deg);">
                <title>Zarovnat na sloupec do prava</title>
                <path d="M8 15V1h6a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H8zm6 1a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12z"/>
            </svg>

        </div>

    </div>

    {{--    Margin--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">
        <label class="edit-setting-box-name bg-su-lwhite w-100 text-left mb-2 font-weight-bolder text-su-orange text-su-shadow-white ps-4 pt-4 pb-3 shadow h2 bg-su-texture">Vnější odsazení</label>

        <div class="edit-setting-box-mini p-3 d-flex flex-wrap  text-left ">
            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Nahoře</label>
                <input type="number" class="w-100 p-2 su-input-white rounded">
            </div>

            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Dole</label>
                <input type="number" class="w-100 p-2 su-input-white rounded">
            </div>

            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Vlevo</label>
                <input type="number" class="w-100 p-2 su-input-white rounded">
            </div>

            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Vpravo</label>
                <input type="number" class="w-100 p-2 su-input-white rounded">
            </div>

        </div>

    </div>

    {{--    Padding--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">
        <label class="edit-setting-box-name bg-su-lwhite w-100 text-left mb-2 font-weight-bolder text-su-orange text-su-shadow-white ps-4 pt-4 pb-3 shadow h2 bg-su-texture">Vnitřní odsazení</label>

        <div class="edit-setting-box-mini p-3 d-flex flex-wrap  text-left ">
            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Nahoře</label>
                <input type="number" class="w-100 p-2 su-input-white rounded">
            </div>

            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Dole</label>
                <input type="number" class="w-100 p-2 su-input-white rounded">
            </div>

            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Vlevo</label>
                <input type="number" class="w-100 p-2 su-input-white rounded">
            </div>

            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Vpravo</label>
                <input type="number" class="w-100 p-2 su-input-white rounded">
            </div>

        </div>

    </div>

</div>


