function montaMeses(){
    adicionaMes('Jan');
    adicionaMes('Fev');
    adicionaMes('Mar');
    adicionaMes('Abr');
    adicionaMes('Mai');
    adicionaMes('Jun');
    adicionaMes('Jul');
    adicionaMes('Ago');
    adicionaMes('Set');
    adicionaMes('Out');
    adicionaMes('Nov');
    adicionaMes('Dez');

    function adicionaMes(mes){
        function atualizaDias(){
            montaDias(mes);
        }

        const item = document.createElement('li');
        item.innerText = mes;
        item.onclick = atualizaDias;
        
        const lista = document.getElementById('meses_lista');
        lista.appendChild(item);
    }
}

function montaDias(mes){
    const lista = document.getElementById('dias_lista');
    lista.innerHTML = '';
    const endpoint = `http://localhost/backend/dias/${mes}`;
    fetch(endpoint)
        .then(response => response.json())
        .then(response => {
            response.map(dia => {
                function atualizaAgenda(){
                    window.location = "http://localhost/dash?dia="+dia+"&&mes="+mes;
                    //alert(dia);
                }

                const item = document.createElement('li');
                item.innerText = dia;
                item.onclick = atualizaAgenda;
                
                lista.appendChild(item);
            })
        })
}

montaMeses();
montaDias('fev');