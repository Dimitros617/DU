<div id="timer-bar-container" class="w-100 bg-su-lblue fixed bottom-0 " style="height: 15px">
    <div id="timer-bar" class="bg-su-lorange w-100 h-100 su-animation-1 su-animation-linear"></div>
</div>
<div id="timer-bar-time" onclick="changeTimerMod(this) @if(Auth::permition()->edit_content == '1') ; setTimer(this.parentNode.getAttribute('time')) @endif" mod="@if(Auth::permition()->edit_content != '1') 0 @else 2 @endif" class="cursor-pointer bg-su-orange fw-bold h3 text-white text-center fixed bottom-0 right-0 me-2 p-3 mb-0 su-animation-02 su-hover-shadow" style="border-radius: 5px 5px 0 0; ">@if(Auth::permition()->edit_content != '1')Startuji...@else Spustit odpočet @endif</div>
@if(Auth::permition()->edit_content != '1')<input onload="setTimer(this.parentNode.getAttribute('time'))" hidden>@endif
