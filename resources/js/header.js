const menu = document.querySelector('nav.mobile');
const abrir = document.querySelector('img.menu-hamburguer');
const fechar = document.querySelector('nav.mobile img.fechar')

abrir.addEventListener('click', () => {
    menu.style.display = "flex";
    abrir.style.display = "none";
});

fechar.addEventListener('click', () => {
    menu.style.display = "none";
    abrir.style.display = "block";
    
})