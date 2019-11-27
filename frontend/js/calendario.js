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

const selecionado = {
    ano: 2019,
    mes: '',
    dia: '',

    data: () => {
        const ano = selecionado.ano;
        const dia = selecionado.dia;
        let data = 0;

        monthNames.map((name, index) => {
            if(name.substring(0, 3) == selecionado.mes){
                const mes = index + 1;
                data = `${ano}${mes}${dia}`;
            }
        });

        return data;
    }
}

function montaCalendario(){
    const date = new Date();
    

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
                        montaAgenda();
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
}

function montaAgenda(){
    const medicos = document.getElementById('medicos');
    medicos.innerHTML = '';

    function montaMedicos(){
        const endpoint = `http://localhost/backend/users/medicos`;
        fetch(endpoint)
            .then(response => response.json())
            .then(response => {
                response.map(medico => {
                    const medNome = document.createElement('h1');
                    medNome.innerText = medico.nome;

                    const medDesc = document.createElement('h3');
                    medDesc.innerText = medico.descricao;

                    const medInfo = document.createElement('div');
                    medInfo.setAttribute('class', 'medico info');
                    medInfo.appendChild(medNome);
                    medInfo.appendChild(medDesc);

                    const horarioTitulo = document.createElement('div');
                    horarioTitulo.setAttribute('class', 'horario titulo');
                    horarioTitulo.innerText = 'Horário';

                    const pacienteTitulo = document.createElement('div');
                    pacienteTitulo.setAttribute('class', 'paciente titulo');
                    pacienteTitulo.innerText = 'Paciente';

                    const linha = document.createElement('div');
                    linha.setAttribute('class', 'linha');
                    linha.appendChild(horarioTitulo);
                    linha.appendChild(pacienteTitulo);

                    const medAgenda = document.createElement('div');
                    medAgenda.setAttribute('class', 'medico agenda');
                    medAgenda.appendChild(linha);

                    leHorarios(medico.id, medAgenda);

                    const divMedico = document.createElement('div');
                    divMedico.setAttribute('class', 'medico');
                    divMedico.appendChild(medInfo);
                    divMedico.appendChild(medAgenda);

                    medicos.appendChild(divMedico);

                })
            });
    }

    function leHorarios(medId, divAgenda){
        const endpoint = `http://localhost/backend/agenda/consultas/${selecionado.data()}/${medId}`;
        console.log(endpoint);
        
        fetch(endpoint)
            .then(response => response.json())
            .then(response => {
                response.map(agendamento => {
                    const horario = document.createElement('div');
                    horario.setAttribute('class', 'horario');
                    horario.innerText = agendamento.horario;

                    const paciente = document.createElement('div');
                    paciente.setAttribute('class', 'paciente');
                    paciente.innerText = agendamento.nomePaciente ? agendamento.nomePaciente : '—';

                    const linha = document.createElement('div');
                    linha.setAttribute('class', 'linha');
                    linha.appendChild(horario);
                    linha.appendChild(paciente);

                    divAgenda.appendChild(linha);
                })
            });
    }

    montaMedicos();
}

montaCalendario();
montaAgenda();