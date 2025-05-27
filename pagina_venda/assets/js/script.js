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
document.getElementById('botao-limpar').addEventListener('click', function() {
        document.getElementById('id-produto').value = '';
        document.getElementById('nome-produto').value = '';
        document.getElementById('qtd-produto').value = '';
        document.getElementById('preco-total').value = '';
    });
function atualizarValorTotalHidden() {
    const valorTotal = document.getElementById('valor-total');
    const valorTotalHidden = document.getElementById('valor-total-hidden');
    if (valorTotal && valorTotalHidden) {
        valorTotalHidden.value = valorTotal.value;
    }
}

// Atualiza o valor total e o hidden ao carregar a página
window.addEventListener('DOMContentLoaded', function() {
    let total = 0;
    document.querySelectorAll('.lista-compras table tr td:nth-child(4)').forEach(function(td) {
        let valor = td.textContent.replace('R$', '').replace(/\./g, '').replace(',', '.').trim();
        if (!isNaN(valor) && valor !== '') {
            total += parseFloat(valor);
        }
    });
    const valorTotalInput = document.getElementById('valor-total');
    if (valorTotalInput) {
        valorTotalInput.value = total.toFixed(2);
    }
    atualizarValorTotalHidden();
});

function printar(){
    alert("Não é possível")
}