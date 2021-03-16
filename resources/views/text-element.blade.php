

<div style="{{$element->style}}"
     name="{{$element->name}}"
     description="{{$element->description}}"
     old_style="{{$element->style}}"
     old_name="{{$element->name}}"
     old_description="{{$element->description}}"
     class=" bg-norepeat bg-su-lblack  mx-auto sm:px-6 lg:px-8 p-5 pt-4 mb-3 su-animation-02"
     id="elements_{{$element->id}}"
     type="elements"
     element_type="text"
     include="null"
     element_id="{{$element->id}}"
     locked="@if($element->security != null && $element->security != 'empty') 1 @else 0 @endif"
>
    @if($edit)
        @include('edit-bar')
    @endif


        <div class="this-element text-editor-setting mt-2" style="z-index: 999; position: relative;" >
            <div id="editor" class="d-content mt-2" style="font-size: 150%">
                <p>Cau <strong>VIOLKO</strong> ...</p>

            </div>
        </div>


        <script>
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

            var quill = new Quill('#editor', {
                debug: 'info',
                modules: {
                    toolbar: {
                        containerDiv: '#editor-setting',
                        container: toolbarOptions},
                    history: {
                        delay: 2000,
                        maxStack: 500,
                        userOnly: true
                    }
                },
                theme: 'snow',
                readOnly: false,
                placeholder: 'Sem zadejte text...',
            });


        </script>

</div>
