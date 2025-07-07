function alternarTema() {
    const body = document.body;
    const temaAtual = body.classList.contains('tema-escuro') ? 'escuro' : 'claro';

    if (temaAtual === 'claro') {
        body.classList.replace('tema-claro', 'tema-escuro');
        localStorage.setItem('temaPreferido', 'escuro');
    } else {
        body.classList.replace('tema-escuro', 'tema-claro');
        localStorage.setItem('temaPreferido', 'claro');
    }
}

window.onload = function () {
    const temaSalvo = localStorage.getItem('temaPreferido');
    if (temaSalvo === 'escuro') {
        document.body.classList.replace('tema-claro', 'tema-escuro');
    }
};
