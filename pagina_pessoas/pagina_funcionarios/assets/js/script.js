function consultaProduto(id, codigo_produto, nome_produto, fornecedor, quantidade, preco) {
    document.getElementById("id-produto").value = id;
    document.getElementById("codigo-produto").value = codigo_produto;
    document.getElementById("nome-produto").value = nome_produto;
    document.getElementById("fornecedor-produto").value = fornecedor;
    document.getElementById("quantidade-produto").value = quantidade;
    document.getElementById("preco-produto").value = preco;
}
function exibirMensagem ($mensagem){
    alert( json_encode($mensagem) );
}