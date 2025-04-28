function consultaProduto(id, codigo_produto, nome_produto, fornecedor, quantidade, preco) {
    document.getElementById("id-produto").value = id;
    
    let codigo= document.getElementById("codigo-produto");
    
    if (codigo.getAttribute("readOnly") == null) {
        codigo.setAttribute("readOnly", "");
    } 

    document.getElementById("codigo-produto").value = codigo_produto;
    

    document.getElementById("nome-produto").value = nome_produto;
    document.getElementById("fornecedor-produto").value = fornecedor;
    document.getElementById("quantidade-produto").value = quantidade;
    document.getElementById("preco-produto").value = preco;
}
function limparCampos() {

    document.getElementById("id-produto").value = -1;
    document.getElementById("codigo-produto").value = "";
    document.getElementById("nome-produto").value = "";
    document.getElementById("fornecedor-produto").value = "";
    document.getElementById("quantidade-produto").value = "";
    document.getElementById("preco-produto").value = "";
    let codigo= document.getElementById("codigo-produto");
    if (codigo.getAttribute("readOnly") !== null) {
        codigo.removeAttribute("readOnly");
    } 
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