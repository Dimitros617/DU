@section('title','Výpůjční a rezervační systém')
@section('css', URL::asset('css/dashboard.css'))

<x-app-layout>
    <x-slot name="header">
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Hlavní strana') }}--}}
{{--        </h2>--}}
    </x-slot>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="buttonsDiv">


                    @if (Auth::permition()->possibility_renting == 1)

                        <div class="buttonsDivItem">
                            <a href="/categories">
                                <button class="buttonsDivItem btn-primary text-vrs-ylight " type="button">Nová výpůjčka</button>
                            </a>
                        </div>

                        <div class="buttonsDivItem">
                            <a @if(Auth::permition()->new_user == 1) href="/all-loans" @else href="/loans" @endif>
                                <button class="buttonsDivItem btn btn-warning justify-content-center text-center  rounded-0" type="button">
                                    @if (Auth::permition()->new_user == 1)
                                        Čekající na schválení: {{ $schvaleni_pocet }}
                                    @else
                                        Čekající na vrácení: {{ $vraceni_pocet }}
                                    @endif
                                </button>
                            </a>
                        </div>

                        <div class="buttonsDivItem">
                            <a href="/loans">
                                <button class="buttonsDivItem btn btn-success  rounded-0" type="button">
                                    Moje výpůjčky: {{ $vypujcky_pocet }}
                                </button>
                            </a>
                        </div>

                    @endif

                        <div class="buttonsDivItem">
                            <a href="/users">
                                <button class="buttonsDivItem btn btn-danger  rounded-0" type="button">
                                    @if (Auth::permition()->new_user == 1)
                                        Seznam uživatelů: {{$users_pocet}}
                                    @else
                                        Seznam uživatelů
                                    @endif
                                </button>
                            </a>
                        </div>

                </div>

            <br>

            {{--  Sekce pro VŠECHNY  --}}

            <div class="textyDash">
                <h2 class="nadpisyDash ">Jak to funguje?</h2>

                <div class="">
                    @if (Auth::permition()->possibility_renting != 1)
                    Nyní nemáte právo zapůjčovat položky. Můžete pouze:
                    <ul style="list-style-type:circle">
                        <li>Změnit své osobní údaje v záložce "Nastavení".</li>
                        <li>Posílat zprávy uživatelům, jejich seznam naleznete v záložce "Seznam uživatelů". Podle jména i oprávnění můžete vyhledat jistého uživatele (například administrátora) a poslat mu zprávu.</li>
                        <li>Pokud jste si již dříve něco půjčil a výpůjčku jste stále nevrátil, jejich seznam najdete v záložce "Moje výpůjčky".</li>
                        <li>Odhlásit se.</li>
                    </ul>

                    @elseif(Auth::permition()->new_user == 0){{-- verified --}}
                        Vše, co potřebujete, naleznete po kliknutí na nabídku, ke které máte přístup na každé stránce.
                    <ul style="list-style-type:circle">
                        <li>Své osobní údaje změníte v záložce "Nastavení".</li>
                        <li>V záložce "Seznam uživatelů" vidíte všechny uživatele právě zaregistrované k systému.</li>
                        <li>Pokud si chcete něco vypůjčit, v záložce "Nová výpůjčka" uvidíte souhrn všech kategorií, které můžete dále rozkliknout a zvolit požadovaný předmět.</li>
                        <li>Záložka "Moje výpůjčky" vám ukáže souhrn vašich aktivních výpůjček a rezervací.</li>
                        <li>Nezapomeňte se ze systému převážně na cizích počítačích odhlašovat prostředníctvím odkazu "Odhlásit se".</li>
                    </ul>

                    @elseif(Auth::permition()->new_user == 1)
                        Vše, co potřebujete, naleznete po kliknutí na nabídku, ke které máte přístup na každé stránce.
                        <ul style="list-style-type:circle">
                            <li>Své osobní údaje změníte v záložce "Nastavení profilu".</li>
                            <li>V záložce "Seznam uživatelů" vidíte všechny uživatele právě zaregistrované k systému.</li>
                            <li>V záložce "Nová výpůjčka" uvidíte souhrn všech kategorií, které můžete dále rozkliknout a zvolit požadovaný předmět. Zde můžete zapůjčované artikly spravovat i si sám předměty zapůjčit.</li>
                            <li>Záložka "Moje výpůjčky" vám ukáže souhrn vašich aktivních výpůjček a rezervací.</li>
                            <li>Souhrnný přehled nad všemi výpůjčkami naleznete v záložce "Všechny výpůjčky".</li>
                            <li>Nezapomeňte se ze systému převážně na cizích počítačích odhlašovat prostředníctvím odkazu "Odhlásit se".</li>
                        </ul>
                    @endif
                </div>
            </div>

            <br>

            {{--  Sekce pro unverifiedUser  --}}
            @if (Auth::permition()->possibility_renting != 1)
            <div class="textyDash">
                <h2 class="nadpisyDash">Proč si nemohu nic půjčit?</h2>
                <div class="">
                    <ul style="list-style-type:circle">
                        <li>S největší pravděpodobností jste nový uživatel Výpůjčního a rezervačního systému. Musíte počkat, než vás schválí a ověří administrátor.</li>
                        <li><b>Pokud jste již jednou schváleni byli a nyní se vám neobjevuje záložka "Nová výpůjčka", bylo vám právo půjčovat si věci odebráno - ať již z důvodu nevrácení výpůjčky včas či jiných problémů.
                                Pro více informací se zeptejte správce systému, administrátora. Můžete jej vyhledat v "Seznamu uživatelů" a zaslat mu zde krátké připomenutí, doporučujeme však za ním pokud možno zajít osobně a řešit to více oficiálně, abyste zjistili, co nastalo za problém a jak se mu příště vyvarovat.</b></li>
                    </ul>
                </div>
            </div>
            <br>
            @endif


            {{--  Sekce pro ověřené uživatele a admin  --}}
            @if (Auth::permition()->possibility_renting == 1)
                    <button class="alert-link border-bottom-Dash bg-white btn text-vrs-yellow align-content- text-center flex-fill rounded-0 paticka" type="button" expand="0" onclick="if(this.getAttribute('expand')==0){document.getElementById('moreInfo').classList.add('show');this.setAttribute('expand','1')}else{document.getElementById('moreInfo').classList.remove('show');this.setAttribute('expand','0')}">
                        Více informací
                    </button>
                    <br>

                    <div class="collapse" id="moreInfo">
                        <br>

                @if(Auth::permition()->new_user == 1)
                    <div class="textyDash">
                        <h2 class="nadpisyDash">Seznam uživatelů</h2>
                        <div class="">
                            V Seznamu uživatelů vidíte všechny právě zaregistrované uživatele.
                            <br>
                            V hlavičce se nachází vyhledávač. Uživatele můžete filtrovat podle jména, příjmení, přezdívky i oprávnění.
{{--                            načítat seznam oprávnění z databáze --}}
                            <br>
                            <ul style="list-style-type:circle">
                                <li>Každého jednotlivého uživatele snadno kontaktujete v rámci systému přes tlačítko "Poslat zprávu". Pokud se jedná o vážnější problém, využijte e-mail, který je u každého uživatele uveden.</li>
                                <li>Pod tlačítkem "Závazky uživatele" vidíte, jaké předměty má uživatel právě půjčené či zarezervované.
                                    <ul style="list-style-type:disc">
                                        <li>Zde můžete, v případě že má uživatel něco půjčeno, spravovat jeho výpůjčky - zrušit ji či reagovat na jejich žádost o schválení vrácení.</li>
                                    </ul>
                                </li>
                                <li>Máte právo uživatele upravovat - "Upravit uživatele".
                                    <ul style="list-style-type:disc">
                                        <li>Po kliknutí na jeho jméno, příjmení, přezdívku, telefon a e-mail můžete v případě potřeby tyto údaje upravit.</li>
                                        <li>Můžete změnit jeho roli, aktuální role je přednastavena. Vyberte, jakou roli chcete uživateli nastavit.</li>
                                    </ul>
                                    Nezapomeňte všechny změny uložit.
                                    <br>
                                </li>
                                <li>"Aktuální závazky" jsou trochu blíže popsány v nápovědě k "Moje výpůjčky".</li>
                            </ul>
                            Pokud potřebujete akutně vyřešit problém s uživatelem, využijte jeho telefonní číslo. Pro řešení vážnějšího problému využívejte jeho e-mail, zprávy v systému slouží spíše pro upozornění.
                            <br>
                            Příchozí zprávy vidíte po kliku na obálku. Číslo u ní říká počet nepřečtených zpráv. I zde můžete po překliku na "Nová zpráva" poslat zprávu uživateli, stačí zadat jeho přezdívku. Je zde k dispozici i našeptávač.
                            <br>
                        </div>
                    </div>

                    <br>

                        <div class="textyDash">
                            <h2 class="nadpisyDash">Moje výpůjčky</h2>
                            <div class="">
                                Vše, co jste si zarezervoval či vypůjčil, najdete zde.
                                <ul style="list-style-type:circle">
                                    <li>Souhrnně vidíte položky ze stejných kategorií u sebe.</li>
                                    <li>Po přejetí na tlačítko "Probíhá" se ukáže možnost "Zrušít rezervaci", po kliku na tlačítko tedy zrušíte svou výpůjčku.</li>
                                    <li>Všimněte si v boxu, který uvádí detaily výpůjčky, ikonky.
                                        <ul style="list-style-type:disc">
                                            <li>
                                                Ikonka odškrtnutí znázorňuje, že "Výpůjčka zatím není aktivní".
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check iconSvg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                                </svg>
                                            </li>
                                            <li>
                                                Ikonka ciferníku znázorňuje, že "Výpůjčka je právě aktivni".
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock iconSvg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                                                    <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                                </svg>
                                            </li>
                                            <li>
                                                Ikonka s vykřičníkem znázorňuje, že "Již je po termínu!".
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-diamond-fill iconSvg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                                </svg>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                Podobně, jako vypadá tato stránka, vypadají souhrny výpůjček ("Aktuální závazky") u jednotlivých uživatelů i jednotlivých kategorií a položek. U nich však vidíte i možnost "Čekání na schválení",
                                která se po přejetí a kliknutí změní na "Potvrdit odevzdání". Tím přijmete buďto zrušení rezervace nebo vrácení předmětu. Přijímejte vrácení předmětu až ve chvíli, kdy jste si jisti,
                                že je předmět bezpečně vrácen na místo, odkud si jej uživatel půjčil. V případě problému jej co nejdříve kontaktujte.
                                <br>
                            </div>
                        </div>

                        <br>

                    <div class="textyDash">
                        <h2 class="nadpisyDash">Nová výpůjčka a úprava kategorií a předmětů</h2>
                        <div class="">
                            Zde si můžete půjčit předmět z vybrané kategorie, zároveň zde spravujete viditelnost předmětů, kategorií a přidáváte či odstraňujete je.
                            <ul style="list-style-type:circle">
                                <li>Pokud se zde nic nenachází, přidejte novou kategorii.</li>
                                <li>Kategorii můžete smazat. Pokud bude mít někdo zapůjčenou či rezervovanou položku z dané kategorie, vyskočí vám upozornění.</li>
                                <li>Po kliknutí na "Aktuální závazky" vidíte, kdo má položky z dané kategorie zapůjčené či rezervované. Můžete zde tyto výpůjčky spravovat -
                                    zrušit je či reagovat na jejich žádost o schválení vrácení.</li>
                                <li>Počet viditelných položek v dané kategorii poté vidíte v podobě levé modré bublinky s číslem na souhrnu všech kategorií. Pravá oranžová bublinka udává číslo skrytých položek.</li>
                                <li>Kliknutím na box kategorie se vám rozevře celá kategorie, zde můžete upravit její název a pod názvem se nachází textové pole, kam můžete napsat popisek kategorie.
                                    Pozor, v souhrnu všech kategorií se ukazují pouze dva řádky popisku </li>
                                <li>Podobně jako se přidává kategorie, můžete vkládat nové položky k zapůjčení.
                                    <ul style="list-style-type:disc">
                                        Všechny informace (název, poznámka, místo, inventární číslo) snadno upravíte.
                                        <li>Po zadání data počátku výpůjčky do pole "Od:" a konce do pole "Do:" si položku klikem na "Vypůjčit" zapůjčíte na daný časový interval.</li>
                                        <li>Položku můžete i smazat. Pokud ji bude mít někdo zapůjčenou či rezervovanou, vyskočí vám upozornění.</li>
                                        <li>Po kliknutí na "Aktuální závazky" vidíte, kdo má tento předmět zapůjčený či rezervovaný. Můžete zde tyto výpůjčky spravovat -
                                            zrušit je či reagovat na jejich žádost o schválení vrácení.</li>
                                        <li>Nastavte zviditelnění či skrytí položky pro běžné uživatele tlačítkem "Viditelné: ANO" či "Viditelné: NE". Oceníte ve chvíli, kdy bude nějaká položka dočasně nedostupná k zapůjčení - nebudete ji muset mazat. Kliknutím nastavíte opak toho, co bylo původně nastaveno a na tlačítku napsáno.</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <br>

                        <div class="textyDash">
                            <h2 class="nadpisyDash">Všechny výpůjčky</h2>
                            <div class="">
                                Souhrnný přehled všech výpůjček, které čekají na vaše schválení, všech právě v systému zadaných výpůjček i rezervací a historie všech ukončených výpůjček či ukončených zadaných rezervací.
                                <br>
                                U každého tlačítka vidíte počet záznamů výpůjček, které čekají na vaše schválení, které jsou aktuálně vypůjčené či rezervované nebo které jsou uloženy v historii. Po kliku na ně se vám rozbalí všechny tyto záznamy utřízené podle kategorií a položek v nich.
                                <ul style="list-style-type:circle">
                                    <li>Po kliku na "Čekajících na schválení" se rozbalí výčet výpůjček či rezervací, které chce uživatel vrátit. Zkontrolujte si osobně, zda je opravdu vrátil, jinak je neschvalujte.</li>
                                    <li>Po kliku na "Všechny aktivní" se rozbalí výčet výpůjček či rezervací, které uživatelé zadali. Můžete je kdykoli zrušit, pokud ke zrušení máte důvod - klikem na tlačítko "Probíhá", které se změní na tlačítko "Zrušit rezervaci".</li>
                                    <li>Po kliku na "Historie výpůjček" se rozbalí výčet archivovaných a tedy již zrušených výpůjček či rezervací. V pravé části vidíte, kdy byl záznam smazán.</li>

                                </ul>
                                Rovněž se zde u záznamů výpůjček využívá význam ikonek, který je vysvětlen již v sekci "Moje výpůjčky".
                                <br>
                            </div>
                        </div>
                    <br>

                @else
                        <div class="textyDash">
                            <h2 class="nadpisyDash">Seznam uživatelů</h2>
                            <div class="">
                                V Seznamu uživatelů vidíte všechny právě zaregistrované uživatele.
                                <br>
                                V hlavičce se nachází vyhledávač. Uživatele můžete filtrovat podle jména, příjmení, přezdívky i oprávnění.
                                {{--                            načítat seznam oprávnění z databáze --}}
                                <br>
                                <ul style="list-style-type:circle">
                                    <li>Každého jednotlivého uživatele snadno kontaktujete v rámci systému přes tlačítko "Poslat zprávu". Jedná se však o jednodušší zprávu, tento systém nemá za cíl být komunikační platformou.</li>
                                    <li>Pod tlačítkem "Závazky uživatele" vidíte, jaké předměty má uživatel právě půjčené či zarezervované.
                                        <ul style="list-style-type:disc">
                                            <li>Zde můžete, v případě že má uživatel něco půjčeno, spravovat jeho výpůjčky - zrušit ji či reagovat na jejich žádost o schválení vrácení.</li>
                                        </ul>
                                    </li>
                                    <li>"Aktuální závazky" jsou trochu blíže popsány v nápovědě k "Moje výpůjčky".</li>
                                </ul>
                                Nezapomeňte, zprávy v systému slouží spíše k jednorázovému upozornění. Příchozí zprávy vidíte po kliku na obálku. Číslo u ní říká počet nepřečtených zpráv.
                                I zde můžete po překliku na "Nová zpráva" poslat zprávu uživateli, stačí zadat jeho přezdívku. Je zde k dispozici i našeptávač.
                                <br>
                            </div>
                        </div>

                        <br>

                        <div class="textyDash">
                            <h2 class="nadpisyDash">Moje výpůjčky</h2>
                            <div class="">
                                Vše, co jste si zarezervoval či vypůjčil, najdete zde.
                                <ul style="list-style-type:circle">
                                    <li>Souhrnně vidíte položky ze stejných kategorií u sebe.</li>
                                    <li>Po přejetí na tlačítko "Probíhá" se ukáže možnost "Zrušít rezervaci", po kliku na tlačítko tedy zrušíte svou výpůjčku.</li>
                                    <li>Všimněte si v boxu, který uvádí detaily výpůjčky, ikonky.
                                        <ul style="list-style-type:disc">
                                            <li>
                                                Ikonka odškrtnutí znázorňuje, že "Výpůjčka zatím není aktivní".
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check iconSvg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"/>
                                                </svg>
                                            </li>
                                            <li>
                                                Ikonka ciferníku znázorňuje, že "Výpůjčka je právě aktivni".
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock iconSvg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                                                    <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                                                </svg>
                                            </li>
                                            <li>
                                                Ikonka s vykřičníkem znázorňuje, že "Již je po termínu!".
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-diamond-fill iconSvg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                                </svg>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                Podobně, jako vypadá tato stránka, vypadají souhrny výpůjček ("Aktuální závazky") u jednotlivých uživatelů i jednotlivých kategorií a položek.
                                <br>
                            </div>
                        </div>

                        <br>

                        <div class="textyDash">
                            <h2 class="nadpisyDash">Nová výpůjčka</h2>
                            <div class="">
                                Zde si můžete půjčit předmět z vybrané kategorie.
                                <ul style="list-style-type:circle">
                                    <li>Po kliknutí na "Aktuální závazky" vidíte, kdo má položky z dané kategorie zapůjčené či rezervované. </li>
                                    <li>Počet položek v dané kategorii poté vidíte v podobě bublinky s číslem na souhrnu všech kategorií.</li>
                                    <li>Kliknutím na box kategorie se vám rozevře celá kategorie
                                        V souhrnu všech kategorií se ukazují pouze dva řádky popisku kategorie, po rozkliknutí kategorie vidíte již popisek celý.
                                        <br>
                                        Nyní již vidíte všechny položky v kategorii.
                                        <ul style="list-style-type:disc">
                                            <li>Po zadání data počátku výpůjčky do pole "Od:" a konce do pole "Do:" si položku klikem na "Vypůjčit" zapůjčíte na daný časový interval.</li>
                                            <li>Po kliknutí na "Aktuální závazky" vidíte, kdo má tento předmět zapůjčený či rezervovaný.</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <br>

                @endif
            @endif
        </div>
        </div>
    </div>
    </div>
</x-app-layout>
