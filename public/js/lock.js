

function setLock(ele, id, element_type, spinner, request, token ){

    spinner.removeAttribute("hidden");
    request.setAttribute("hidden", "");

    $.ajax({
        url: '/rule_setting/'+ element_type + "/" + id,
        method: 'get',
        success:function(response){

            spinner.setAttribute("hidden", "");

            Swal.fire({
                html:
                response,
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton: true,
                showDenyButton: true,
                confirmButtonText: `Uložit`,
                denyButtonText: `Zrušit`,
                focusConfirm: false,
                customClass: 'modal-page',
            }).then((result) => {
                if (result.isConfirmed) {

                    let all_rules = document.getElementsByClassName('rule-box');

                    for (let rule of all_rules) {
                        let radio = rule.getElementsByClassName('radio-rule-slider')[0];
                        if(radio.value == "1"){

                            let key_type = rule.getAttribute('id');
                            let key = "null"

                            if(key_type != "empty"){
                                key = rule.getElementsByClassName('rule-key')[0].value;
                            }

                            spinner.removeAttribute("hidden");
                            $.ajax({
                                url: '/save_rule',
                                type: 'post',
                                data: { _token: token, table_name: element_type, id: id, key_type: key_type, key: key},
                                success:function(response){
                                    spinner.setAttribute("hidden", "");
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Uloženo',
                                        text: 'Pravidlo bylo úspěšně uloženo!',
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
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ups..',
                                        text: 'Pravidlo jsme nemohly uložit, asi nastala chyba!',
                                    })

                                }
                            });

                        }
                    }

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
            request.removeAttribute("hidden");
            spinner.setAttribute("hidden", "");
            request.innerHTML = '<b>&#x2715;</b>';

            setTimeout(function (ele){
                request.setAttribute("hidden", "");
            },1000,ele);
        }
    });
}

function checkLock(id, element_type, spinner, request, url, token){

    spinner.removeAttribute("hidden");


    $.ajax({
        url: '/check_lock/' + element_type + "/" + id,
        type: 'get',
        success:function(response){

            spinner.setAttribute("hidden", "");
            if(response[0] == "1"){
                location.href = url;
            }else{

                switch(response[1]) {
                    case 'time':

                        let timerInterval;
                        Swal.fire({
                            title: 'Pro vstup musíš počkat!',
                            html: 'Pustím tě dál až za: <time_left></time_left> vteřin.',
                            timer: (response[2]*1000),
                            icon: 'warning',
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                timerInterval = setInterval(() => {
                                    const content = Swal.getContent()
                                    if (content) {
                                        const b = content.querySelector('time_left')
                                        if (b) {
                                            b.textContent = (Swal.getTimerLeft() /1000).toFixed(0);
                                        }
                                    }
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                unlock(url, spinner);

                            }
                        })

                        break;
                    case 'prev':

                        Swal.fire({
                            icon: 'error',
                            title: 'Upss...',
                            text: 'Nemůžeš dál dokud nedokončíš část s názvem: ' + response[2],

                            showCloseButton: false,
                            showCancelButton: false,
                            showConfirmButton: true,
                            showDenyButton: true,
                            confirmButtonText: `Jdu na to!`,
                            customClass: {
                                container: 'su-shake-horizontal',
                            }
                        })

                        break;
                    case 'key':

                        Swal.fire({
                            title: 'Zadejte klíč',
                            input: 'text',
                            icon: 'warning',
                            inputAttributes: {
                                autocapitalize: 'off'
                            },
                            showCloseButton: false,
                            showCancelButton: false,
                            showConfirmButton: true,
                            showDenyButton: true,
                            confirmButtonText: `Potvrdit`,
                            denyButtonText: `Zrušit`,
                            focusConfirm: true,
                            showLoaderOnConfirm: true,
                            allowOutsideClick: () => !Swal.isLoading()
                        }).then((result) => {
                            if (result.isConfirmed) {
                                spinner.removeAttribute("hidden");
                                let key = `${result.value}`;
                                if(key == response[2]){
                                    $.ajax({
                                        url: '/unlock',
                                        type: 'post',
                                        data: { _token: token, table_name: element_type, id: id},
                                        success:function(response){

                                            if(response == "1") {

                                                unlock(url, spinner);
                                            }
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

                                            setTimeout(function (){
                                                request.setAttribute("hidden", "");
                                            },1000);

                                        }
                                    });

                                }else{
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Upss...',
                                        text: 'Bohužel tento klíč není platný',
                                        customClass: {
                                            container: 'su-shake-horizontal',
                                        }
                                    })
                                }
                            }
                        })



                        break;
                    default:
                        // code block
                }


            }

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

            setTimeout(function (){
                request.setAttribute("hidden", "");
            },1000);

        }
    });

}

function unlock(url,spinner){
    Swal.fire({
        title: 'Gratuluji!',
        text: "Tato část ti byla právě zpřístupněna.",
        icon: 'success',
        showCloseButton: false,
        showCancelButton: false,
        showConfirmButton: true,
        showDenyButton: true,
        confirmButtonText: `Vstupit hned`,
        denyButtonText: `Zatím ne`,
        focusConfirm: true,
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {
            if(spinner != undefined) {
                spinner.removeAttribute("hidden");
            }
            location.href = url;
        }else{
            spinner.setAttribute("hidden", "");
        }
    })
}
