const formSubmitCorte = document.querySelector('#submitCortes');
const result = document.querySelector('#spinner-result');

formSubmitCorte.addEventListener('submit', ()=> {
    mostrarSpinner();
});


function mostrarSpinner(){
    const spinner = document.createElement('div');
    spinner.classList.add('spinner');

    spinner.innerHTML = `
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    `;

    result.appendChild(spinner);

}