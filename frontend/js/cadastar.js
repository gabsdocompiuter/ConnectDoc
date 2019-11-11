let cadastrarForm = document.getElementById('cadastrarArea');
cadastrarForm.onsubmit = event => {
    event.preventDefault();

    if(cadastrarForm.checkValidity()){
        const bodyFormData = new FormData(cadastrarForm);
        
        
        callAction('backend/cadastrar', bodyFormData, (response) => {
            if(response.success){
               
                window.location.href = 'dashboard';
            }
            else{
                console.error(`Erro: ${response.message}`);
            }
        });
    }
}