

function initTextEditor(id){

    if(document.getElementById(id).parentNode.getElementsByClassName('ql-toolbar').length > 0){
        return;
    }

    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['code-block'],

        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'align': [] }],
        [{ 'size': ['small', 'medium', 'large', 'huge'] }],  // custom dropdown

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],

        ['clean']                                         // remove formatting button
    ];



    var quill = new Quill('#'+id, {
        debug: false,
        modules: {
            toolbar: {
                containerDiv: '#'+ id + '-setting',
                container: toolbarOptions},
            history: {
                delay: 2000,
                maxStack: 500,
                userOnly: true
            }
        },
        theme: 'snow',
        readOnly: false,
        placeholder: 'Zde zadávejte text...',
    });

    let element = document.getElementById(id).parentNode.parentNode;
    document.getElementById(id).firstChild.onblur = () =>

        saveColumn(
            element,
            element.getElementsByClassName('edit-bar')[0].getElementsByClassName('loading')[0],
            element.getElementsByClassName('edit-bar')[0].getElementsByClassName('loading_request')[0],
            element.getElementsByClassName('editor-content')[0].firstChild.innerHTML,
            'data');

}
