@section('title',"Seznam uživatelů")
@section('css', URL::asset('css/user.css'))
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seznam uživatelů') }}
        </h2>
    </x-slot>
    <script src="/js/user-gets.js"></script>


    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="container p-6 ">

            @if(sizeof($users) != 0)
                <div class="list-group pt-4 pb-4">

                    <div class="hlavicka">
                        <div class="pageTitleSearch">Seznam uživatelů</div>
                        <div class="search">
                            <div class="bg-gray-100 rounded-3 modal-open">
                                <div class="card-body row no-gutters align-items-center h-4rem">

                                    <div class="col">
                                        <input class="form-control-borderless mt--1" id="search" type="search" placeholder="Zadejte hledaný výraz">

                                    </div>

                                    <div class="col-auto">
                                        <div class="spinner-border text-su-orange searchSpinner mt--1" id="spinner" role="status" hidden></div>
                                    </div>


                                    <div class="col-auto searchButtonDiv">

                                        <button class="btn btn-lg btn-success searchButton" type="submit" onclick="userFind(this)">Najít</button>
                                        <button class="btn btn-lg btn-primary searchButton" data-sort="none" sort="desc" onclick="userSort(this)">&#8681;</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="userList">
                    @foreach($users as $user)
                        <a href="{{url()->current().'/'.$user -> userId}}" style="text-decoration: none">

                        <div class="items-blocky userElement
                        @if($user->possibility_read == 0 && $user->new_user == 0 && $user->edit_content == 0 && $user->edit_permitions == 0)
                            bg-su-blue-gradient
                        @elseif($user->possibility_read == 1 && $user->new_user == 1 && $user->edit_content == 1 && $user->edit_permitions == 1)
                            bg-su-orange-gradient
                        @else
                            bg-su-blue-orange-gradient
                        @endif
" userID="{{$user->userId}}">
                            <div class="nameDiv">

                                <div class="nick">
                                    {{$user -> userNick}}
                                </div>

                                <div class="name">
                                    {{$user -> userSurname}}
                                    {{$user -> userName}}
                                </div>

                            </div>

                            <div class="permition">
                                {{$user -> permitionName}}
                            </div>


                            <div class="buttonsDiv">

                            @if(Auth::permition()->new_user == 1)
                                    <div class="p-0 buttonsDivItem">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-fill text-danger " viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </div>

                                    <div class="spinner-grow text-warning loading" role="status" hidden></div>
                                    <div class="loading_request" role="status" hidden></div>

                                    <div class="p-0 buttonsDivItem">
                                        <svg onclick=" setTimeout(function (spinner){getStatus(spinner,'/get_user_status/{{$user->userId}}')},50,this.parentNode.parentNode.getElementsByClassName('loading')[0]); return false" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-lightbulb-fill text-danger" viewBox="0 0 16 16">
                                            <path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    </div>
                            @endif
                            </div>
                        </div>

                        </a>
                    @endforeach
                    </div>
                </div>
            @else
                <div class="display-4 pt-4 pb-4">Upss.. Nic jsme tu nenašly.</div>
            @endif

        </div>
    </div>
</x-app-layout>
