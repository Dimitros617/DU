
window.contentEdit = 0;



window.addEventListener('beforeunload', (event) => {
    if(window.contentEdit<=0){
        delete e['returnValue'];
    }
    event.returnValue = `Ups.. našli jsme celkem ` + window.contentEdit + "neuložených záznamů.";
});

/**
 *
 * @param parent = (Element) Div který je editovaným boxem
 * @param icon = (Element) Ikonka plus svg, která se změní na loading bublinku
 * @param spinner = (Element) loading bublibka
 * @param type = (ID) ID typu elementu, které chceme vližit s tabulky element_types
 */
function addElement(parent, icon, spinner, type){

    if(icon == null || spinner == null){
        spinner = parent.getElementsByClassName('add-bar-loading')[0];
        icon = parent.getElementsByClassName('add-bar-icon')[0];
    }

    icon.setAttribute("hidden", "");
    spinner.removeAttribute("hidden");

    let table_name = parent.getAttribute("include");
    let id = parent.getAttribute("element_id");
    let token = document.querySelectorAll("input[name='_token']")[0].value;

    type = type == undefined ? null : type;

    if(table_name == "elements" && type == null){

        table_name = parent.getAttribute("type");

        $.ajax({
            url: '/get_element_selector',
            type: 'post',
            data: { _token: token, table_name: table_name, id: id},
            success:function(response){

                Swal.fire({
                    html: response,
                    showCloseButton: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                    showDenyButton: false,
                    focusConfirm: false,
                }).then((result) => {
                    if (result.isConfirmed) {

                        spinner.removeAttribute("hidden");

                    }
                    else if(result.isDenied){
                    }
                    else{
                    }

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
                icon.removeAttribute("hidden");

            }
        });

    }else{
        $.ajax({
            url: '/add_element',
            type: 'post',
            data: { _token: token, table_name: table_name, id: id, type: type},
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
                        data: { _token: token,
                            table_name: element_type,
                            name: element.getAttribute('name'),
                            description: element.getAttribute('description'),
                            style: element.getAttribute('style'),
                            src: element.getAttribute('src'),
                            data: element.getAttribute('data'),
                            data1: element.getAttribute('data1'),
                            data2: element.getAttribute('data2'),
                            results: element.getAttribute('results'),
                        },
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
                    ele.classList.remove('text-su-orange');
                    ele.classList.remove('unblend');
                }
                else if(result.isDenied){

                    element.setAttribute("style", element.getAttribute("old_style"));
                    ele.classList.remove('text-su-orange');
                    ele.classList.remove('unblend');
                    window.contentEdit--;
                }
                else{
                    if(window.contentEdit>0) {
                        ele.classList.add('text-su-orange');
                        ele.classList.add('unblend');
                        Swal.fire({
                            icon: 'warning',
                            title: 'POZOR!',
                            text: 'Nastavení nebylo uloženo, ale zůstane zobrazeno, dokud stránku znovu nenačteš. Pro jistotu jsem ti neuloženou práci zvýraznil.',
                        })
                    }
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

function saveColumn(element, spinner, request, data, column, route){

    route = route == undefined ? '/save_column' : route;

    let token =  document.querySelectorAll("input[name='_token']")[0].value;
    spinner.removeAttribute("hidden");
    $.ajax({
        url: route,
        type: 'post',
        data: { _token: token,
            data: data,
            table_name: element.getAttribute('type'),
            id: element.getAttribute('element_id'),
            column: column,
        },
        success:function(response){
            spinner.setAttribute("hidden", "");
            request.removeAttribute("hidden");
            request.innerHTML = '<b>&#10003;</b>';

            setTimeout(function (request){
                request.setAttribute("hidden", "");
            },1000,request);

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

}

function finishElement(element){

    Swal.fire({
        icon: "question",
        title: 'Opravdu?',
        text: 'Po označení této části za ukončenou, to nebudeš moci změnit.',
        showCloseButton: false,
        showCancelButton: false,
        showConfirmButton: true,
        showDenyButton: true,
        confirmButtonText: `Uložit`,
        denyButtonText: `Zrušit`,
        focusConfirm: false,
    }).then((result) => {
        if (result.isConfirmed) {

            let token =  document.querySelectorAll("input[name='_token']")[0].value;

            $.ajax({
                url: '/finish_element',
                type: 'post',
                data: { _token: token,
                    table_name: element.getAttribute('type'),
                    id: element.getAttribute('element_id'),
                },
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

                }
            });
        }
        else if(result.isDenied){

        }
        else{

        }

    })
}

function removeElement(element, spinner){

    let table_name =  element.getAttribute('type');
    let id = element.getAttribute('element_id');
    let token =  document.querySelectorAll("input[name='_token']")[0].value;

    spinner.removeAttribute("hidden");

    Swal.fire({
        icon: 'question',
        title:'Smazat?',
        text: 'Opravdu chcete tuto položku smazat?',
        showCloseButton: false,
        showCancelButton: false,
        showConfirmButton: true,
        showDenyButton: true,
        confirmButtonText: `Uložit`,
        denyButtonText: `Zrušit`,
        focusConfirm: false,
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: '/remove/'+table_name+'/'+id,
                type: 'delete',
                data:
                {
                    _token: token,
                    table_name: table_name,
                    id: id,
                },
                success:function(response){
                    element.remove();
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
        }
        else if(result.isDenied){

        }
        else{

        }

    })


}

// Swal.fire({
//     html: response,
//     showCloseButton: false,
//     showCancelButton: false,
//     showConfirmButton: true,
//     showDenyButton: true,
//     confirmButtonText: `Uložit`,
//     denyButtonText: `Zrušit`,
//     focusConfirm: false,
// }).then((result) => {
//     if (result.isConfirmed) {
//
//     }
//     else if(result.isDenied){
//
//     }
//     else{
//
//     }
//
// })
