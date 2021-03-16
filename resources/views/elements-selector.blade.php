


<div class="d-flex flex-wrap justify-center mt-4 mb-4 p-0">

    @foreach($elements as $element)

        <div class="m-2 p-3 bg-su-lblue rounded-3 shadow su-animation-02 su-hover-shadow su-hover-scale cursor-pointer" style="min-width: 25%"
            onclick="addElement(document.getElementById('{{$data->table_name}}_{{$data->id}}'),null,null,{{$element->id}})"
        >

            <div class="chapter_img bg-su-image-center w-100 mb-3" style="background-image: url('/user_files/{{$element->svg}}'); height: 30px"></div>
            <div class="w-100  text-su-blue text-su-shadow-white fw-bolder">{{$element->name}}</div>

        </div>

    @endforeach

</div>

