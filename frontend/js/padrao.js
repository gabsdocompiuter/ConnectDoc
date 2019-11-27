function ajustaMenu(selecionado){
    const menuLista = document.getElementById('menuLista');
    const menuItens = menuLista.getElementsByTagName('li');

    for (let i = 0; i < menuItens.length; i++) {
        menuItens[i].removeAttribute('class');
    }

    const itemSelecionado = document.getElementById(`li_${selecionado}`);
    itemSelecionado.setAttribute('class', 'active');
}