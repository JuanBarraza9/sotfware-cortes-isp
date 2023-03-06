const e=document.querySelector("#submitCortes"),d=document.querySelector("#spinner-result");e.addEventListener("submit",()=>{t()});function t(){const s=document.createElement("div");s.classList.add("spinner"),s.innerHTML=`
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    `,d.appendChild(s)}
