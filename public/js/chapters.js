
function saveChapterImage(ele, id){



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


