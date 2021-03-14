
<div class="pageTitle">Omezení přístupu</div>

<div class="su-h3 text-su-orange w-100 text-center" >
    Nastavte prvku {{$data->name}} podmínku, kterou musí žák splnit, aby se mu tento prvek zpřístupnil.
</div>

<div class="chapter-lock-setting">


    <form>

        {{--        Bez omezení--}}
        <div class="rule-box bg-su-blue-orange-gradient shadow su-hover-shadow su-animation-05" id="empty">

            <div class="rule-title bg-su-texture shadow float-start text-su-hologram-blue-inverted ">Bez omezení</div>

            <div class="switch-box float-end d-grid " style="margin-top: -5rem;">
                <label class="switch  ms-auto me-auto">
                    <input type="radio" name="rule" class="radio-rule-slider" @if($data->security == "empty" || is_null($data->security))value="1" checked @else value="0" @endif>
                    <span class="slider round" for="radio-rule-slider" onclick="changeRadio(this)"></span>

                </label>
                <div class="mt-2 font-weight-bolder text-white font-weight-bold">@if($data->security == "empty" || is_null($data->security))ZAPNUTO @else VYPNUTO @endif</div>
            </div>
        </div>


        {{--        Pravidlo pro čas--}}
    <div class="rule-box bg-su-blue-orange-gradient shadow su-hover-shadow su-animation-05" id="time">

        <div class="rule-title bg-su-texture shadow  float-start text-su-hologram-blue-inverted">Časové omezení</div>

        <div class="switch-box float-end d-grid" style="margin-top: -5rem;">
            <label class="switch  ms-auto me-auto">
                <input type="radio" name="rule" class="radio-rule-slider" @if($data->security == "time")value="1" checked @else value="0" @endif >
                <span class="slider round" for="radio-rule-slider" onclick="changeRadio(this)"></span>

            </label>
            <div class="mt-2 font-weight-bolder text-white font-weight-bold">@if($data->security == "time")ZAPNUTO @else VYPNUTO @endif</div>
        </div>

        <div class="rule mt-5 w-100 d-inline-flex justify-center">
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow">Žák musí počkat </div>
            <input type="number" class="rule-key rule-text su-input-white text-center w- font-weight-bold h2 text-white text-su-shadow shadow" min="1" @if($data->security == "time")value="{{$data->key}}" @else value="1" @endif>
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow"> vteřin. </div>
        </div>

    </div>


        {{--        Pravidlo pro předchozí--}}
    <div class="rule-box bg-su-blue-orange-gradient shadow su-hover-shadow su-animation-05" id="prev">

        <div class="rule-title  bg-su-texture shadow float-start text-su-hologram-blue-inverted">Dokončit po předchozím</div>

        <div class="switch-box float-end d-grid" style="margin-top: -5rem;">
            <label class="switch  ms-auto me-auto">
                <input type="radio" name="rule" class="radio-rule-slider" @if($data->security == "prev")value="1" checked @else value="0" @endif >
                <span class="slider round" for="radio-rule-slider" onclick="changeRadio(this)"></span>

            </label>
            <div class="mt-2 font-weight-bolder text-white font-weight-bold">@if($data->security == "prev")ZAPNUTO @else VYPNUTO @endif</div>
        </div>

        <div class="rule mt-5 w-100 d-inline-flex justify-center">
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

{{--        Pravidlo pro heslo--}}
    <div class="rule-box bg-su-blue-orange-gradient shadow su-hover-shadow su-animation-05" id="key">

        <div class="rule-title bg-su-texture shadow  float-start text-su-hologram-blue-inverted">Vlastní klíč</div>

        <div class="switch-box float-end d-grid" style="margin-top: -5rem;">
            <label class="switch  ms-auto me-auto">
                <input type="radio" name="rule" class="radio-rule-slider" @if($data->security == "key")value="1" checked @else value="0" @endif >
                <span class="slider round" for="radio-rule-slider" onclick="changeRadio(this)"></span>

            </label>
            <div class="mt-2 font-weight-bolder text-white font-weight-bold">@if($data->security == "key")ZAPNUTO @else VYPNUTO @endif</div>
        </div>

        <div class="rule mt-5 w-100 d-inline-flex justify-center">
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow">Žák musí zadat klíč: </div>
            <input type="password" class=" rule-key rule-text su-input-white text-center w- font-weight-bold h2 text-white text-su-shadow shadow" @if($data->security == "key")value="{{$data->key}}" @else value="" @endif onmouseenter="this.setAttribute('type', 'text')" onmouseleave="this.setAttribute('type', 'password')">
            <div class="rule-text ms-3 me-3 mt-1 font-weight-bold h2 text-white text-su-shadow"></div>
        </div>

    </div>

    </form>
</div>
<div class="w-100 text-center text-su-shadow-white text-su-orange font-weight-bold mt-4">
    Po znovu uložení, všichni, kteří už tuto část odemkly, jí budou muset odemnknout znovu podle nově nastaveného pravidla!
</div>
