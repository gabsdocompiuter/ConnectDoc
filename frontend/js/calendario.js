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
    },

    dataPontuada: () => {
        const ano = selecionado.ano;
        const dia = selecionado.dia;
        let data = 0;

        monthNames.map((name, index) => {
            if(name.substring(0, 3) == selecionado.mes){
                const mes = index + 1;
                data = `${dia}/${mes}/${ano}`;
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

                    leHorarios(medico, medAgenda);

                    const divMedico = document.createElement('div');
                    divMedico.setAttribute('class', 'medico');
                    divMedico.appendChild(medInfo);
                    divMedico.appendChild(medAgenda);

                    medicos.appendChild(divMedico);

                })
            })
    }

    function leHorarios(medico, divAgenda){
        const endpoint = `http://localhost/backend/agenda/consultas/${selecionado.data()}/${medico.id}`;
        
        fetch(endpoint)
            .then(response => response.json())
            .then(response => {
                response.map(agendamento => {
                    const horario = document.createElement('div');
                    horario.setAttribute('class', 'horario');
                    horario.innerText = agendamento.horario;
                    horario.onclick = abrirModal;

                    const paciente = document.createElement('div');
                    paciente.setAttribute('class', 'paciente');
                    paciente.innerText = agendamento.nomePaciente ? agendamento.nomePaciente : '—';

                    const linha = document.createElement('div');
                    linha.setAttribute('class', 'linha');
                    linha.appendChild(horario);
                    linha.appendChild(paciente);

                    divAgenda.appendChild(linha);

                    function abrirModal(){
                        const closeButton = document.createElement('span');
                        closeButton.setAttribute('class', 'close');
                        closeButton.innerText = 'x';

                        const nomeMedico = document.createElement('h1');
                        nomeMedico.innerText = medico.nome;

                        const dataHora = document.createElement('h3');
                        dataHora.innerText = `${selecionado.dataPontuada()} – ${agendamento.horario}`;

                        const horarioInfo = document.createElement('div');
                        horarioInfo.setAttribute('class', 'horarioInfo');
                        horarioInfo.appendChild(nomeMedico);
                        horarioInfo.appendChild(dataHora);

                        const label = document.createElement('label');
                        label.innerText = 'Nome do paciente';

                        const inputNome = document.createElement('input');
                        inputNome.setAttribute('class', 'inputNome');
                        inputNome.setAttribute('name', 'inputNome');

                        const pacienteInfo = document.createElement('div');
                        pacienteInfo.setAttribute('class', 'pacienteInfo');
                        pacienteInfo.appendChild(label);
                        pacienteInfo.appendChild(inputNome);

                        const content = document.createElement('div');
                        content.setAttribute('class', 'content');
                        content.appendChild(horarioInfo);
                        content.appendChild(pacienteInfo);

                        const buttonSave = document.createElement('button');
                        buttonSave.innerText = 'Marcar Horário';

                        const modalContent = document.createElement('div');
                        modalContent.setAttribute('class', 'modal-content');
                        modalContent.appendChild(closeButton);
                        modalContent.appendChild(content);
                        modalContent.appendChild(buttonSave);

                        const modal = document.createElement('div');
                        modal.setAttribute('id', 'modal');
                        modal.setAttribute('class', 'modal');
                        modal.appendChild(modalContent);
                        
                        const container = document.getElementById('container');
                        container.appendChild(modal);

                        buttonSave.onclick = () => {
                            const hora = agendamento.horario;
                            const horaLimpa = hora.substr(0, 2) + hora.substr(3, 2) + '00';
                            const horario = selecionado.data() + horaLimpa;

                            const formData = new FormData();
                            formData.append('medico', medico.id)
                            formData.append('paciente', inputNome.value)
                            formData.append('horario', horario)

                            callAction('backend/agenda/cadastrar', formData, (response) => {
                                if(response.success){
                                    modal.style.display = "none";
                                    montaAgenda();
                                }
                                else{
                                    console.error(`Erro: ${response.message}`);
                                }
                            });

                        }

                        closeButton.onclick = () => {
                            modal.style.display = "none";
                        }

                        window.onclick = event => {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    }
                })
            });
    }

    montaMedicos();
}

montaCalendario();
montaAgenda();