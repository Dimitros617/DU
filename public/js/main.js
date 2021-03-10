

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
