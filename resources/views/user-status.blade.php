<div class="pageTitle mt-2">Postup žáka {{$data[0]->user_name}} {{$data[0]->user_surname}}</div>
<div class="h4 text-su-orange w-100 text-center mb-3" >
    Seznam je řazen podle posledního přístupu, čas je pak vždy v letním formátu!
</div>

<div class="List">

    @foreach($data as $dat)
        <div class="status-row d-inline-flex w-100 mx-auto mb-3 justify-content-between bg-su-blue-orange-gradient rounded-3 shadow p-5" style="    border-left: 10px solid #ff9f1c;">

            <div class="status-name fw-bold h1 text-su-blue text-su-shadow-white" style="line-height: 200%;">{{$dat->display_name}} {{$dat->name}}</div>

            <div class="status-visited d-grid">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-door-open status-svg su-svg-shadow-white" viewBox="0 0 16 16">
                    <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                    <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"/>
                </svg>
                <label class="fw-bold text-white text-su-shadow my-2 let" style="letter-spacing: 1px;">Celkem navštíveno</label>
                <label class="fw-bold text-su-orange h4 text-su-shadow-white">{{$dat->entry}} x</label>
            </div>
            <div class="status-last d-grid">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-clock-fill status-svg su-svg-shadow-white" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                </svg>
                <label class="fw-bold text-white text-su-shadow my-2 let" style="letter-spacing: 1px;">Naposledy navštíveno</label>
                <label class="fw-bold text-su-orange h4 text-su-shadow-white">{{$dat->last}}</label>
            </div>
            <div class="status-locked d-grid">
                <label class="fw-bold text-white text-su-shadow my-2 let" style="letter-spacing: 1px;">Zámek</label>
                @if($dat->locked == null)
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill status-svg su-svg-shadow-white" viewBox="0 0 16 16">
                        <title>Nenastaven zámek, či se žák nepokusil ani o otevření</title>
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                @elseif($dat->locked == "0")
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-unlock-fill status-svg su-svg-shadow-white" viewBox="0 0 16 16">
                        <title>Uspěšně odemknuto {{$dat->lockedDate}}</title>
                        <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z"/>
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-lock-fill status-svg su-svg-shadow-white" viewBox="0 0 16 16">
                        <title>Zamknuto, již proběhl pokus o vstup.</title>
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                    </svg>
                @endif

            </div>
            <div class="status-finished d-grid">
                <label class="fw-bold text-white text-su-shadow my-2 let" style="letter-spacing: 1px;">Dokončeno</label>
                @if($dat->finish != null)
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle-fill status-svg su-svg-shadow-white" viewBox="0 0 16 16">
                        <title>Dokončeno: {{$dat->finish}}</title>
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill status-svg su-svg-shadow-white" viewBox="0 0 16 16">
                        <title>Zatím označeno jako nedokončené</title>
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                @endif


            </div>
        </div>
    @endforeach
</div>
