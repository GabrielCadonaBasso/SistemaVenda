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