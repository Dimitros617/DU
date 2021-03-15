
window.contentEdit = 0;



window.addEventListener('beforeunload', (event) => {
    if(window.contentEdit<=0){
        delete e['returnValue'];
    }
    event.returnValue = `Ups.. našli jsme celkem ` + window.contentEdit + "neuložených záznamů.";
});


function addElement(parent, icon, spinner){

    icon.setAttribute("hidden", "");
    spinner.removeAttribute("hidden");

    let element_type = parent.getAttribute("include");
    let id = parent.getAttribute("element_id");
    let token = document.querySelectorAll("input[name='_token']")[0].value;

    $.ajax({
        url: '/add_'+ element_type,
        type: 'post',
        data: { _token: token, table_name: element_type, id: id},
        success:function(response){


                location.reload();


        },
        error: function (response){
            console.log(response);
            let err = IsJsonString(response.responseText)? JSON.parse(response.responseText).messages : response.responseText
            Swal.fire({
                icon: 'error',
                title: 'Hmm... CHYBA!',
                text: err ,
                customClass: {
                    container: 'su-shake-horizontal',
                }
            })

            spinner.setAttribute("hidden", "");
            icon.removeAttribute("hidden");

        }
    });

}

function moveElement(parent, direction, request, loading){

    loading.removeAttribute("hidden");
    request.setAttribute("hidden", "");

    let element_type = parent.getAttribute("type");
    let id = parent.getAttribute("element_id");
    let token = document.querySelectorAll("input[name='_token']")[0].value;

    $.ajax({
        url: '/move',
        type: 'post',
        data: { _token: token, table_name: element_type, id: id, direction: direction},
        success:function(response){

            location.reload();

        },
        error: function (response){
            console.log(response);
            let err = IsJsonString(response.responseText)? JSON.parse(response.responseText).messages : response.responseText
            Swal.fire({
                icon: 'error',
                title: 'Hmm... CHYBA!',
                text: err ,
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

/**
 * @param ele = (Element( element tlačítka editace v edit baru
 * @param element = (Element) ten který budeme editovat live
 * @param id = (Int) Id elementu do databáze
 * @param element_type = (String) Jméno tabulky v databázi
 * @param spinner = (Element) Loading
 * @param request = (Element) Výspis pro stav requestu
 * @param token = (String) Token pro poslání POSTem
 */
function editSetting(ele, element, id, element_type, spinner, request, token){


    spinner.removeAttribute("hidden");
    request.setAttribute("hidden", "");

    if(token == undefined){
        token =  document.querySelectorAll("input[name='_token']")[0].value;
    }

    $.ajax({
        url: '/edit_setting/'+ element_type + "/" + id,
        method: 'get',
        success:function(response){

            spinner.setAttribute("hidden", "");

            setTimeout(function (){
                document.getElementsByClassName("su-dragable")[0].setAttribute("id","su-dragable")
                dragElement(document.getElementById("su-dragable"))
            },50)


            Swal.fire({
                html: response,
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton: true,
                showDenyButton: true,
                confirmButtonText: `Uložit`,
                denyButtonText: `Zrušit`,
                focusConfirm: false,
                customClass: 'su-dragable',
                backdrop: `
                            rgba(0,0,0,0)
                            left top
                            no-repeat
                          `
            }).then((result) => {
                if (result.isConfirmed) {

                    spinner.removeAttribute("hidden");
                    $.ajax({
                        url: '/save_setting/' + element_type + "/" + id,
                        type: 'post',
                        data: { _token: token, table_name: element_type, name: element.getAttribute('name'), description: element.getAttribute('description'), style: element.getAttribute('style')},
                        success:function(response){
                            spinner.setAttribute("hidden", "");
                            Swal.fire({
                                icon: 'success',
                                title: 'Uloženo',
                                text: 'Všechno jsme nastavily!',
                            })

                        },
                        error: function (response){
                            console.log(response);
                            let err = IsJsonString(response.responseText)? JSON.parse(response.responseText).messages : response.responseText
                            Swal.fire({
                                icon: 'error',
                                title: 'Hmm... CHYBA!',
                                text: err ,
                                customClass: {
                                    container: 'su-shake-horizontal',
                                }
                            })
                            spinner.setAttribute("hidden", "");

                        }
                    });
                    window.contentEdit--;

                }
                else if(result.isDenied){

                    element.setAttribute("style", element.getAttribute("old_style"));
                    window.contentEdit--;
                }
                else{
                    window.contentEdit++;
                    ele.classList.add('text-su-orange');
                    Swal.fire({
                        icon: 'warning',
                        title: 'POZOR!',
                        text: 'Nastavení nebylo uloženo, ale zůstane zobrazeno, dokud stránku znovu nenačteš. Pro jistotu jsem ti neuloženou práci zvýraznil.' ,
                    })
                }

            })
            $('input[onload]').trigger('onload');

        },
        error: function (response){
            console.log(response);
            let err = IsJsonString(response.responseText)? JSON.parse(response.responseText).messages : response.responseText
            Swal.fire({
                icon: 'error',
                title: 'Hmm... CHYBA!',
                text: err ,
                customClass: {
                    container: 'su-shake-horizontal',
                }
            })
            request.removeAttribute("hidden");
            spinner.setAttribute("hidden", "");
            request.innerHTML = '<b>&#x2715;</b>';

            setTimeout(function (request){
                request.setAttribute("hidden", "");
            },1000,request);
        }
    });
}
