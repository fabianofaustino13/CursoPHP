function show_pautas(assId) {
    if (assId == 0) {
        alert('Selecione uma Assembléia!!!');
        return;
    } else {
        let http_request = new XMLHttpRequest();
        http_request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let http_response = http_request.responseText;
                document.getElementById("div_pautas").innerHTML = http_response;
            }
        };
        http_request.open("GET","../pauta/pautas.php?assembleia=" + assId,true);
        http_request.send();
    }
}
function show_apartamentos(bloId) {
    if (bloId == 0) {
        alert('Selecione um Bloco!!!');
        return;
    } else {
        let http_request = new XMLHttpRequest();
        http_request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let http_response = http_request.responseText;
                document.getElementById("div_apartamentos").innerHTML = http_response;
            }
        };
        http_request.open("GET","../morador/blocoApartamento.php?blocoId=" + bloId,true);
        http_request.send();
    }
}

function checaFormulario(){
   
    if (document.form1.nome.value == '') {
        window.alert("Informe um nome para o Morador");
        form1.nome.focus();
        return false;
    }

    if (document.form1.cpf.value != '') {
        let cpf = document.form1.cpf.value;
        regex = /^[0-9]{11}$/; 
        // Validar cnpj basta add | e a máscara. ex. "([0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2} | [0-9]{2}\.[0-9]{3}\.[0-9]{3}\/[0-9]{4}\-[0-9]{2})"
        valida_cpf = cpf.search(regex) == -1 ? false : true;
        //alert(valida_cpf);
        if (valida_cpf != true){
            // window.alert(valida_cpf);
            window.alert("CPF Inválido");
            form1.cpf.focus();
            return false;
        }
    }else{
        window.alert("Digite um CPF");
        form1.cpf.focus();
        return false;
    }
    if (document.form1.login.value == '') {
        window.alert("Informe um login para o Morador");
        form1.login.focus();
        return false;
    }
  
    if (document.form1.senha.value == '') {
        window.alert("O campo senha não pode ser vazio");
        form1.senha.focus();
        return false;
    }

    if (document.form1.senha2.value == '') {
        window.alert("O campo de confirme a senha não pode ser vazio");
        form1.senha2.focus();
        return false;
    }

    if (document.form1.senha.value != document.form1.senha2.value){
        // window.alert("Seja bem-vindo "+user+"");
        window.alert("Senhas não conferem");
        form1.senha.focus();
        return false;
    }   
    
    return true;
}

// function checaCadastro() {
    //     confirm("The form was submitted");
    // }
    
    
    
    // function show_bairros(cidade_id) {
        //     if (cidade_id == 0) {
            //         alert('Selecione uma Cidade!!!');
            //         return;
            //     } else {
                //         let http_request = new XMLHttpRequest();
                //         http_request.onreadystatechange = function() {
                    //             if (this.readyState == 4 && this.status == 200) {
                        //                 let http_response = http_request.responseText;
                        //                 document.getElementById("div_bairro").innerHTML = http_response;
                        //             }
                        //         };
                        //         http_request.open("GET","../bairro/index.php?cid=" + cidade_id,true);
                        //         http_request.send();
                        //     }
                        // }

// Contatos dos moradores. Emails/Fones
function show_contatoMorador(mor_id) {
    if (mor_id == 0) {
        return;
    } else {
        let http_request = new XMLHttpRequest();
        http_request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let http_response = http_request.responseText;
                document.getElementById("div-contatos-mor").innerHTML = http_response;
            }
        };
        http_request.open("GET","../morador/contatos.php?id=" + mor_id, true);
        http_request.send();
    }
}
function addEmailMorador(mor_id) {
    if (mor_id == 0) {
        alert("Morador inválido!");
        return;
    } else {
        let http_request = new XMLHttpRequest();
        http_request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let http_response = http_request.responseText;
                document.getElementById("editInfoSelecionada").innerHTML = http_response;
            }
        };
        http_request.open("GET","../contatoMorador/emailMorador.php?id=" + mor_id, true);
        http_request.send();
    }
}
function addTelefoneMorador(mor_id) {
    if (mor_id == 0) {
        alert("Morador inválido!");
        return;
    } else {
        let http_request = new XMLHttpRequest();
        http_request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let http_response = http_request.responseText;
                document.getElementById("editInfoSelecionada").innerHTML = http_response;
            }
        };
        http_request.open("GET","../contatoMorador/foneMorador.php?id=" + mor_id, true);
        http_request.send();
    } 
}
// Fim do contatos dos moradores.

// Contatos dos dependentes. Emails/Fones - Responsavel
function show_contatoDependente(dep_id) {
    if (dep_id == 0) {
        return;
    } else {
        let http_request = new XMLHttpRequest();
        http_request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let http_response = http_request.responseText;
                document.getElementById("div-contatos-dep").innerHTML = http_response;
            }
        };
        http_request.open("GET","../dependente/contatos.php?id=" + dep_id, true);
        http_request.send();
    }
}
function addEmailDependente(dep_id) {
    if (dep_id == 0) {
        alert("Selecione um dependente válido!");
        return;
    } else {
        let http_request = new XMLHttpRequest();
        http_request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let http_response = http_request.responseText;
                document.getElementById("editInfoSelecionada").innerHTML = http_response;
            }
        };
        http_request.open("GET","../contatoDependente/emailDependente.php?id=" + dep_id, true);
        http_request.send();
    }
}
function addTelefoneDependente(dep_id) {
    if (dep_id == 0) {
        alert("Selecione um dependente válido!");
        return;
    } else {
        let http_request = new XMLHttpRequest();
        http_request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let http_response = http_request.responseText;
                document.getElementById("editInfoSelecionada").innerHTML = http_response;
            }
        };
        http_request.open("GET","../contatoDependente/foneDependente.php?id=" + dep_id, true);
        http_request.send();
    }
}
function addResponsavelDependente(dep_id) {
    if (dep_id == 0) {
        alert("Selecione um dependente válido!");
        return;
    } else {
        let http_request = new XMLHttpRequest();
        http_request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let http_response = http_request.responseText;
                document.getElementById("editInfoSelecionada").innerHTML = http_response;
            }
        };
        http_request.open("GET","../contatoDependente/respMorador.php?id=" + dep_id, true);
        http_request.send();
    }
}
// Fim dos contatos do dependente.