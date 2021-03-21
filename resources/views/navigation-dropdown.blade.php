



<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-lg p-3 mb-5">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="notifDiv">
            <div class="flex justify-between flex-sm-row h-40 flex-column">

                <div class="flex">


                    <!-- Logo -->
                    <div class="w-100 mb-55px flex-shrink-0 flex items-center">
                        <a class="ml-20 headLogoMobile mt-4-5 mt-sm-5 "  href="{{ route('dashboard') }}">
                            <div class="float-start">
                            <x-jet-application-logo class="block h-9 w-auto "/>
                            </div>
                            <div class="shaddow-animation-box">
                                <div class="shaddow-animation-white">
                                </div>
                            </div>
                        </a>
                    </div>

                </div>



                @if(View::hasSection('title_name'))
                    <div class="title_name_box d-flex flex-column justify-center">
                        <div class="text-su-lblue fw-bold ">UČEBNICE</div>
                        <div class="text-su-blue h1 fw-bold ms-3">@yield('title_name')</div>
                    </div>
                @endif

                <div class="float-user-name p-2 text-white bg-su-orange fw-bold h4 fixed right-0 top-0 py-2 px-5 text-right " style="border-radius: 0 0 0 5px">
                    <span class="h6 text-su-lorange">  {{Auth::user()->name}}  {{Auth::user()->surname}}</span><br>
                    {{Auth::user()->nick}}
                </div>

            </div>
    </div>

    <!-- Responsive Navigation Menu -->

</nav>
