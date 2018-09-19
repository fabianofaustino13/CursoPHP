function show_sindicosMoradores(morId) {
    if (morId == 0) {
        alert('Selecione um morador!!!');
        return;
    } else {
        let http_request = new XMLHttpRequest();
        http_request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let http_response = http_request.responseText;
                document.getElementById("div_sindicosMoradores").innerHTML = http_response;
            }
        };
        http_request.open("GET","../sindico/sindicoMorador.php?moradorId=" + morId,true);
        http_request.send();
    }
}