function montaCategoria(){
    const endpoint = `http://localhost/backend/categorias`;
    
    const selectCategorias = document.getElementById('selectCategoria');
        
    fetch(endpoint)
        .then(response => response.json())
        .then(response => {
            response.map(categoria => {
                const option = document.createElement('option');
                option.setAttribute('value', categoria.id);
                option.innerText = categoria.descricao;

                selectCategorias.appendChild(option);
            })
        });
}

let cadastrarButton = document.getElementById('cadastrarButton');
cadastrarButton.onclick = () => {
    if(cadastroValido()){
        // const endpoint = validaCampo('crm') ? '' : ';'
        const endpoint = 'http://localhost/backend/cadastrar';
        
        const formData = new FormData();
        formData.append('nome',     getFieldValue('nome'));
        formData.append('telefone', getFieldValue('telefone'));
        formData.append('email',    getFieldValue('email'));
        formData.append('usuario',  getFieldValue('usuario'));
        formData.append('senha',    getFieldValue('senha'));

        if(validaCampo('crm')){
            formData.append('categoria', getFieldValue('categoria'));
            formData.append('crm',       getFieldValue('crm'));
        }
        
        formData.append('tipo', validaCampo('crm') ? 'medico' : 'secretaria');
        
        callAction(endpoint, formData, (response) => {
            if(response.success){
                window.location.reload();
            }
            else{
                const messageField = document.getElementById('mensagem');
                messageField.innerText = `Houve um erro! Tente outro usuário.`;
            }
        });
    }
}

function getFieldValue(field){
    return document.getElementsByName(field)[0].value;
}

function cadastroValido(){
    if(!validaCampo('nome', true)) return false;
    if(!validaCampo('telefone', true)) return false;
    if(!validaCampo('email', true)) return false;
    if(!validaCampo('usuario', true, 'user')) return false;
    if(!validaCampo('senha', true)) return false;

    return true;
}

function validaCampo(nome, informar, tipo){
    const campo = document.getElementsByName(nome)[0];
    if(campo.value == ''){
        if(informar){
            const messageField = document.getElementById('mensagem');
            messageField.innerText = `Campo ${nome} não informado!`;
        }

        return false;
    }

    return true;
}

montaCategoria();