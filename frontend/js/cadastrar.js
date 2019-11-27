let cadastrarButton = document.getElementById('cadastrarButton');
cadastrarButton.onclick = () => {
    if(cadastroValido()){
        alert('passou');
        // const bodyFormData = new FormData(cadastrarForm);
        
        
        // callAction('backend/cadastrar', bodyFormData, (response) => {
        //     if(response.success){
               
        //         window.location.href = 'dash';
        //     }
        //     else{
        //         console.error(`Erro: ${response.message}`);
        //     }
        // });
    }
}

function cadastroValido(){
    if(!validaCampo('nome', true)) return false;
    if(!validaCampo('telefone', true)) return false;
    if(!validaCampo('email', true)) return false;
    if(!validaCampo('usuario', true, 'user')) return false;
    if(!validaCampo('senha', true)) return false;

    if(validaCampo('crm', false)){
        // if(!validaCampo('crm', true)) return false;
        if(!validaCampo('crm', true)) return false;
    }

    return true;

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
}