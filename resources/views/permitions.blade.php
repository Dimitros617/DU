@section('title',"Uživatelská oprávnění")
@section('css', URL::asset('css/permition.css'))


<x-app-layout>

    <x-slot name="header"></x-slot>
    <script src="/js/main.js"></script>
    <script src="/js/permition.js"></script>
    <script src="/js/permition-save.js"></script>

    <div class="bg-white overflow-hidden shadow-xl pb-5 sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container p-6">


        </div>

            <div class="pageTitle">Role</div>

            <div class="list-group my-list-group" id="myList permitionList" role="tablist">

                @foreach($permitions as $permition)

                <a class="list-group-item list-group-item-action list-name my-list-group-item bg-su-lblue  rounded-1 su-animation-05 su-animation-move-right" id="list-{{$permition->id}}" permitionId="{{$permition->id}}" data-toggle="list" role="tab" onclick="showPanel({{$permition->id}})">{{$permition->name}} <div class="float-end roleCount " >{{$permition->count}}</div></a>

                @endforeach
                    <form action="/addPermition" method="POST" id="addPermitionForm">
                        @csrf
                        <a type="submit" metod="POST" class="list-group-item list-group-item-action list-name my-list-group-item my-list-group-item-add " data-toggle="list" role="tab" onclick="this.getElementsByClassName('plus')[0].setAttribute('hidden','');this.getElementsByClassName('buttonLoading')[0].removeAttribute('hidden');  document.getElementById('addPermitionForm').submit()">Přidat novou roli <span class="plus">+</span> <div id="buttonLoading" class="spinner-grow buttonLoading spinner-grow-sm text-su-blue" role="status" hidden></div></a>
                    </form>

            </div>

            <div class="tab-content">

                @foreach($permitions as $permition)

                <div class="tab-pane bg-su-blue-gradient" id="panel-{{$permition->id}}" role="tabpanel">

                    <form action="/savePermitionData" method="POST" id="savePermitionData-{{$permition->id}}" class="tab-pane-head bg-su-texture shadow bg-su-lwhite">
                        @csrf

                        <div class="d-inline-flex w-100 mb-4">
                            <input type="text" class="us-h2 text-su-blue w-100 bg-transparent permition-name text-su-shadow-white" name="name" value="{{$permition->name}}">
                            <input type="text" name="id" value="{{$permition->id}}" hidden>

                            <div class="my_row">

                                <div class="switch-box d-grid">
                                    <label title="Přiřadzení všem nově registrovaným" for="default" class="text-su-blue">Výchozí role</label>
                                    <label class="switch  ms-auto me-auto">
                                        <input type="checkbox" id="default{{$permition->id}}" class="radio-rule-slider" @if($permition->default == 1)value="1" checked @else value="0" @endif >

                                        <span class="slider round" for="radio-rule-slider" onclick="changeSwitch(this, this.parentNode.children[0], this.parentNode.parentNode.children[2],'ANO','NE',this.parentNode.parentNode.children[3])"></span>

                                    </label>
                                    <div hidden class="switch-label mt-2 font-weight-bolder text-white font-weight-bold text-su-shadow">@if($permition->default == 1)ANO @else NE @endif</div>
                                    <input class="d-none" type="text" name="default"  @if($permition->default == 1)value="1" @else value="0" @endif >
                                </div>

                            </div>
                        </div>
                <div class="my-row-row">



                    <div class="my_row">


                        <div class="switch-box d-grid">
                            <label for="possibility_read">Čtení kapitol</label>
                            <label class="switch  ms-auto me-auto">
                                <input type="checkbox" id="possibility_read{{$permition->id}}" class="radio-rule-slider" @if($permition->possibility_read == 1)value="1" checked @else value="0" @endif >

                                <span class="slider round" for="radio-rule-slider" onclick="changeSwitch(this, this.parentNode.children[0], this.parentNode.parentNode.children[2],'ANO','NE',this.parentNode.parentNode.children[3])"></span>

                            </label>
                            <div class="switch-label mt-2 font-weight-bolder text-white font-weight-bold text-su-shadow">@if($permition->possibility_read == 1)ANO @else NE @endif</div>
                            <input class="d-none" type="text" name="read"  @if($permition->possibility_read == 1)value="1" @else value="0" @endif >
                        </div>

                    </div>

                    <div class="my_row">

                        <div class="switch-box d-grid">
                            <label for="new_user">Správa třídnice</label>
                            <label class="switch  ms-auto me-auto">
                                <input type="checkbox" id="new_user{{$permition->id}}" name="user" class="radio-rule-slider" @if($permition->new_user == 1)value="1" checked @else value="0" @endif >
                                <span class="slider round" for="radio-rule-slider" onclick="changeSwitch(this, this.parentNode.children[0], this.parentNode.parentNode.children[2],'ANO','NE',this.parentNode.parentNode.children[3])"></span>

                            </label>
                            <div class="switch-label mt-2 font-weight-bolder text-white font-weight-bold text-su-shadow">@if($permition->new_user == 1)ANO @else NE @endif</div>
                            <input class="d-none" type="text" name="user"  @if($permition->new_user == 1)value="1" @else value="0" @endif >

                        </div>

                    </div>

                    <div class="my_row">

                        <div class="switch-box d-grid">
                            <label for="edit_content">Úprava obsahu</label>
                            <label class="switch  ms-auto me-auto">
                                <input type="checkbox" id="edit_content{{$permition->id}}" name="edit" class="radio-rule-slider" @if($permition->edit_content == 1)value="1" checked @else value="0" @endif >
                                <span class="slider round" for="radio-rule-slider" onclick="changeSwitch(this, this.parentNode.children[0], this.parentNode.parentNode.children[2],'ANO','NE',this.parentNode.parentNode.children[3])"></span>

                            </label>
                            <div class="switch-label mt-2 font-weight-bolder text-white font-weight-bold text-su-shadow">@if($permition->edit_content == 1)ANO @else NE @endif</div>
                            <input class="d-none" type="text" name="edit"  @if($permition->edit_content == 1)value="1" @else value="0" @endif >

                        </div>

                    </div>


                    <div class="my_row">


                        <div class="switch-box d-grid">
                            <label for="edit_permitions">Správa rolí</label>
                            <label class="switch  ms-auto me-auto">
                                <input type="checkbox" id="edit_permitions{{$permition->id}}" name="permition" class="radio-rule-slider" @if($permition->edit_permitions == 1)value="1" checked @else value="0" @endif >
                                <span class="slider round" for="radio-rule-slider" onclick="changeSwitch(this, this.parentNode.children[0], this.parentNode.parentNode.children[2],'ANO','NE',this.parentNode.parentNode.children[3])"></span>

                            </label>
                            <div class="switch-label mt-2 font-weight-bolder text-white font-weight-bold text-su-shadow">@if($permition->edit_permitions == 1)ANO @else NE @endif</div>
                            <input class="d-none" type="text" name="permition"  @if($permition->edit_permitions == 1)value="1" @else value="0" @endif >

                        </div>

                    </div>
                </div>

                    </form>

                    <div class="button-row">

                        <div class="button-bar">
                            <div class="su">
                                <button type="submit button" class=" submit  w-200p float-end p-2 w-10rem text-white su-button su-button-danger " onclick="savePermitionData(this, '{{$permition->id}}' )">
                                    <div id="buttonText">Uložit změny</div>
                                    <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>
                                </button>
                            </div>

                            <div class="su">
                                @csrf
                                <button type="submit button" class=" submit  w-200p float-end p-2  w-10rem text-white su-button su-button-sucess" onclick="setTimeout(function (ele,id){removePermition( ele,id)},50,this,'{{$permition->id}}'); return false">
                                    <div id="buttonText">Smazat roli</div>
                                    <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                @endforeach

            </div>



        </div>
    </div>


</x-app-layout>


