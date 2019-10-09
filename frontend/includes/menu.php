<div class="menuContainer">
    <div class='menuLine'>
        <div class="menuLogo">
            <img src="assets/logo_white.png" alt="Logo ConnectDoc"/>
        </div>
        <div class="menuBottons">
            <ul>
                <li onclick="goTo('visualizar')" class="active">Ver Agenda</li>
                <li onclick="goTo('cadastrar')">Cadastrar</li>
                <li onclick="goTo('logout')" >Sair</li>
            </ul>
        </div>
    </div>
    <div class="horizontalSeparator"></div>
</div>

<script>
    function goTo(page){
        alert(`going to ${page}`);
    }

</script>