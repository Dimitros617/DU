


function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function changeSwitch(ele, checkbox, label, yes, no, input){

    checkbox.value = checkbox.value == "1" ? "0" : "1";

    if(input != undefined){
        input.value = checkbox.value;
    }

    checkbox.click();
    checkbox.click();

    if(checkbox.value == "1"){
        checkbox.setAttribute("checked", "");
    }else{
        checkbox.removeAttribute("checked");
    }

    label.innerHTML = checkbox.value == "1" ? yes : no;
}

function changeRadio(ele){

    let other_radio = document.getElementsByClassName(ele.getAttribute('for'));

    for (let radio of other_radio){

        radio.value = "0";
        radio.removeAttribute('checked');
        radio.parentNode.parentNode.children[1].innerHTML = "VYPNUTO"
    }

    let checkbox = ele.parentNode.children[0];
    let label = ele.parentNode.parentNode.children[1];

    checkbox.value = "1";

    checkbox.click();
    checkbox.click();

    checkbox.setAttribute("checked", "");


    label.innerHTML = "ZAPNUTO";
}

function saveImage(form, table, id, loading, request, img){



    loading.removeAttribute("hidden");
    request.setAttribute("hidden", "");

    $.ajax({
        url: '/save_image',
        method: 'POST',
        data: new FormData(form),
        processData: false,
        contentType: false,
        datatype : "application/json",
        success:function(response){

            loading.setAttribute("hidden", "");
            request.removeAttribute("hidden");

            if(response[0] == "1"){
                let refresh = '?random=\\' + new Date().getTime();
                img.setAttribute("style","background-image: url('/user_files/"+ response[1] + refresh +"');");
                request.innerHTML = '<b>&#10003;</b>';
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Upss...',
                    text: 'Tento obrázek se nám nepodařilo nahrát. Zkuste jiný obrázek.',
                    customClass: {
                        container: 'su-shake-horizontal',
                    }
                })
                request.innerHTML = '<b>&#x2715;</b>';
            }

            setTimeout(function (request){
                request.setAttribute("hidden", "");
            },1000,request);


        },
        error: function (response){
            console.log(response);
            if(response.status == 422){
                Swal.fire({
                    icon: 'error',
                    title: 'Hmm...',
                    text: 'Tento soubor není obrázek v podporovaném formátu: jpg, png, jpeg, gif, svg. Nebo je větší než 4Mb' ,
                    customClass: {
                        container: 'su-shake-horizontal',
                    }
                })
            }
            else{
                let err = IsJsonString(response.responseText)? JSON.parse(response.responseText).messages : response.responseText
                Swal.fire({
                    icon: 'error',
                    title: 'Hmm... CHYBA!',
                    text: err ,
                    customClass: {
                        container: 'su-shake-horizontal',
                    }
                })
            }
            request.removeAttribute("hidden");
            loading.setAttribute("hidden", "");
            request.innerHTML = '<b>&#x2715;</b>';

            setTimeout(function (request){
                request.setAttribute("hidden", "");
            },1000,request);
        }
    });
}

/**
 *
 * @param form = (Element || undefined) = pokud je definován formulář data jsou serializována pokud ne je nutné vyplnit "token", "table_name" a "id"
 * @param table = (String) Jméno tabulky elementu
 * @param id = (Int) ID elementu z z tabulky v databázi
 * @param loading = (Element) Loading spinner
 * @param request = (Element) label pro vypsání requestu
 * @param route = (String) kterou routu, tedy co chceme uloži "text", "description"...
 * @param token (String) pokud není definován form, stringová hodnota tokenu pro poslání POST metodou
 */
function saveText(form, table, id, loading, request, route, token){


    let element = form.querySelectorAll(("input[name="+route+"]"))[0];
    let value = element.value;
    let def = element.getAttribute("default");
    if(value.trim() == def.trim()){
        return false;
    }
    let data
    if(form == undefined){
        data = { _token: token, table_name: table, id: id}
    }else{
        data = new FormData(form);
    }


    loading.removeAttribute("hidden");
    request.setAttribute("hidden", "");

    $.ajax({
        url: '/save_'+route,
        method: 'POST',
        data: data,
        processData: false,
        contentType: false,
        datatype : "application/json",
        success:function(response){

            loading.setAttribute("hidden", "");
            request.removeAttribute("hidden");

            if(response[0] == "1"){
                element.setAttribute("default", element.value);
                request.innerHTML = '<b>&#10003;</b>';
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Upss...',
                    text: 'Nastal problém při ukládání do databáze, skuste to znovu, nebo kontaktujte administrátora!',
                    customClass: {
                        container: 'su-shake-horizontal',
                    }
                })
                request.innerHTML = '<b>&#x2715;</b>';
            }

            setTimeout(function (request){
                request.setAttribute("hidden", "");
            },1000,request);


        },
        error: function (response){
            console.log(response);
            let err = IsJsonString(response.responseText)? JSON.parse(response.responseText).messages : response.responseText
            Swal.fire({
                icon: 'error',
                title: 'Hmm...',
                text: 'Nastala chyba! ' + err,
                customClass: {
                    container: 'su-shake-horizontal',
                }
            })
            request.removeAttribute("hidden");
            loading.setAttribute("hidden", "");
            request.innerHTML = '<b>&#x2715;</b>';

            setTimeout(function (request){
                request.setAttribute("hidden", "");
            },1000,request);
        }
    });
}

function changeLockImg(ele, value){
    if(value =='1') {
        ele.classList.add('text-su-orange')
    }
}

$(function(){
    $('svg[onload]').trigger('onload');
    $('input[onload]').trigger('onload');
});


