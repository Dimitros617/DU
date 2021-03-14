


<div class=" sm:rounded-lg  shadow p-5 m-4 max-w-6xl mx-auto d-flex align-items-center justify-center bg-su-orange-texture flex-column su-animation-05 su-hover-scale su-hover-shadow">
    <div class="text-su-hologram-orange">Tato část je teď pro tebe zamčená!</div>

    <button class="su-button w-lg-50"
    onclick="checkLock(this.parentNode.parentNode.getAttribute('element_id'),
     this.parentNode.parentNode.getAttribute('type'),
      this.getElementsByClassName('loading')[0],
        this.getElementsByClassName('loading_request')[0], undefined, undefined)">

        <div class="su-button-image">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-key-fill su-button-svg" viewBox="0 0 16 16">
                <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
            </svg>
            <div class="loading_request text-su-orange" role="status" hidden></div>
            <div class="spinner-grow text-black loading" role="status" hidden></div>
        </div>

        <div class="su-button-text ">
                ZKUSIT ODEMKNOUT
        </div>
    </button>

</div>

