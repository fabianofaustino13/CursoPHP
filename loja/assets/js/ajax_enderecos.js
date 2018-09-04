function show_cidades(uf_id) {
    if (uf_id == 0) {
        alert('Selecione um Estado!!!');
        return;
    } else {
        let http_request = new XMLHttpRequest();
        http_request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let http_response = http_request.responseText;
                document.getElementById("div_cidade").innerHTML = http_response;
            }
        };
        http_request.open("GET","../cidade/index.php?uf=" + uf_id,true);
        http_request.send();
    }
}

function show_bairros(cidade_id) {
    if (cidade_id == 0) {
        alert('Selecione uma Cidade!!!');
        return;
    } else {
        let http_request = new XMLHttpRequest();
        http_request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let http_response = http_request.responseText;
                document.getElementById("div_bairro").innerHTML = http_response;
            }
        };
        http_request.open("GET","../bairro/index.php?cid=" + cidade_id,true);
        http_request.send();
    }
}