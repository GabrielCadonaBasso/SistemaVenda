function consultaPessoa(id, nome, rg, cpf) {
    document.getElementById('id-cliente').value = id;
    document.getElementById('nome-cliente').value = nome;
    document.getElementById('rg-cliente').value = rg;
    document.getElementById('cpf-cliente').value = cpf;
    
}
function limparCampos() {

    document.getElementById("id-produto").value = -1;
    document.getElementById("codigo-produto").value = "";
    document.getElementById("nome-produto").value = "";
    document.getElementById("fornecedor-produto").value = "";
    document.getElementById("quantidade-produto").value = "";
    document.getElementById("preco-produto").value = "";
    let codigo= document.getElementById("codigo-produto");
    
}