

function savePermitionData(ele, id){


    ele.querySelectorAll("div[id='buttonText']")[0].setAttribute("hidden","");
    ele.querySelectorAll("div[id='buttonLoading']")[0].removeAttribute("hidden");

let a = $('#savePermitionData-' + id).serialize();

    $.ajax({
        url: '/savePermitionData',
        method: 'post',
        data:$('#savePermitionData-' + id).serialize(),
        success:function(response){

            ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
            ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

            ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#10003;</b>';
            let roleCount = document.getElementById("list-"+id).getElementsByClassName("roleCount")[0].cloneNode(true);
            document.getElementById("list-"+id).innerHTML = document.getElementById("panel-" + id).getElementsByClassName("permition-name")[0].value;
            document.getElementById("list-"+id).appendChild(roleCount);

            setTimeout(function (ele){
                //ele.getElementsByClassName('submit')[0].setAttribute("hidden","");
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Uložit změny";
            },1000,ele);


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
            ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
            ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

            ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';

            setTimeout(function (ele){
                ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Uložit změny";
            },1000,ele);
        }
    });

}

function removePermition(ele, id){

    let token = ele.parentNode.children[0].value;

    Swal.fire({
        title: 'Opravdu?',
        text: "Vážně chcete tuto roli smazat?",
        icon: 'question',
        showCloseButton: false,
        showCancelButton: false,
        showConfirmButton: true,
        showDenyButton: true,
        confirmButtonText: `Smazat`,
        denyButtonText: `Zrušit`,
        focusConfirm: true,
        showLoaderOnConfirm: true,
    }).then((result) => {
        if (result.isConfirmed) {

            ele.querySelectorAll("div[id='buttonText']")[0].setAttribute("hidden","");
            ele.querySelectorAll("div[id='buttonLoading']")[0].removeAttribute("hidden");


            $.ajax({
                url: '/removePermition/' + id,
                type: 'delete',
                data: { _token: token},
                success:function(response){

                    ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
                    ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

                    if(response == "1"){
                        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#10003;</b>';
                        setTimeout(function (ele){
                            document.getElementById("list-"+id).setAttribute("hidden", "");
                            document.getElementsByClassName("active")[0].setAttribute("hidden", "");
                        },1000,ele);

                    }else if(response == "2"){
                        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';
                        Swal.fire({
                            icon: 'error',
                            title: 'Upss...',
                            text: 'Tahle role je někomu přiřazena, proto ji nemůžu smazat.',
                            customClass: {
                                container: 'su-shake-horizontal',
                            }
                        })
                        setTimeout(function (ele){
                            ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Smazat oprávnění";

                        },1000,ele);
                    }else{
                        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';
                        setTimeout(function (ele){
                            ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Smazat oprávnění";

                        },1000,ele);
                    }

                },
                error: function (response){
                    console.log(response);
                    ele.querySelectorAll("div[id='buttonText']")[0].removeAttribute("hidden");
                    ele.querySelectorAll("div[id='buttonLoading']")[0].setAttribute("hidden", "");

                    ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = '<b>&#x2715;</b>';

                    setTimeout(function (ele){
                        ele.querySelectorAll("div[id='buttonText']")[0].innerHTML = "Uložit změny";
                    },1000,ele);
                }
            });
        }
    })



}
