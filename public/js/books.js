

function addBook(form, spinner, symbol){

    spinner.removeAttribute("hidden");
    symbol.setAttribute("hidden", "");

    $.ajax({
        url: '/add_book',
        method: 'POST',
        data: form.serialize(),
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
            symbol.removeAttribute("hidden");
        }
    });

}


function getStatusBook(ele, id){



    ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].removeAttribute("hidden");
    ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");

    $.ajax({
        url: '/status_book/' + id,
        method: 'get',
        success:function(response){

            ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].setAttribute("hidden", "");

            Swal.fire({
                html:
                    response,
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton: false,
                focusConfirm: false,
                customClass: 'modal-page',
            })


        },
        error: function (response){
            console.log(response);
            ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].removeAttribute("hidden");
            ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].setAttribute("hidden", "");
            ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].innerHTML = '<b>&#x2715;</b>';

            setTimeout(function (ele){
                ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");
            },1000,ele);
        }
    });
}





