
function edit_loadAttribute(ele, table_name, id, attribute){
    let box = document.getElementById(table_name + '_' + id);
    ele.value = box.getAttribute(attribute);
}

function edit_saveAttribute(ele, table_name, id, attribute){

    let box = document.getElementById(table_name + '_' + id);

    if(ele.value.trim() == ""){
        Swal.fire({
            icon: 'error',
            title: 'Ups..',
            text: 'Pole ' + attribute + "musí být vyplněno!",
        })
        return;
    }

    box.setAttribute(attribute,ele.value)

}

function edit_loadStyle(ele, table_name, id, style){
    let box = document.getElementById(table_name + '_' + id);

    let float;
    let margin;
    let padding;
    let image;

    switch(style) {
        case "background-color":
            let color = box.style.backgroundColor;
            ele.value = color == "" ? "#ffffff" : color;
            break;
        case "background-image":
            let url = box.style.backgroundImage;
            ele.value = url;
            break;

        case "image-top":
            image = box.style.backgroundPosition;
            ele.classList.remove("text-su-orange");
            ele.classList.remove("text-su-lorange");
            ele.classList.add(image == "top" ? "text-su-orange" : "text-su-lorange");
            break;
        case "image-left":
            image = box.style.backgroundPosition;
            ele.classList.remove("text-su-orange");
            ele.classList.remove("text-su-lorange");
            ele.classList.add(image == "left" ? "text-su-orange" : "text-su-lorange");
            break;
        case "image-center":
            image = box.style.backgroundPosition;
            ele.classList.remove("text-su-orange");
            ele.classList.remove("text-su-lorange");
            ele.classList.add((image == "center center" || image == "") ? "text-su-orange" : "text-su-lorange");
            break;
        case "image-right":
            image = box.style.backgroundPosition;
            ele.classList.remove("text-su-orange");
            ele.classList.remove("text-su-lorange");
            ele.classList.add(image == "right" ? "text-su-orange" : "text-su-lorange");
            break;
        case "image-bottom":
            image = box.style.backgroundPosition;
            ele.classList.remove("text-su-orange");
            ele.classList.remove("text-su-lorange");
            ele.classList.add(image == "bottom" ? "text-su-orange" : "text-su-lorange");
            break;


        case "image-contain":
            image = box.style.backgroundSize;
            ele.classList.remove("text-su-orange");
            ele.classList.remove("text-su-lorange");
            ele.classList.add(image == "contain" ? "text-su-orange" : "text-su-lorange");
            break;
        case "image-cover":
            image = box.style.backgroundSize;
            ele.classList.remove("text-su-orange");
            ele.classList.remove("text-su-lorange");
            ele.classList.add((image == "cover" || image == "") ? "text-su-orange" : "text-su-lorange");
            break;


        case "float-left":
            float = box.style.cssFloat ;
            ele.classList.remove("text-su-orange");
            ele.classList.remove("text-su-lorange");
            ele.classList.add(float == "left" ? "text-su-orange" : "text-su-lorange");
            break;
        case "float-none":
            float = box.style.cssFloat ;
            ele.classList.remove("text-su-orange");
            ele.classList.remove("text-su-lorange");
            ele.classList.add(((float == "none" || float == "") ? "text-su-orange" : "text-su-lorange"));
            break;
        case "float-right":
            float = box.style.cssFloat ;
            ele.classList.remove("text-su-orange");
            ele.classList.remove("text-su-lorange");
            ele.classList.add(float == "right" ? "text-su-orange" : "text-su-lorange");
            break;

        case "width":
            let width = box.style.width;
            ele.value = width == "" ? ele.value : width;
            break;
        case "height":
            let height = box.style.height;
            ele.value = height == "" ? ele.value : height;
            break;

        case "margin-top":
            margin = box.style.marginTop;
            ele.value = margin == "" ? ele.value : margin;
            break;
        case "margin-bottom":
            margin = box.style.marginBottom;
            ele.value = margin == "" ? ele.value : margin;
            break;
        case "margin-left":
            margin = box.style.marginLeft;
            ele.value = margin == "" ? ele.value : margin;
            break;
        case "margin-right":
            margin = box.style.marginRight;
            ele.value = margin == "" ? ele.value : margin;
            break;

        case "padding-top":
            padding = box.style.paddingTop;
            ele.value = padding == "" ? ele.value : padding;
            break;
        case "padding-bottom":
            padding = box.style.paddingBottom;
            ele.value = padding == "" ? ele.value : padding;
            break;
        case "padding-left":
            padding = box.style.paddingLeft;
            ele.value = padding == "" ? ele.value : padding;
            break;
        case "padding-right":
            padding = box.style.paddingRight;
            ele.value = padding == "" ? ele.value : padding;
            break;

        case "css":
            let css = box.getAttribute('style');
            ele.value = css.replaceAll("; ", ';\r\n');
            break;

        default:
            Swal.fire({
                icon: 'error',
                title: 'Ups..',
                text: 'Nastala chyba při načítání stylů!',
            })
    }



}

function edit_saveStyle(ele, table_name, id, style){
    let box = document.getElementById(table_name + '_' + id);

    let float;
    let margin;
    let padding;

    switch(style) {
        case "background-color":
            box.style.setProperty("background-color", ele.value, "important")
            break;
        case "background-image":
            //box.style.backgroundImage = "url('" + ele.value + "') !important";
            box.style.setProperty("background-image", "url('" + ele.value + "')", "important")
            break;

            // background-position: center;
            // background-repeat: no-repeat;
            // background-size: contain;

        case "image-top":
            box.style.setProperty("background-position", "top center", "important")
            break;
        case "image-left":
            box.style.setProperty("background-position", "left center", "important")
            break;
        case "image-center":
            box.style.setProperty("background-position", "center center", "important")
            break;
        case "image-right":
            box.style.setProperty("background-position", "right center", "important")
            break;
        case "image-bottom":
            box.style.setProperty("background-position", "bottom center", "important")
            break;

        case "image-contain":
            box.style.setProperty("background-size", "contain", "important")
            break;
        case "image-cover":
            box.style.setProperty("background-size", "cover", "important")
            break;


        case "float-left":
            box.style.cssFloat = "left";
            box.style.width = "40%";
            break;
        case "float-none":
            box.style.cssFloat = "none";
            box.style.width = "100%";
            break;
        case "float-right":
            box.style.cssFloat = "right";
            box.style.width = "40%";
            break;

        case "width":
            box.style.setProperty("width", ele.value.trim().replaceAll(" ", ""), "important")
            break;
        case "height":
            box.style.setProperty("height", ele.value.trim().replaceAll(" ", ""), "important")
            break;

        case "margin-top":
            box.style.setProperty("margin-top", ele.value.trim().replaceAll(" ", ""), "important")
            break;
        case "margin-bottom":
            box.style.setProperty("margin-bottom", ele.value.trim().replaceAll(" ", ""), "important")
            break;
        case "margin-left":
            box.style.setProperty("margin-left", ele.value.trim().replaceAll(" ", ""), "important")
            break;
        case "margin-right":
            box.style.setProperty("margin-right", ele.value.trim().replaceAll(" ", ""), "important")
            break;

        case "padding-top":
            // box.style.paddingTop = ele.value.trim().replaceAll(" ", "") + " !important";
            box.style.setProperty("padding-top", ele.value.trim().replaceAll(" ", ""), "important")
            break;
        case "padding-bottom":
            box.style.setProperty("padding-bottom", ele.value.trim().replaceAll(" ", ""), "important")
            break;
        case "padding-left":
            box.style.setProperty("padding-left", ele.value.trim().replaceAll(" ", ""), "important")
            break;
        case "padding-right":
            box.style.setProperty("padding-right", ele.value.trim().replaceAll(" ", ""), "important")
            break;

        case "css":
            box.setAttribute('style', ele.value.replaceAll('\n', " "));
            break;

        default:
            Swal.fire({
                icon: 'error',
                title: 'Ups..',
                text: 'Nastala chyba při aplikování stylů!',
            })


    }

    $('input[onload]').trigger('onload');

}

function edit_resetStyle(table_name, id){
    let box = document.getElementById(table_name + '_' + id);

    box.setAttribute("style", "");
    $('input[onload]').trigger('onload');
}
