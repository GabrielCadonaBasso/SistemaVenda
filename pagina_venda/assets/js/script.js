function menu(){
    const menumobile = document.getElementById("menu-mobile")
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
    menumobile.classList.toggle('menu-mobile-sumir');

}
function fechar(){
    const menumobile = document.getElementById("menu-mobile")
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.remove('active');
    menumobile.classList.remove('menu-mobile-sumir');
}