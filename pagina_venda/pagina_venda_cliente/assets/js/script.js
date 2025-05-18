function PegarCliente(id, nome){
    document.getElementById('id_cliente_sessao').value=id;
    document.getElementById('nome_cliente_sessao').value=nome;
    document.getElementById('form-cliente-sessao').submit();
}