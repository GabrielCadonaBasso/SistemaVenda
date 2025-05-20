function PegarCliente(id, nome){
    document.getElementById('id_colaborador_sessao').value=id;
    document.getElementById('nome_colaborador_sessao').value=nome;
    document.getElementById('form-colaborador-sessao').submit();
}