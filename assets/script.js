document.addEventListener("DOMContentLoaded", () => {

    const body = document.body;
    const toggleBtn = document.querySelector('.toggle-theme');

    // Aplica tema salvo
    const temaSalvo = localStorage.getItem("tema");
    if (temaSalvo === "light") {
        body.classList.add("light");
        toggleBtn.textContent = "🌙 Dark";
    } else {
        toggleBtn.textContent = "☀️ Light";
    }

    // Evento do botão de tema
    toggleBtn.addEventListener('click', () => {
        body.classList.toggle('light');

        if (body.classList.contains('light')) {
            toggleBtn.textContent = '🌙 Dark';
            localStorage.setItem("tema", "light");
        } else {
            toggleBtn.textContent = '☀️ Light';
            localStorage.setItem("tema", "dark");
        }

        body.style.animation = 'none';
        body.offsetHeight;
        body.style.animation = 'fadeIn 1.4s ease-in';
    });

    // Popup de sucesso
    window.fecharPopup = function () {
        document.getElementById("popup").style.display = "none";
    };
    if (window.mostrarPopup) {
    document.getElementById("popup").style.display = "flex";
}

});