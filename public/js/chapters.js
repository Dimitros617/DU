
function saveChapterBox(ele, id){



    ele.parentNode.getElementsByClassName('loading')[0].removeAttribute("hidden");
    ele.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");
let a = new FormData(ele.parentNode);

    $.ajax({
        url: '/save_image',
        method: 'POST',
        data: new FormData(ele.parentNode),
        processData: false,
        contentType: false,
        datatype : "application/json",
        success:function(response){

            ele.parentNode.getElementsByClassName('loading')[0].setAttribute("hidden", "");
            ele.parentNode.getElementsByClassName('loading_request')[0].removeAttribute("hidden");

            if(response[0] == "1"){
               let refresh = '?random=\\' + new Date().getTime();
                ele.parentNode.getElementsByClassName('chapter_img')[0].setAttribute("style","background-image: url('/user_files/"+ response[1] + refresh +"');");
                ele.parentNode.getElementsByClassName('loading_request')[0].innerHTML = '<b>&#10003;</b>';
            }else{
                ele.parentNode.getElementsByClassName('loading_request')[0].innerHTML = '<b>&#x2715;</b>';
            }

            setTimeout(function (ele,img){
                ele.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");
               //

            },1000,ele);


        },
        error: function (response){

            ele.parentNode.getElementsByClassName('loading_request')[0].removeAttribute("hidden");
            ele.parentNode.getElementsByClassName('loading')[0].setAttribute("hidden", "");
            ele.parentNode.getElementsByClassName('loading_request')[0].innerHTML = '<b>&#x2715;</b>';

            setTimeout(function (ele){
                ele.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");
            },1000,ele);
        }
    });
}

function removeChapterBox(ele, id){



    ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].removeAttribute("hidden");
    ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");

    let token = ele.parentNode.parentNode.parentNode.parentNode.querySelectorAll("input[name='_token']")[0].value;

    Swal.fire({
        title: 'Opravdu chcete smazat tuto kapitolu?',
        icon: 'question',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `Smazat`,
        denyButtonText: `Zrušit`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

            $.ajax({
                url: '/remove_chapter/' + id,
                type: 'delete',
                data: { _token: token},
                success:function(response){

                    ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].setAttribute("hidden", "");
                    ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].removeAttribute("hidden");

                    if(response[0] == "1"){

                        ele.parentNode.parentNode.parentNode.parentNode.setAttribute("hidden", "");

                    }else{
                        ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].innerHTML = '<b>&#x2715;</b>';
                    }

                    setTimeout(function (ele,img){
                        ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");
                    },1000,ele);


                },
                error: function (response){

                    ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].removeAttribute("hidden");
                    ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].setAttribute("hidden", "");
                    ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].innerHTML = '<b>&#x2715;</b>';

                    setTimeout(function (ele){
                        ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");
                    },1000,ele);
                }
            });
        }
        else{
            ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].setAttribute("hidden", "");
        }
    })


}


function getStatusChapter(ele, id){



    ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].removeAttribute("hidden");
    ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");

    $.ajax({
        url: '/status_chapter/' + id,
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

            ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].removeAttribute("hidden");
            ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].setAttribute("hidden", "");
            ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].innerHTML = '<b>&#x2715;</b>';

            setTimeout(function (ele){
                ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");
            },1000,ele);
        }
    });
}



function getRuleChapter(ele, id){



    ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].removeAttribute("hidden");
    ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");

    $.ajax({
        url: '/rule_chapter/' + id,
        method: 'get',
        success:function(response){

            ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].setAttribute("hidden", "");

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
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    //TODO uložit změny klíčů
                }
                else{
                    //TODO zahodit změny
                }
            })


        },
        error: function (response){

            ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].removeAttribute("hidden");
            ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].setAttribute("hidden", "");
            ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].innerHTML = '<b>&#x2715;</b>';

            setTimeout(function (ele){
                ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");
            },1000,ele);
        }
    });
}

