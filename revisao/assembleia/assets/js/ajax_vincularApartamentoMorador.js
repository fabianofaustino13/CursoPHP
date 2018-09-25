function show_vincularApartamentoMorador(bloId) {
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
        http_request.open("GET","../vincularApartamentoMorador/vincularApartamento.php?blocoId=" + bloId,true);
        http_request.send();
    }
}