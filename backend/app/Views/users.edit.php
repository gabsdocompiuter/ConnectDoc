<h1>Editar</h1>
 
 
 
<form action="/BkconnectDoctor/edit" method="post">
  <div class="form-group">
    <label for="nome">Nome Completo</label>
    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $_SESSION['nome']; ?>">

    <label for="usuario">Usuário</label>
    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $_SESSION['usuario']; ?>">
    
    <label for="email">Endereço de email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">

    <label for="tipo">Tipo</label>
    <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $_SESSION['tipo']; ?>">

    <label for="telefone">Telefone</label>
    <input type="number" class="form-control" id="telefone" name="telefone" value="<?php echo $_SESSION['telefone']; ?>">
    
  </div>
  <div class="form-group">
    <label for="senha">Senha</label>
    <input type="password" class="form-control" name="senha" id="senha" value="<?php echo $_SESSION['senha']; ?>">
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>