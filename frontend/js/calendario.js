const selecionado = {
    mes: '',
    dia: '',
}

const date = new Date();
const monthNames = [
    "Janeiro",
    "Fevereiro",
    "Março",
    "Abril",
    "Maio",
    "Junho",
    "Julho",
    "Agosto",
    "Setembro",
    "Outubro",
    "Novembro",
    "Dezembro"
];

function montaMeses(mesSelecionado){
    const lista = document.getElementById('meses_lista');
    lista.innerHTML = '';

    monthNames.map(mes => adicionaMes(mes.substring(0, 3)));

    function adicionaMes(mes){
        function atualizaDias(){
            montaMeses(mes);
            montaDias(mes);
        }

        const item = document.createElement('li');
        item.setAttribute('id', `month_${mes}`)
        item.innerText = mes;
        item.onclick = atualizaDias;

        if(mes == mesSelecionado) item.setAttribute('class', 'selecionado');
        
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
                    selecionado.mes = mes;
                    selecionado.dia = dia;

                    montaDias(mes, dia);
                    // alert(dia);
                }

                const item = document.createElement('li');
                item.setAttribute('id', `day_${dia}`)
                item.innerText = dia;
                item.onclick = atualizaAgenda;

                if(dia == selecionado.dia && mes == selecionado.mes)
                    item.setAttribute('class', 'selecionado');
                
                lista.appendChild(item);
            })
        })
}

selecionado.mes = monthNames[date.getMonth()].substring(0, 3); 
selecionado.dia = date.getDate();

montaMeses(selecionado.mes);
montaDias(selecionado.mes);