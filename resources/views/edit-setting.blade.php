
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

            <input type="text"
                   placeholder="Toto pole nesmí být prázdné"
                   class="w-100 p-2 su-input-white rounded mb-3 font-weight-500"
                   value=""
                   onchange="edit_saveAttribute(this, '{{$data->table_name}}','{{$data->id}}','name')"
                   onload="edit_loadAttribute(this, '{{$data->table_name}}','{{$data->id}}','name')"
            >

            <label class="edit-setting-label h3 text-su-blue text-su-shadow-white">Popisek</label>

            <input type="text"
                   placeholder="Toto pole nesmí být prázdné"
                   class="w-100 p-2 su-input-white rounded mb-3 font-weight-500"
                   value=""
                   onchange="edit_saveAttribute(this, '{{$data->table_name}}','{{$data->id}}','description')"
                   onload="edit_loadAttribute(this, '{{$data->table_name}}','{{$data->id}}','description')"
            >

        </div>

    </div>

{{--    Pozadí--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">
        <label class="edit-setting-box-name bg-su-lwhite w-100 text-left mb-2 font-weight-bolder text-su-orange text-su-shadow-white ps-4 pt-4 pb-3 shadow h2 bg-su-texture">Pozadí</label>

        <div class="edit-setting-box-mini p-3 d-flex flex-column text-left ">
            <label class="edit-setting-label h3 text-su-blue text-su-shadow-white">Barva</label>
            <input type="color"
                   placeholder="Vyberte barvu"
                   class="w-100 h-1rem rounded mb-3"
                   value="red"
                   oninput="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','background-color')"
                   onload="edit_loadStyle(this, '{{$data->table_name}}','{{$data->id}}','background-color')"
            >

            <label class="edit-setting-label h3 text-su-blue text-su-shadow-white">Obrázek</label>
            <div class="d-inline-flex justify-content-between">
            <input type="text"
                   placeholder="URL obrázku"
                   class="input-image-url p-2 su-input-white rounded mb-3 font-weight-500 me-3 "
                   style="width: -moz-fit-content; width: -webkit-fill-available;"
                   onchange="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','background-image')"
                   onload="edit_loadStyle(this, '{{$data->table_name}}','{{$data->id}}','background-image')"
            >
                <svg title="Změnit obrázek" onclick="imageSelector(null,document.getElementById('{{$data->table_name}}_{{$data->id}}'), null);     $('input[onload]').trigger('onload');" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-image text-white cursor-pointer" viewBox="0 0 16 16">
                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                </svg>
            </div>
            <label class="edit-setting-label h3 text-su-blue text-su-shadow-white">Video
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle-fill text-su-shadow-white float-end su-svg-shadow-white su-tooltip"  viewBox="0 0 16 16">
                    <title>Adresa z YOUTUBE musí obsahovat "EMBED" aby byla validní např: www.youtube.com/embed</title>
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
                </svg>
            </label>
            <input type="text"
                   placeholder="URL videa"
                   class="w-100 p-2 su-input-white rounded mb-3 font-weight-500"
                   onchange="edit_saveAttribute(this, '{{$data->table_name}}','{{$data->id}}','src', false)"
                   onload="edit_loadAttribute(this, '{{$data->table_name}}','{{$data->id}}','src', false)"
            >



        </div>

    </div>

    {{--    zarovnání obrázku--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">
        <label class="edit-setting-box-name bg-su-lwhite w-100 text-left mb-2 font-weight-bolder text-su-orange text-su-shadow-white ps-4 pt-4 pb-3 shadow h2 bg-su-texture">Zarovnání obrázku</label>

        <div class="edit-setting-box-mini p-3 d-flex flex-row text-left justify-content-around flex-wrap">

            <input onload="edit_loadStyle(this.parentNode.getElementsByClassName('edit-setting-align-image-top-svg')[0], '{{$data->table_name}}','{{$data->id}}','float-left')" hidden>
            <div class="w-100 overflow-hidden justify-center d-flex">
                <svg  xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="w-100 mb-4 edit-setting-align-image-top-svg bi bi-square-half cursor-pointer text-su-orange su-animation-02 su-svg-shadow-white su-hover-opacity" viewBox="0 0 16 16" style="transform: rotate(90deg);"
                      onclick="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','image-top')"
                >
                    <title>Zarovnat obrázek nahoru</title>
                    <path d="M8 15V1h6a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H8zm6 1a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12z"/>
                </svg>
            </div>

{{--            Střední vrstva--}}
            <input onload="edit_loadStyle(this.parentNode.getElementsByClassName('edit-setting-align-image-left-svg')[0], '{{$data->table_name}}','{{$data->id}}','image-left')" hidden>
            <svg  xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="edit-setting-align-image-left-svg bi bi-square-half cursor-pointer text-su-orange su-animation-02 su-svg-shadow-white su-hover-opacity" viewBox="0 0 16 16"
                 onclick="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','image-left')"
            >
                <title>Zarovnat obrázek doleva</title>
                <path d="M8 15V1h6a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H8zm6 1a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12z"/>
            </svg>

            <input onload="edit_loadStyle(this.parentNode.getElementsByClassName('edit-setting-align-image-center-svg')[0], '{{$data->table_name}}','{{$data->id}}','image-center')" hidden>
            <svg  xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class=" edit-setting-align-image-center-svg bi bi-square-fill cursor-pointer text-su-orange su-animation-02 su-svg-shadow-white su-hover-opacity" viewBox="0 0 16 16"
                 onclick="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','image-center')"
            >
                <title>Zarovnat obrázek na střed</title>
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z"/>
            </svg>

            <input onload="edit_loadStyle(this.parentNode.getElementsByClassName('edit-setting-align-image-right-svg')[0], '{{$data->table_name}}','{{$data->id}}','image-right')" hidden>
            <svg  xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class=" edit-setting-align-image-right-svg bi bi-square-half cursor-pointer text-su-orange su-animation-02 su-svg-shadow-white su-hover-opacity" viewBox="0 0 16 16" style="transform: rotate(180deg);"
                 onclick="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','image-right')"
            >
                <title>Zarovnat obrázek doprava</title>
                <path d="M8 15V1h6a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H8zm6 1a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12z"/>
            </svg>
{{--            3 vrstva--}}

            <input onload="edit_loadStyle(this.parentNode.getElementsByClassName('edit-setting-align-image-bottom-svg')[0], '{{$data->table_name}}','{{$data->id}}','image-bottom')" hidden>
            <div class="w-100 overflow-hidden justify-center d-flex">
                <svg  xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="mt-4 edit-setting-align-image-bottom-svg bi bi-square-half cursor-pointer text-su-orange su-animation-02 su-svg-shadow-white su-hover-opacity" viewBox="0 0 16 16" style="transform: rotate(270deg);"
                      onclick="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','image-bottom')"
                >
                    <title>Zarovnat obrázek dolu</title>
                    <path d="M8 15V1h6a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H8zm6 1a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12z"/>
                </svg>
            </div>

        </div>

    </div>

    {{--    zarovnání obrázku--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">
        <label class="edit-setting-box-name bg-su-lwhite w-100 text-left mb-2 font-weight-bolder text-su-orange text-su-shadow-white ps-4 pt-4 pb-3 shadow h2 bg-su-texture">Roztažení obrázku</label>

        <div class="edit-setting-box-mini p-3 d-flex flex-row text-left justify-content-around">


            <input onload="edit_loadStyle(this.parentNode.getElementsByClassName('edit-setting-align-image-cover-svg')[0], '{{$data->table_name}}','{{$data->id}}','image-cover')" hidden>
            <svg  xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="edit-setting-align-image-cover-svg bi bi-square-half cursor-pointer text-su-orange su-animation-02 su-svg-shadow-white su-hover-opacity" viewBox="0 0 16 16"
                  onclick="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','image-cover')"
            >
                <title>Roztáhnout obrázek</title>
                <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707z"/>
            </svg>

            <input onload="edit_loadStyle(this.parentNode.getElementsByClassName('edit-setting-align-image-contain-svg')[0], '{{$data->table_name}}','{{$data->id}}','image-contain')" hidden>
            <svg  xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class=" edit-setting-align-image-contain-svg bi bi-square-fill cursor-pointer text-su-orange su-animation-02 su-svg-shadow-white su-hover-opacity" viewBox="0 0 16 16"
                  onclick="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','image-contain')"
            >
                <title>Přizpůsobit obrázek</title>
                <path fill-rule="evenodd" d="M.172 15.828a.5.5 0 0 0 .707 0l4.096-4.096V14.5a.5.5 0 1 0 1 0v-3.975a.5.5 0 0 0-.5-.5H1.5a.5.5 0 0 0 0 1h2.768L.172 15.121a.5.5 0 0 0 0 .707zM15.828.172a.5.5 0 0 0-.707 0l-4.096 4.096V1.5a.5.5 0 1 0-1 0v3.975a.5.5 0 0 0 .5.5H14.5a.5.5 0 0 0 0-1h-2.768L15.828.879a.5.5 0 0 0 0-.707z"/>
            </svg>

        </div>

    </div>


    {{--    Sloupce / floating--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">
        <label class="edit-setting-box-name bg-su-lwhite w-100 text-left mb-2 font-weight-bolder text-su-orange text-su-shadow-white ps-4 pt-4 pb-3 shadow h2 bg-su-texture">Přichycení
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle-fill text-su-orange me-3 text-su-shadow-white float-end su-svg-shadow-white su-tooltip"  viewBox="0 0 16 16">
                <title>Slouží k určení sloupce, pokud chcete mít dva sloupce vedle sebe, jeden element nastavte jako sloupec v pravo, a druhý jako sloupec v levo.</title>
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z"/>
            </svg>
        </label>

        <div class="edit-setting-box-mini p-3 d-flex flex-row text-left justify-content-around">

            <input onload="edit_loadStyle(this.parentNode.getElementsByClassName('edit-setting-float-left-svg')[0], '{{$data->table_name}}','{{$data->id}}','float-left')" hidden>
            <svg id="edit-setting-float-left-svg" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="edit-setting-float-left-svg bi bi-square-half cursor-pointer text-su-orange su-animation-02 su-svg-shadow-white su-hover-opacity" viewBox="0 0 16 16"
                 onclick="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','float-left')"
                            >
                <title>Zarovnat na sloupec do leva</title>
                <path d="M8 15V1h6a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H8zm6 1a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12z"/>
            </svg>

            <input onload="edit_loadStyle(this.parentNode.getElementsByClassName('edit-setting-float-none-svg')[0], '{{$data->table_name}}','{{$data->id}}','float-none')" hidden>
            <svg id="edit-setting-float-none-svg" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class=" edit-setting-float-none-svg bi bi-square-fill cursor-pointer text-su-orange su-animation-02 su-svg-shadow-white su-hover-opacity" viewBox="0 0 16 16"
                 onclick="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','float-none')"
            >
                <title>Roztáhnout na celou šířku</title>
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2z"/>
            </svg>

            <input onload="edit_loadStyle(this.parentNode.getElementsByClassName('edit-setting-float-right-svg')[0], '{{$data->table_name}}','{{$data->id}}','float-right')" hidden>
            <svg id="edit-setting-float-right-svg" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class=" edit-setting-float-right-svg bi bi-square-half cursor-pointer text-su-orange su-animation-02 su-svg-shadow-white su-hover-opacity" viewBox="0 0 16 16" style="transform: rotate(180deg);"
                 onclick="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','float-right')"
            >
                <title>Zarovnat na sloupec do prava</title>
                <path d="M8 15V1h6a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H8zm6 1a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12z"/>
            </svg>

        </div>

    </div>

    {{--    Velikosti--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">
        <label class="edit-setting-box-name bg-su-lwhite w-100 text-left mb-2 font-weight-bolder text-su-orange text-su-shadow-white ps-4 pt-4 pb-3 shadow h2 bg-su-texture">Velikost</label>

        <div class="edit-setting-box-mini p-3 d-flex flex-wrap  text-left ">
            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Šířka</label>
                <input type="text" class="w-100 p-2 su-input-white rounded font-weight-500 text-center" value="auto"
                       onchange="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','width')"
                       onload="edit_loadStyle(this, '{{$data->table_name}}','{{$data->id}}','width')"
                >
            </div>

            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Výška</label>
                <input type="text" class="w-100 p-2 su-input-white rounded font-weight-500 text-center" value="auto"
                       onchange="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','height')"
                       onload="edit_loadStyle(this, '{{$data->table_name}}','{{$data->id}}','height')"
                >
            </div>

        </div>

    </div>

    {{--    Margin--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">
        <label class="edit-setting-box-name bg-su-lwhite w-100 text-left mb-2 font-weight-bolder text-su-orange text-su-shadow-white ps-4 pt-4 pb-3 shadow h2 bg-su-texture">Vnější odsazení</label>

        <div class="edit-setting-box-mini p-3 d-flex flex-wrap  text-left ">
            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Nahoře</label>
                <input type="text" class="w-100 p-2 su-input-white rounded font-weight-500 text-center" value="0"
                       onchange="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','margin-top')"
                       onload="edit_loadStyle(this, '{{$data->table_name}}','{{$data->id}}','margin-top')"
                >
            </div>

            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Dole</label>
                <input type="text" class="w-100 p-2 su-input-white rounded font-weight-500 text-center" value="3 rem"
                       onchange="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','margin-bottom')"
                       onload="edit_loadStyle(this, '{{$data->table_name}}','{{$data->id}}','margin-bottom')"
                >
            </div>

            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Vlevo</label>
                <input type="text" class="w-100 p-2 su-input-white rounded font-weight-500 text-center" value="0"
                       onchange="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','margin-left')"
                       onload="edit_loadStyle(this, '{{$data->table_name}}','{{$data->id}}','margin-left')"
                >
            </div>

            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Vpravo</label>
                <input type="text" class="w-100 p-2 su-input-white rounded font-weight-500 text-center" value="0"
                       onchange="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','margin-right')"
                       onload="edit_loadStyle(this, '{{$data->table_name}}','{{$data->id}}','margin-right')"
                >
            </div>

        </div>

    </div>

    {{--    Padding--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">
        <label class="edit-setting-box-name bg-su-lwhite w-100 text-left mb-2 font-weight-bolder text-su-orange text-su-shadow-white ps-4 pt-4 pb-3 shadow h2 bg-su-texture">Vnitřní odsazení</label>

        <div class="edit-setting-box-mini p-3 d-flex flex-wrap  text-left ">
            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Nahoře</label>
                <input type="text" class="w-100 p-2 su-input-white rounded font-weight-500 text-center" value="1.5 rem"
                       onchange="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','padding-top')"
                       onload="edit_loadStyle(this, '{{$data->table_name}}','{{$data->id}}','padding-top')"
                >
            </div>

            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Dole</label>
                <input type="text" class="w-100 p-2 su-input-white rounded font-weight-500 text-center" value="1.5 rem"
                       onchange="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','padding-bottom')"
                       onload="edit_loadStyle(this, '{{$data->table_name}}','{{$data->id}}','padding-bottom')"
                >
            </div>

            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Vlevo</label>
                <input type="text" class="w-100 p-2 su-input-white rounded font-weight-500 text-center" value="1.5 rem"
                       onchange="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','padding-left')"
                       onload="edit_loadStyle(this, '{{$data->table_name}}','{{$data->id}}','padding-left')"
                >
            </div>

            <div class="flex-column w-50 p-2">
                <label class="edit-setting-label h3 text-su-blue text-su-shadow-white w-100 text-center">Vpravo</label>
                <input type="text" class="w-100 p-2 su-input-white rounded font-weight-500 text-center" value="1.5 rem"
                       onchange="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','padding-right')"
                       onload="edit_loadStyle(this, '{{$data->table_name}}','{{$data->id}}','padding-right')"
                >
            </div>

        </div>

    </div>

    {{--    CSS--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">
        <label class="edit-setting-box-name bg-su-lwhite w-100 text-left mb-2 font-weight-bolder text-su-orange text-su-shadow-white ps-4 pt-4 pb-3 shadow h2 bg-su-texture">Vlastní CSS</label>

        <div class="edit-setting-box-mini p-3 d-flex flex-column text-left ">

            <input onload="edit_loadStyle(this.parentNode.getElementsByClassName('edit-setting-custom-css')[0], '{{$data->table_name}}','{{$data->id}}','css')"  hidden>
            <textarea class="edit-setting-custom-css mx-auto m-1 p-3 w-100 bg-white rounded-3 font-weight-500" style="min-height: 200px"
                      onchange="edit_saveStyle(this, '{{$data->table_name}}','{{$data->id}}','css')"
            ></textarea>

        </div>

    </div>


    {{--    Default--}}
    <div class="edit-setting-box rounded-3  bg-su-blue-gradient shadow su-hover-shadow su-animation-05 overflow-hidden mb-4">

        <div class="edit-setting-box-mini p-3 d-flex flex-column text-left ">

            <button class="su-button" onclick="edit_resetStyle('{{$data->table_name}}','{{$data->id}}')">
                <label class="su-button-text cursor-pointer mt-2 mb-2 text-su-shadow-white">OBNOVIT NASTAVENÍ DO PŮVODNÍHO</label>
            </button>

        </div>

    </div>

</div>


