

function addChapter(form, spinner, symbol){

    spinner.removeAttribute("hidden");
    symbol.setAttribute("hidden", "");

    $.ajax({
        url: '/add_chapter',
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


// function removeChapterBox(ele, id){
//
//
//
//     ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].removeAttribute("hidden");
//     ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");
//
//     let token = ele.parentNode.parentNode.parentNode.parentNode.querySelectorAll("input[name='_token']")[0].value;
//
//     Swal.fire({
//         title: 'Opravdu chcete smazat tuto kapitolu?',
//         icon: 'question',
//         showDenyButton: true,
//         showCancelButton: false,
//         confirmButtonText: `Smazat`,
//         denyButtonText: `Zrušit`,
//     }).then((result) => {
//         /* Read more about isConfirmed, isDenied below */
//         if (result.isConfirmed) {
//
//             $.ajax({
//                 url: '/remove_chapter/' + id,
//                 type: 'delete',
//                 data: { _token: token},
//                 success:function(response){
//
//                     ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].setAttribute("hidden", "");
//                     ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].removeAttribute("hidden");
//
//                     if(response[0] == "1"){
//
//                         ele.parentNode.parentNode.parentNode.parentNode.setAttribute("hidden", "");
//
//                     }else{
//                         ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].innerHTML = '<b>&#x2715;</b>';
//                     }
//
//                     setTimeout(function (ele,img){
//                         ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");
//                     },1000,ele);
//
//
//                 },
//                 error: function (response){
//                     console.log(response);
//                     ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].removeAttribute("hidden");
//                     ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].setAttribute("hidden", "");
//                     ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].innerHTML = '<b>&#x2715;</b>';
//
//                     setTimeout(function (ele){
//                         ele.parentNode.parentNode.parentNode.getElementsByClassName('loading_request')[0].setAttribute("hidden", "");
//                     },1000,ele);
//                 }
//             });
//         }
//         else{
//             ele.parentNode.parentNode.parentNode.getElementsByClassName('loading')[0].setAttribute("hidden", "");
//         }
//     })
//
//
// }







