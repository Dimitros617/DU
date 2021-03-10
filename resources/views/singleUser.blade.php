@section('title',$user[0] -> userSurname.' '. $user[0] -> userName)
@section('css', URL::asset('css/user-setting.css'))
<x-app-layout>

    <x-slot name="header"></x-slot>

    <script src="/js/main.js"></script>
    <script src="/js/user-save.js"></script>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h1 class="text-lg font-medium text-su-orange h3">Informace o uživateli {{$user[0] -> userName.' '. $user[0] -> userSurname}}</h1>

                <p class="mt-1 text-md text-white">
                    Pozor, aby jste neupravily něco jiného!
                </p>
            </div>
        </div>


        <div class="mt-5 md:mt-0 md:col-span-2">
            <form id="userDataForm" onsubmit="saveUserData(this,'{{$user[0]->userId}}'); return false;" >
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Profile Photo -->

                            @csrf

                            <input name="userId" value="{{$user[0]-> userId}}" hidden>

                            <!-- Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="name">
                                    Jméno
                                </label>

                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="name" type="text" name="userName" value="{{$user[0] -> userName}}" required  autocomplete="name">


                            </div>

                            <!-- Příjmení -->
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="surname">
                                    Příjmení
                                </label>

                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="surname" type="text" name="userSurname" value="{{$user[0] -> userSurname}}" required autocomplete="surname">


                            </div>

                            <!-- Přezdívka -->
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="nick">
                                    Přezdívka
                                </label>

                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="nick" type="text" name="userNick" value="{{$user[0] -> userNick}}" required autocomplete="nickname">


                            </div>

                            <!-- Email -->
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="email">
                                    E-mail
                                </label>

                                <input class="form-input rounded-md shadow-sm mt-1 block w-full" id="email" type="email" name="userEmail" value="{{$user[0] -> userEmail}}" required autocomplete="mail">


                            </div>
                            <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700"  for="selectPermition">Role uživatele: </label>
                            <select class="form-select rounded-md shadow-sm mt-1 block w-full" name="selectPermition" oninput="document.getElementById('userDataForm').getElementsByClassName('submit')[0].removeAttribute('hidden')">
                            @foreach($permitions as $permition)

                                    <option class="" value="{{ $permition -> permitionId }}" @if($permition -> permitionId == $user[0] -> permitionId) selected @endif>{{ $permition -> permitionName }}</option>

                            @endforeach
                            </select>
                            </div>


                        </div>
                    </div>

                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button type="submit button" class="btn btn-danger w-200p float-end p-2 w-10rem text-white px-4 py-2" >
                                            <div id="buttonText">Uložit změny</div>
                                            <div id="buttonLoading" class="spinner-grow text-light" role="status" hidden></div>
                                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

</x-app-layout>
