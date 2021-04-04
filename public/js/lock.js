
function setDatePicker() {
    $('#su-datepicker').daterangepicker({
        "showDropdowns": true,
        "showWeekNumbers": true,
        "timePicker": true,
        "timePicker24Hour": true,
        "timePickerSeconds": true,
        "autoApply": true,
        "locale": {
            "format": "YYYY-MM-DD HH:mm",
            "separator": " - ",
            "applyLabel": "Uložit",
            "cancelLabel": "Zrušit",
            "fromLabel": "Od",
            "toLabel": "Do",
            "customRangeLabel": "Custom",
            "weekLabel": "T",
            "daysOfWeek": [
                "Ne",
                "Po",
                "Út",
                "St",
                "Čt",
                "Pá",
                "So"
            ],
            "monthNames": [
                "Leden",
                "Únor",
                "Březen",
                "Duben",
                "Květen",
                "Červen",
                "Červenec",
                "Srpen",
                "Září",
                "Říjen",
                "Listopad",
                "Prosinec"
            ],
            "firstDay": 1
        },
        "startDate": moment().startOf('hour'),
        "endDate": moment().startOf('hour').add(32, 'hour'),
        "opens": "center",
        "drops": "up"
    }, function (start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
}

function setLock(ele, id, element_type, spinner, request, token ){

    spinner.removeAttribute("hidden");
    request.setAttribute("hidden", "");

    if(token == undefined){
        token =  document.querySelectorAll("input[name='_token']")[0].value;
    }

    $.ajax({
        url: '/rule_setting/'+ element_type + "/" + id,
        method: 'get',
        success:function(response){

            spinner.setAttribute("hidden", "");


            Swal.fire({
                html: response,
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

                    let all_limits = document.getElementsByClassName('limit-box');
                    for (let limit of all_limits) {

                        let check = limit.getElementsByClassName('radio-rule-slider')[0].value;
                        let data = limit.getElementsByClassName('rule-key')[0].value;
                        let column = limit.getAttribute('id');
                        if(check == '1'){
                            if(column == "date_limit"){

                                let start = $('#su-datepicker').data('daterangepicker').startDate.format("YYYY-MM-DD HH:mm:ss");
                                let end = $('#su-datepicker').data('daterangepicker').endDate.format("YYYY-MM-DD HH:mm:ss");;
                                saveColumn(ele, spinner, request, start, 'start_at');
                                saveColumn(ele, spinner, request, end, 'end_at');

                            }else {
                                saveColumn(ele, spinner, request, data, column);
                            }
                        }else{
                            if(column == "date_limit"){
                                saveColumn(ele, spinner, request, null, 'start_at');
                                saveColumn(ele, spinner, request, null, 'end_at');
                            }else {
                                saveColumn(ele, spinner, request, null, column);
                            }
                        }


                    }


                    let all_rules = document.getElementsByClassName('rule-box');
                    if(window.lock_change == 0){
                        all_rules = new Array();
                        Swal.fire({
                            icon: 'success',
                            title: 'Uloženo',
                            text: 'Pravidlo bylo úspěšně nastaveno!',
                        })
                    }

                    for (let rule of all_rules) {
                        let radio = rule.getElementsByClassName('radio-rule-slider')[0];
                        if(radio.value == "1"){

                            let key_type = rule.getAttribute('id');
                            let key = "null"

                            if(key_type != "empty" && key_type != "invisible"){
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
                                        text: 'Pravidlo bylo úspěšně nastaveno!',
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
            $('input[onload]').trigger('onload');
            window.lock_change = 0;

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

/**
 *
 * @param id = (int) ID Elementu, které chceme ověřit
 * @param element_type = (String) Jméno tabulky kde máme id ověřovat
 * @param spinner = (Element) = Loading element, který se zobrazuje s skrývá
 * @param request = (Element) = Výsledek po loadingu element, který zobrazuje ano nebo ne (stav http requestu)
 * @param url = (String) url adresa kam chceme odkázat pro případ, že odemknutí proběhne v pořádku, hodnota UNDEFINED pouze reloadne stránku
 * @param token = (String) CSRF token pro odeslání POSTEM
 */
function checkLock(id, element_type, spinner, request, url, token){

    spinner.removeAttribute("hidden");

    if(token == undefined){
        token =  document.querySelectorAll("input[name='_token']")[0].value;
    }
    $.ajax({
        url: '/get_limits/' + element_type + "/" + id,
        type: 'get',
        success: function (limits_response) {

            var limits = limits_response;
            var html_limits = limits['entry_limit'] != null ?'<b>Omezení vstupů na: </b>' + limits['entry_limit_max'] + 'x <br><b>Tebou navštíveno: </b>' + limits['entry_limit_actual'] + 'x <br> <hr>':'';
                html_limits +=  limits['time_limit'] != null ?'<b>Omezeno časem: </b>' + (limits['time_limit'] == null ? 'NE' : limits['time_limit'] + ' min') + ' <br> <hr>': '';
                html_limits +=  limits['date_limit'] != null ?'<b>Povoleno od: </b>' + limits['date_limit_start'] + ' <br> <b>Povoleno do: </b>' + (limits['date_limit_end'] == limits['date_limit_start']? 'neomezeno': limits['date_limit_end']) + ' <br> <hr>' : '';
            $.ajax({
                url: '/check_lock/' + element_type + "/" + id,
                type: 'get',
                success: function (response) {

                    spinner.setAttribute("hidden", "");
                    if (response[0] == "1") {

                        if(html_limits.trim() != ""){
                            Swal.fire({
                                title: 'Pozor!',
                                html: html_limits,
                                icon: 'warning',
                                showCloseButton: false,
                                showCancelButton: false,
                                showConfirmButton: true,
                                showDenyButton: true,
                                confirmButtonText: `Chci vstoupit`,
                                denyButtonText: `Teď ne`,
                                focusConfirm: true,
                                showLoaderOnConfirm: true,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    if(spinner != undefined) {
                                        spinner.removeAttribute("hidden");
                                    }
                                    if (url == undefined) {
                                        location.reload();
                                    } else {
                                        location.href = url;
                                    }
                                }
                            })
                        }else{
                            if(spinner != undefined) {
                                spinner.removeAttribute("hidden");
                            }
                            if (url == undefined) {
                                location.reload();
                            } else {
                                location.href = url;
                            }
                        }



                    } else {

                        switch (response[1]) {
                            case 'time':

                                let timerInterval;
                                Swal.fire({
                                    title: 'Pro vstup musíš počkat!',
                                    html: 'Pustím tě dál až za: <time_left></time_left> vteřin.',
                                    timer: (response[2] * 1000),
                                    icon: 'warning',
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                        timerInterval = setInterval(() => {
                                            const content = Swal.getContent()
                                            if (content) {
                                                const b = content.querySelector('time_left')
                                                if (b) {
                                                    b.textContent = (Swal.getTimerLeft() / 1000).toFixed(0);
                                                }
                                            }
                                        }, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        unlock(url, spinner, html_limits);

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
                                        if (key == response[2]) {
                                            $.ajax({
                                                url: '/unlock',
                                                type: 'post',
                                                data: {_token: token, table_name: element_type, id: id},
                                                success: function (response) {

                                                    if (response == "1") {

                                                        unlock(url, spinner, html_limits);
                                                    }
                                                },
                                                error: function (response) {
                                                    console.log(response);
                                                    let err = IsJsonString(response.responseText) ? JSON.parse(response.responseText).messages : response.responseText
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Hmm... CHYBA!',
                                                        text: err,
                                                        customClass: {
                                                            container: 'su-shake-horizontal',
                                                        }
                                                    })
                                                    request.removeAttribute("hidden");
                                                    spinner.setAttribute("hidden", "");
                                                    request.innerHTML = '<b>&#x2715;</b>';

                                                    setTimeout(function () {
                                                        request.setAttribute("hidden", "");
                                                    }, 1000);

                                                }
                                            });

                                        } else {
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
                            case 'limit':
                                Swal.fire({
                                    title: 'Ojoj!',
                                    html: html_limits,
                                    icon: 'error',
                                    showCloseButton: false,
                                    showCancelButton: false,
                                    showConfirmButton: true,
                                    showDenyButton: true,
                                    confirmButtonText: `Ok chápu`,
                                    denyButtonText: `No`,
                                    focusConfirm: true,
                                    showLoaderOnConfirm: true,
                                }).then((result) => {
                                    if (result.isConfirmed) {

                                    }
                                })
                                break;
                            default:
                            // code block
                        }


                    }

                },
                error: function (response) {
                    console.log(response);
                    let err = IsJsonString(response.responseText) ? JSON.parse(response.responseText).messages : response.responseText
                    Swal.fire({
                        icon: 'error',
                        title: 'Hmm... CHYBA!',
                        text: err,
                        customClass: {
                            container: 'su-shake-horizontal',
                        }
                    })
                    request.removeAttribute("hidden");
                    spinner.setAttribute("hidden", "");
                    request.innerHTML = '<b>&#x2715;</b>';

                    setTimeout(function () {
                        request.setAttribute("hidden", "");
                    }, 1000);

                }
            });
        },
        error: function (response) {
            console.log(response);
            let err = IsJsonString(response.responseText) ? JSON.parse(response.responseText).messages : response.responseText
            Swal.fire({
                icon: 'error',
                title: 'Hmm... CHYBA!',
                text: err,
                customClass: {
                    container: 'su-shake-horizontal',
                }
            })
            request.removeAttribute("hidden");
            spinner.setAttribute("hidden", "");
            request.innerHTML = '<b>&#x2715;</b>';

            setTimeout(function () {
                request.setAttribute("hidden", "");
            }, 1000);

        }
    });

}

function unlock(url,spinner,html_limits){
    Swal.fire({
        title: 'Gratuluji!',
        html: html_limits + "Tato část ti byla právě zpřístupněna.",
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
            if(url == undefined){
                location.reload();
            }else{
                location.href = url;
            }
        }else{
            location.reload();
        }
    })
}

function changeTimerMod(ele){

    let bar_container = document.getElementById('timer-bar-container');
    let text = document.getElementById('timer-bar-time') ;
    ele.setAttribute('mod',(ele.getAttribute('mod').trim()+1)%3);

    switch (ele.getAttribute('mod').trim()){
        case "0":
            bar_container.removeAttribute('hidden');
            text.classList.remove('text-su-lorange');
            text.classList.add('text-white');
            break;
        case "1":
            bar_container.setAttribute('hidden',"");
            break;
        case "2":
            text.classList.remove('text-white');
            text.classList.add('text-su-lorange');
            break;
    }




}

function setTimer(time){

    let bar = document.getElementById('timer-bar');
    let text = document.getElementById('timer-bar-time') ;
    time *= 60;

    if(window.time_limit == undefined) {

        window.second = time;
        window.time_limit = setInterval(function (bar, text, time) {

            let percent = (100 * window.second) / time;
            bar.style.setProperty("width", percent + "%", "important")
            let sec = window.second % 60;
            let min = (window.second - sec) / 60;
            text.innerHTML = (min != 0 ? min + ':' : '') + (sec < 10 ? '0' : '') + sec;
            window.second--;
            if (window.second < 0) {
                clearInterval(window.time_limit);
                text.innerHTML = 'Ukončuji...'
                closeAllTests()
            }
        }, 1000, bar, text, time);
    }

}

function closeAllTests(){
    let buttons = document.getElementsByClassName('finish-test-button')
    for(let butt of buttons){
        butt.click();
    }

    setTimeout(function (){
        location.href = window.location.pathname +'/all_results';
    },3000)
}
