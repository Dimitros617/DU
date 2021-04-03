
<div class="pageTitle">Omezení přístupu</div>

<div class="su-h3 text-su-orange w-100 text-center mb-4" >
    Nastavte prvku {{$data->name}} podmínku, kterou musí žák splnit, aby se mu tento prvek zpřístupnil.
</div>

<div class="chapter-lock-setting">

    <form id="limit_setting" class="mb-5">

        {{--        Pravidlo pro počet vstupů--}}
        <div class="limit-box bg-su-blue-orange-gradient shadow su-hover-shadow su-animation-05 flex-column p-1 p-md-4" id="entry_limit">

            <div class="rule-title bg-su-texture shadow  float-start text-su-hologram-blue-inverted">Omezení počtem vstupů</div>

            <div class="switch-box mx-auto mx-md-0 float-end d-grid su-mt-md-4 su-w-100" style="margin-top: -5rem;">
                <label class="switch  ms-auto me-auto">
                    <input type="checkbox" name="entry_limit" class="radio-rule-slider" @if($data->entry_limit != null)value="1" checked @else value="0" @endif >
                    <span class="slider round" for="radio-rule-slider" onclick="changeSwitch(this,this.parentNode.children[0],this.parentNode.parentNode.getElementsByClassName('su-label')[0],'ZAPNUTO','VYPNUTO',)"></span>

                </label>
                <div class="su-label mt-2 font-weight-bolder text-white font-weight-bold">@if($data->entry_limit != null)ZAPNUTO @else VYPNUTO @endif</div>
            </div>

            <div class="rule mt-5 w-100 d-inline-block d-md-inline-flex justify-center">
                <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow">Počet vstupů: </div>
                <input type="number" class="rule-key rule-text su-input-white text-center w- font-weight-bold h2 text-white text-su-shadow shadow" min="1" @if($data->entry_limit != null)value="{{$data->entry_limit}}" @else value="1" @endif>
            </div>

        </div>
        <div class="w-100 text-center text-su-lblue fw-bold su-h3 p-1 p-md-4">&</div>

        {{--        Pravidlo pro čas limit--}}
        <div class="limit-box bg-su-blue-orange-gradient shadow su-hover-shadow su-animation-05 flex-column p-1 p-md-4" id="time_limit">

            <div class="rule-title bg-su-texture shadow  float-start text-su-hologram-blue-inverted">Časové omezení</div>

            <div class="switch-box mx-auto mx-md-0 float-end d-grid su-mt-md-4 su-w-100" style="margin-top: -5rem;">
                <label class="switch  ms-auto me-auto">
                    <input type="checkbox" name="time_limit" class="radio-rule-slider" @if($data->time_limit != null)value="1" checked @else value="0" @endif >
                    <span class="slider round" for="radio-rule-slider" onclick="changeSwitch(this,this.parentNode.children[0],this.parentNode.parentNode.getElementsByClassName('su-label')[0],'ZAPNUTO','VYPNUTO',)"></span>

                </label>
                <div class="mt-2 font-weight-bolder text-white font-weight-bold">@if($data->time_limit != null)ZAPNUTO @else VYPNUTO @endif</div>
            </div>

            <div class="rule mt-5 w-100 d-inline-block d-md-inline-flex justify-center">
                <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow">Zobrazit pouze na </div>
                <input type="number" class="rule-key rule-text su-input-white text-center w- font-weight-bold h2 text-white text-su-shadow shadow" min="30" @if($data->time_limit != null)value="{{$data->time_limit}}" @else value="1" @endif>
                <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow"> vteřin. </div>
            </div>

        </div>
        <div class="w-100 text-center text-su-lblue fw-bold su-h3 p-1 p-md-4">&</div>
        {{--        Pravidlo pro datum limit--}}
        <div class="limit-box bg-su-blue-orange-gradient shadow su-hover-shadow su-animation-05 flex-column p-1 p-md-4" id="date_limit">

            <div class="rule-title bg-su-texture shadow  float-start text-su-hologram-blue-inverted">Datumové omezení</div>

            <div class="switch-box mx-auto mx-md-0 float-end d-grid su-mt-md-4 su-w-100" style="margin-top: -5rem;">
                <label class="switch  ms-auto me-auto">
                    <input type="checkbox" name="date_limit" class="radio-rule-slider" @if($data->start_at != null)value="1" checked @else value="0" @endif >
                    <span class="slider round" for="radio-rule-slider" onclick="changeSwitch(this,this.parentNode.children[0],this.parentNode.parentNode.getElementsByClassName('su-label')[0],'ZAPNUTO','VYPNUTO',)"></span>

                </label>
                <div class="mt-2 font-weight-bolder text-white font-weight-bold">@if($data->start_at != null)ZAPNUTO @else VYPNUTO @endif</div>
            </div>

            <div class="rule mt-5 w-100 d-inline-block d-md-inline-flex justify-center">
                <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow">Přístupné v termínu:</div>
                <input type="text" id="su-datepicker" onload="setDatePicker()" class="rule-key rule-text su-input-white text-center font-weight-bold h2 text-white text-su-shadow shadow" start="{{$data->start_at}}" end="{{$data->end_at}}">

            </div>

        </div>
        <div class="w-100 text-center text-su-lblue fw-bold su-h3 p-1 p-md-4">&</div>

{{--        Zámky--}}
    </form>

    <form id="locks_setting">
        <div class="su-h2  text-su-orange w-100 text-center mt-5 pt-4" >
            Nastavení zámku
        </div>
        {{--        Bez omezení--}}
        <div class="rule-box bg-su-blue-orange-gradient shadow su-hover-shadow su-animation-05 flex-column p-1 p-md-4" id="empty">

            <div class="rule-title bg-su-texture shadow float-start text-su-hologram-blue-inverted ">Bez zámku</div>

            <div class="switch-box mx-auto mx-md-0 float-end d-grid su-mt-md-4 su-w-100" style="margin-top: -5rem;">
                <label class="switch  ms-auto me-auto">
                    <input type="radio" name="rule" class="radio-rule-slider" @if($data->security == "empty" || is_null($data->security))value="1" checked @else value="0" @endif>
                    <span class="slider round" for="radio-rule-slider" onclick="changeRadio(this); window.lock_change++"></span>

                </label>
                <div class="mt-2 font-weight-bolder text-white font-weight-bold">@if($data->security == "empty" || is_null($data->security))ZAPNUTO @else VYPNUTO @endif</div>
            </div>
        </div>
        <div class="w-100 text-center text-su-lblue fw-bold su-h3 p-1 p-md-4">NEBO</div>
        {{--        Skrytý--}}
        <div class="rule-box bg-su-blue-orange-gradient shadow su-hover-shadow su-animation-05 flex-column p-1 p-md-4" id="invisible">

            <div class="rule-title bg-su-texture shadow float-start text-su-hologram-blue-inverted ">Uplně skrýt</div>

            <div class="switch-box mx-auto mx-md-0 float-end d-grid su-mt-md-4 su-w-100" style="margin-top: -5rem;">
                <label class="switch  ms-auto me-auto">
                    <input type="radio" name="rule" class="radio-rule-slider" @if($data->security == "invisible" )value="1" checked @else value="0" @endif>
                    <span class="slider round" for="radio-rule-slider" onclick="changeRadio(this); window.lock_change++"></span>

                </label>
                <div class="mt-2 font-weight-bolder text-white font-weight-bold">@if($data->security == "invisible" )ZAPNUTO @else VYPNUTO @endif</div>
            </div>
        </div>

        <div class="w-100 text-center text-su-lblue fw-bold su-h3 p-1 p-md-4">NEBO</div>
        {{--        Pravidlo pro čas--}}
    <div class="rule-box bg-su-blue-orange-gradient shadow su-hover-shadow su-animation-05 flex-column p-1 p-md-4" id="time">

        <div class="rule-title bg-su-texture shadow  float-start text-su-hologram-blue-inverted">Časový zámek</div>

        <div class="switch-box mx-auto mx-md-0 float-end d-grid su-mt-md-4 su-w-100" style="margin-top: -5rem;">
            <label class="switch  ms-auto me-auto">
                <input type="radio" name="rule" class="radio-rule-slider" @if($data->security == "time")value="1" checked @else value="0" @endif >
                <span class="slider round" for="radio-rule-slider" onclick="changeRadio(this); window.lock_change++"></span>

            </label>
            <div class="mt-2 font-weight-bolder text-white font-weight-bold">@if($data->security == "time")ZAPNUTO @else VYPNUTO @endif</div>
        </div>

        <div class="rule mt-5 w-100 d-inline-block d-md-inline-flex justify-center">
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow">Žák musí počkat </div>
            <input type="number" class="rule-key rule-text su-input-white text-center w- font-weight-bold h2 text-white text-su-shadow shadow" min="1" @if($data->security == "time")value="{{$data->key}}" @else value="1" @endif>
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow"> vteřin. </div>
        </div>

    </div>

        <div class="w-100 text-center text-su-lblue fw-bold su-h3 p-1 p-md-4">NEBO</div>
        {{--        Pravidlo pro předchozí--}}
    <div class="rule-box bg-su-blue-orange-gradient shadow su-hover-shadow su-animation-05 flex-column p-1 p-md-4" id="prev">

        <div class="rule-title  bg-su-texture shadow float-start text-su-hologram-blue-inverted">Odemknout po předchozím</div>

        <div class="switch-box mx-auto mx-md-0 float-end d-grid su-mt-md-4 su-w-100" style="margin-top: -5rem;">
            <label class="switch  ms-auto me-auto">
                <input type="radio" name="rule" class="radio-rule-slider" @if($data->security == "prev")value="1" checked @else value="0" @endif >
                <span class="slider round" for="radio-rule-slider" onclick="changeRadio(this); window.lock_change++"></span>

            </label>
            <div class="mt-2 font-weight-bolder text-white font-weight-bold">@if($data->security == "prev")ZAPNUTO @else VYPNUTO @endif</div>
        </div>

        <div class="rule mt-5 w-100 d-inline-block d-md-inline-flex justify-center">
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow">Dokud nedokončí: </div>
            <select type="number" class=" rule-key rule-text su-input-white text-center w- font-weight-bold h2 text-white text-su-shadow shadow" >
{{--                Value musí být ve formátu tabulka:id prvku--}}
                @foreach($options as $option)
                    <option value="{{$table[0]}}:{{$option->id}}" @if(($table[0].":".$option->id) == $data->key) selected @endif>{{$table[1]}}: {{$option->name}}</option>
                @endforeach
            </select>
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow"></div>
        </div>

    </div>
        <div class="w-100 text-center text-su-lblue fw-bold su-h3 p-1 p-md-4">NEBO</div>
{{--        Pravidlo pro heslo--}}
    <div class="rule-box bg-su-blue-orange-gradient shadow su-hover-shadow su-animation-05 flex-column p-1 p-md-4" id="key">

        <div class="rule-title bg-su-texture shadow  float-start text-su-hologram-blue-inverted">Vlastní klíč</div>

        <div class="switch-box mx-auto mx-md-0 float-end d-grid su-mt-md-4 su-w-100" style="margin-top: -5rem;">
            <label class="switch  ms-auto me-auto">
                <input type="radio" name="rule" class="radio-rule-slider" @if($data->security == "key")value="1" checked @else value="0" @endif >
                <span class="slider round" for="radio-rule-slider" onclick="changeRadio(this); window.lock_change++"></span>

            </label>
            <div class="mt-2 font-weight-bolder text-white font-weight-bold">@if($data->security == "key")ZAPNUTO @else VYPNUTO @endif</div>
        </div>

        <div class="rule mt-5 w-100 d-inline-block d-md-inline-flex justify-center">
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow">Žák musí zadat klíč: </div>
            <input type="password" class=" rule-key rule-text su-input-white text-center w- font-weight-bold h2 text-white text-su-shadow shadow" @if($data->security == "key")value="{{$data->key}}" @else value="" @endif onmouseenter="this.setAttribute('type', 'text')" onmouseleave="this.setAttribute('type', 'password')">
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow"></div>
        </div>

    </div>

    </form>
</div>
<div class="w-100 text-center text-su-shadow-white text-su-orange font-weight-bold mt-4">
    Při změně zámku, všichni, kteří už tuto část odemkly, jí budou muset odemnknout znovu!
</div>
