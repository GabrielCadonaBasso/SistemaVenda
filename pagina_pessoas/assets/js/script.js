function consultaProduto(id, nome_cliente, rg_cliente, cpf_cliente) {
    document.getElementById("id-cliente").value = id;
    document.getElementById("nome-cliente").value = nome_cliente;
    document.getElementById("rg-cliente").value = rg_cliente;
    document.getElementById("cpf-cliente").value = cpf_cliente;
    
}
function exibirMensagem ($mensagem){
    alert( json_encode($mensagem) );
}