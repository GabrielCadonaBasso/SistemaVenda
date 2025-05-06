function formatarCNPJ(campo) {
    let cnpj = campo.value.replace(/\D/g, ''); // Remove tudo que não for número
    cnpj = cnpj.substring(0, 14); // Limita a 14 dígitos

    let formatado = '';

    if (cnpj.length > 0) formatado = cnpj.substring(0, 2);
    if (cnpj.length >= 3) formatado += '.' + cnpj.substring(2, 5);
    if (cnpj.length >= 6) formatado += '.' + cnpj.substring(5, 8);
    if (cnpj.length >= 9) formatado += '/' + cnpj.substring(8, 12);
    if (cnpj.length >= 13) formatado += '-' + cnpj.substring(12, 14);

    campo.value = formatado;
}