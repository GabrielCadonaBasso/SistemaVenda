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

function inserirClienteCampo(nome){
    if (nome == ''){
        return;
    }else{
        document.getElementById("clienteInput").value = nome;
    }
    
}
function consultaProduto(id, nome_produto, fornecedor, quantidade, preco) {
    document.getElementById("id-produto").value = id;
    document.getElementById("nome-produto").value = nome_produto;
    document.getElementById("qtd-produto").value = 1;
    document.getElementById("preco-total").dataset.precoUnitario = preco;
    document.getElementById("preco-total").value = preco.toFixed(2);
}
function calculaPrecoProduto(quantidade, preco){

}

// Função para atualizar o preço total
function atualizarPrecoTotal() {
    const qtdInput = document.getElementById('qtd-produto');
    const precoTotalInput = document.getElementById('preco-total');
    const precoUnitario = parseFloat(precoTotalInput.dataset.precoUnitario || 0);
    const quantidade = parseInt(qtdInput.value) || 0;
    precoTotalInput.value = (quantidade * precoUnitario).toFixed(2);
}

document.addEventListener('DOMContentLoaded', function() {
    const qtdInput = document.getElementById('qtd-produto');
    if (qtdInput) {
        qtdInput.addEventListener('input', atualizarPrecoTotal);
    }
});