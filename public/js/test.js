
function getDataFromABC(element){
    let atext = element.getElementsByClassName('a-text')[0].innerHTML;
    let btext = element.getElementsByClassName('b-text')[0].innerHTML;
    let ctext = element.getElementsByClassName('c-text')[0].innerHTML;

    if(atext.trim() == ""){
        allertError('Nebyla zadána odpověď A');
        return;
    }
    if(btext.trim() == ""){
        allertError('Nebyla zadána odpověď B');
        return;
    }
    if(ctext.trim() == ""){
        allertError('Nebyla zadána odpověď C');
        return;
    }

    let aresult = element.getElementsByClassName('a-radio')[0].value;
    let bresult = element.getElementsByClassName('b-radio')[0].value;
    let cresult = element.getElementsByClassName('c-radio')[0].value;

    if(aresult.trim() == 0 && bresult.trim() == 0 && cresult.trim() == 0){
        allertWarning('Nebyla označena správná odpověď! Ovšem data ukládám...');
    }

    let data = {
        "a_text":atext, "a_result":aresult,
        "b_text":btext, "b_result":bresult,
        "c_text":ctext, "c_result":cresult
    };

    return data;
}

function saveABCtest(element, spinner, request){

    let correct = element.getElementsByClassName('correct')[0].value;
    let bad = element.getElementsByClassName('bad')[0].value;

    if(correct.trim() == ""){
        allertError('Nebylo zadáno kolik bodů se přičte při správně odpovědi!');
        return;
    }
    if(correct.trim() == 0){
        allertWarning('Za právnou odpověď se nepřičte žádný bod! Ovšem data ukládám...');
    }

    if(bad.trim() == ""){
        allertWarning('Nebylo zadáno kolik bodů se přičte či odečte při špatné odpovědi! Nastavuji na 0 a ukládám...');
        bad = 0;
    }

    saveColumn(element,spinner,request,getDataFromABC(element),'data_json');
    saveColumn(element,spinner,request,correct,'data');
    saveColumn(element,spinner,request,bad,'data1');
}

function finishTest(id, spinner, request){


    let container = document.getElementById(id.replaceAll(':','_'));

    let elements = container.getElementsByClassName('test');

    for(let element of elements){

        switch(element.getAttribute('test_type')) {
            case 'abc':
                addResult(element, spinner, request, getDataFromABC(element), 'data_json')
                break;
            default:
                allertError('Neznámý typ testu! ' + element.getAttribute('test_type'));
        }
    }

}

function addResult(element, spinner, request, data, column){

        route = '/add_result'

        let token =  document.querySelectorAll("input[name='_token']")[0].value;
        spinner.removeAttribute("hidden");
        $.ajax({
            url: route,
            type: 'post',
            data: {
                _token: token,
                data: data,
                element_id: element.getAttribute('element_id'),
                column: column,
            },
            success:function(response){
                spinner.setAttribute("hidden", "");
                request.removeAttribute("hidden");
                request.innerHTML = '<b>&#10003;</b>';

                setTimeout(function (request){
                    request.setAttribute("hidden", "");
                },1000,request);
                allertWarning('Celkem odevzdáno: ' + response + 'x')
            },
            error: function (response){
                console.log(response);
                let err = IsJsonString(response.responseText)? JSON.parse(response.responseText).messages : response.responseText
                allertError(err);
                spinner.setAttribute("hidden", "");

            }
        });

    }

    function  removeOtherElements(container){

        let elements = document.querySelectorAll("div[type='elements']");
        // let container = document.getElementById(id);
        for (let element of elements){
            if(!isDescendant(container, element)){
                element.remove();
            }
        }

    }

    function isDescendant(parent, child) {
        var node = child.parentNode;
        while (node != null || node != undefined) {
            if (node == parent) {
                return true;
            }
            node = node.parentNode;
        }
        return false;
    }
