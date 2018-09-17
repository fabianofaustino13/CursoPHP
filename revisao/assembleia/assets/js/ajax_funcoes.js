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
    // var password1 = document.form1.senha.value;
    // var password2 = document.form1.senha2.value;
    if (isNaN(document.form1.cpf.value)) {
        window.alert("A Digite apenas números no CPF");
        window.alert(document.form1.cpf.value);
    }else {
        window.alert("B Digite apenas números no CPF");
        window.alert(document.form1.cpf.value)
    }
    if ((document.form1.senha.value != '') && (document.form1.senha2.value != '')) {
        // window.alert("ok");
        if (document.form1.senha.value != document.form1.senha2.value){
            // window.alert("Seja bem-vindo "+user+"");
            window.alert("Senhas não conferem");
        }
    // if(!isset($_POST['senha']) && !empty($_POST['senha'])){
    }else{
        window.alert("A senha não pode ser 'Vazio'");
    }
    
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