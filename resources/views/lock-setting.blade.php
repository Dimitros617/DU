
<div class="pageTitle">Omezení přístupu</div>

<div class="su-h3 text-su-orange w-100 text-center" >
    Nastavte prvku {{$chapter->name}} podmínku, kterou musí žák splnit, aby se mu tento prvek zpřístupnil.
</div>

<div class="chapter-lock-setting">


    <form>
        {{--        Pravidlo pro čas--}}
    <div class="rule-box bg-su-blue-gradient shadow" id="time">

        <div class="rule-title  h1 font-weight-bolder float-start text-su-orange ">Časové omezení</div>

        <div class="switch-box float-end d-grid">
            <label class="switch  ms-auto me-auto">
                <input type="radio" name="rule" value="0" >
                <span class="slider round" onclick="changeSwitch(this)"></span>

            </label>
            <div class="mt-2 font-weight-bolder text-white font-weight-bold">DEFAULT</div>
        </div>

        <div class="rule mt-5 w-100 d-inline-flex justify-center">
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow">Žák musí počkat </div>
            <input type="number" class="rule-text su-input-white text-center w- font-weight-bold h2 text-white text-su-shadow shadow" min="0" value="0">
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow"> vteřin. </div>
        </div>

    </div>


        {{--        Pravidlo pro předchozí--}}
    <div class="rule-box bg-su-blue-gradient shadow" id="prev">

        <div class="rule-title  h1 font-weight-bolder float-start text-su-orange ">Dokončit po předchozím</div>

        <div class="switch-box float-end d-grid">
            <label class="switch  ms-auto me-auto">
                <input type="radio" name="rule" value="0" >
                <span class="slider round" onclick="changeSwitch(this)"></span>

            </label>
            <div class="mt-2 font-weight-bolder text-white font-weight-bold">DEFAULT</div>
        </div>

        <div class="rule mt-5 w-100 d-inline-flex justify-center">
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow">Dokud nedokončí: </div>
            <select type="number" class="rule-text su-input-white text-center w- font-weight-bold h2 text-white text-su-shadow shadow" >
                <option value="nová">Nová kapitola</option>
            </select>
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow"></div>
        </div>

    </div>

{{--        Pravidlo pro heslo--}}
    <div class="rule-box bg-su-blue-gradient shadow" id="key">

        <div class="rule-title  h1 font-weight-bolder float-start text-su-orange ">Vlastní klíč</div>

        <div class="switch-box float-end d-grid">
            <label class="switch  ms-auto me-auto">
                <input type="radio" name="rule" value="0" >
                <span class="slider round" onclick="changeSwitch(this)"></span>

            </label>
            <div class="mt-2 font-weight-bolder text-white font-weight-bold">DEFAULT</div>
        </div>

        <div class="rule mt-5 w-100 d-inline-flex justify-center">
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow">Žák musí zadat klíč: </div>
            <input type="password" class="rule-text su-input-white text-center w- font-weight-bold h2 text-white text-su-shadow shadow" onmouseenter="this.setAttribute('type', 'text')" onmouseleave="this.setAttribute('type', 'password')">
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow"></div>
        </div>

    </div>

    </form>
</div>
