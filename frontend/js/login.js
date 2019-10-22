function addLoginFields(){
    addLoginField('loginArea', 'usuario', 'Login', 'text')
    addLoginField('loginArea', 'senha', 'Senha', 'password')

    ajustButtonsPosition();

    function addLoginField(masterDiv, idNewElement, placeholder, type){
        let label = document.createElement('label');
        label.innerText = placeholder;
    
        let input = document.createElement('input');
        input.setAttribute('name', idNewElement);
        input.type = type;
    
        let field = document.createElement('div');
        field.setAttribute('class', 'loginField')
        field.appendChild(label);
        field.appendChild(input);
        
        field.onclick = () => {
            field.setAttribute('class', 'loginField on');
            input.focus();
        };
        
        input.addEventListener("blur", () => {
            if(!input.value){
                field.setAttribute('class', 'loginField');
            }
        });
        
        let dad = document.getElementById(masterDiv);
        dad.appendChild(field);
    }
    
    function ajustButtonsPosition(){
        let loginArea = document.getElementById('loginArea');
        let loginButtons = document.getElementById('loginButtons');
    
        loginArea.removeChild(loginButtons);
        loginArea.appendChild(loginButtons);
    }
}

let loginForm = document.getElementById('loginArea');
loginForm.onsubmit = event => {
    event.preventDefault();

    if(loginForm.checkValidity()){
        const bodyFormData = new FormData(loginForm);
        
        
        callAction('backend/login', bodyFormData, (response) => {
            if(response.success){
                window.location.href = 'dashboard';
            }
            else{
                console.error(`Erro: ${response.message}`);
            }
        });
    }
}

addLoginFields();