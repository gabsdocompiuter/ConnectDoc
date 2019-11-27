<div class="menuContainer">
    <div class='menuLine'>
        <div class="menuLogo">
            <img src="/frontend/assets/logo_white.png" alt="Logo ConnectDoc"/>
        </div>
        <div class="menuBottons">
            <ul id="menuLista">
                <li id="li_dash" onclick="goTo('dash')" class="active">Ver Agenda</li>
                <li id="li_cadastrar" onclick="goTo('cadastrar')">Cadastrar</li>
                <li id="li_logout" onclick="goTo('logout')" >Sair</li>
            </ul>
        </div>
    </div>
    <div class="horizontalSeparator"></div>
</div>

<script>
    function goTo(page){
        window.location.href = page;
    }
</script>