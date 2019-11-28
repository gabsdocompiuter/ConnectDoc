function abreLoading(){
    const gif = document.createElement('img');
    gif.setAttribute('src', 'frontend/assets/loading.gif');
    gif.setAttribute('alt', 'Carregando');

    const loagingContent = document.createElement('div');
    loagingContent.setAttribute('class', 'loaging-content');
    loagingContent.appendChild(gif);

    const loadingModal = document.createElement('div');
    loadingModal.setAttribute('id', 'loadingModal');
    loadingModal.setAttribute('class', 'loadingModal');
    loadingModal.appendChild(loagingContent);
    
    const container = document.getElementById('container');
    container.appendChild(loadingModal);
}

function fechaLoading(){
    const loadingModal = document.getElementById('loadingModal');
    loadingModal.style.display = "none";
}

function ajustaMenu(selecionado){
    const menuLista = document.getElementById('menuLista');
    const menuItens = menuLista.getElementsByTagName('li');

    for (let i = 0; i < menuItens.length; i++) {
        menuItens[i].removeAttribute('class');
    }

    const itemSelecionado = document.getElementById(`li_${selecionado}`);
    itemSelecionado.setAttribute('class', 'active');
}
