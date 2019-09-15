<nav class="navbar navbar-inverse">
  <div class="container-fluid">

    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
    </ul>


    <?php 
      if(isset($_SESSION['logado']) && $_SESSION['logado'] == true){
        

    ?>


        <div class="dropdown">
          <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="nav-icon fa fa-user fa-1x"> </span><?php echo $_SESSION['usuario'] ?></b>
          </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
              
              <a href="edit/<?php echo $_SESSION['id'];?>"class="dropdown-item">Minha Conta</a>
              <a href="sair" class="dropdown-item">Sair</a>

              
        </div>
      </div>

  <?php
  }else{

  ?>  

  <a href="login" class="user-link"><b> <span class= "nav-icon fa fa-user fa-1x" fa-1x> </span>Login</b></a>  


  <?php

  }

  ?>


  </div>
</nav>
<h1>Página Inicial 
</h1>
