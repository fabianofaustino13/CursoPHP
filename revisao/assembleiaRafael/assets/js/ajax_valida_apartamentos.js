function checa_Cad_Apartamento(){
   
    if (document.Form_Cad_Apartamento.nome.value == '') {
        window.alert("Informe um número para o apartamento");
        Form_Cad_Apartamento.nome.focus();
        return false;
    }
    
    if (isNaN(document.Form_Cad_Apartamento.nome.value)) {
        window.alert("Digite um número");
        Form_Cad_Apartamento.nome.focus();
        return false;
    }
        
    return true;
}