

function changeSwitch(ele){

    let checkbox = ele.parentNode.children[0];
    let label = ele.parentNode.parentNode.children[1];

    checkbox.value = 1 + checkbox.value % 2;

    checkbox.click();
    checkbox.click();

    if(checkbox.value == "1"){
        checkbox.setAttribute("checked", "");
    }else{
        checkbox.removeAttribute("checked");
    }

    label.innerHTML = checkbox.value == "1" ? "ZAPNUTO" : "VYPNUTO";
}

function changeRadio(ele){

    let other_radio = document.getElementsByClassName(ele.getAttribute('for'));

    for (let radio of other_radio){

        radio.value = "0";
        radio.removeAttribute('checked');
        radio.parentNode.parentNode.children[1].innerHTML = "VYPNUTO"
    }

    let checkbox = ele.parentNode.children[0];
    let label = ele.parentNode.parentNode.children[1];

    checkbox.value = "1";

    checkbox.click();
    checkbox.click();

    checkbox.setAttribute("checked", "");


    label.innerHTML = "ZAPNUTO";
}
