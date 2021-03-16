@section('title','DU - Vítej!')
@section('css', URL::asset('css/dashboard.css'))

<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8" onload="checkUserAlone()">
    <div class="container p-6 text-center text-su-blue">

        <h1 class="display-1 mb-4">Vítej!</h1>
        <div class="h6"> Provedli jsme pár věcí, vše nastavili a vypadá to, že jste aktuálně jediný uživatel v systému. Proto jsme na Vás převedli veškerá práva a stanovili Vás novým vládcem systému. Kliknutím na tlačítko „POKRAČOVAT“ můžete začít se správou celého systému začít vytvářet učebnice, jednotlivé kapitoly a přizpůsobit si je.
            <br><br><b>Hodně štěstí.</b>
        </div>
        <a href="/dashboard"> <button type="button" class="btn btn-warning bg-su-orange w-100 mt-4 h-4rem text-white fs-7"><b>JDU NA TO!</b></button></a>
        </div>
    </div>
</x-app-layout>
