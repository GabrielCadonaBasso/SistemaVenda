function consultaPessoa(id, nome, cpf) {
    document.getElementById('id-cliente').value = id;
    document.getElementById('nome-cliente').value = nome;
    
    document.getElementById('cpf-cliente').value = cpf;
    
}
function limparCampos() {

    document.getElementById('id-cliente').value = -1;
    document.getElementById('nome-cliente').value = "";
    document.getElementById('cpf-cliente').value = "";
    
    
}
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
function formatarCPF(campo) {
    let cpf = campo.value.replace(/\D/g, ''); // Remove tudo que não é número
    cpf = cpf.substring(0, 11); // Limita a 11 dígitos

    let formatado = '';

    if (cpf.length > 0) formatado = cpf.substring(0, 3);
    if (cpf.length >= 4) formatado += '.' + cpf.substring(3, 6);
    if (cpf.length >= 7) formatado += '.' + cpf.substring(6, 9);
    if (cpf.length >= 10) formatado += '-' + cpf.substring(9, 11);

    campo.value = formatado;
}