

function getChat(table_name, element_id, svg = null){

    if(svg != null) {
        svg.classList.add('rotating-chat');
    }

    $.ajax({
        url: '/chat/' + table_name + "/" + element_id,
        method: 'GET',
        success:function(response){

            Swal.fire({
                html: response,
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton: false,
                showDenyButton: false,
                focusConfirm: false,
                customClass: 'modal-page',
            }).then((result) => {

                if(svg != null) {
                    svg.classList.remove('rotating-chat');
                }

            })

        },
        error: function (response){
            console.log(response);
            let err = IsJsonString(response.responseText)? JSON.parse(response.responseText).messages : response.responseText
            allertError(err);

        }
    });

}

function removeComment(id,spinner,ele){

    let token =  document.querySelectorAll("input[name='_token']")[0].value;

    spinner.removeAttribute("hidden");
    ele.setAttribute("hidden","");

    $.ajax({
        url: '/remove_comment/'+id,
        method: 'DELETE',
        data: { _token: token, id: id},
        success:function(response){

            ele.remove();

        },
        error: function (response){
            console.log(response);
            let err = IsJsonString(response.responseText)? JSON.parse(response.responseText).messages : response.responseText
            allertError(err);

        }
    });

}

function addComment(spinner, table_name, element_id, text){

    let token =  document.querySelectorAll("input[name='_token']")[0].value;

    spinner.removeAttribute("hidden");

    $.ajax({
        url: '/add_comment',
        type: 'post',
        data: { _token: token, table_name: table_name, element_id: element_id, text: text.innerText.trim()},
        success:function(response){

            text.innerHTML = "";
            refreshGallery(document.getElementById('chat-box'),('/get_chat_comments/' + table_name + "/" + element_id))
            spinner.setAttribute("hidden", "");
        },
        error: function (response){
            console.log(response);
            let err = IsJsonString(response.responseText)? JSON.parse(response.responseText).messages : response.responseText
            allertError(err);

            spinner.setAttribute("hidden", "");


        }
    });
}


