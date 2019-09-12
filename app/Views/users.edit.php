<h1>Editar</h1>
 
 
 
<form action="/BkconnectDoctor/edit" method="post">
  <div class="form-group">
    <label for="nome">Nome Completo</label>
    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $_SESSION['nome']; ?>">
    


    <label for="cpf">CPF</label>
    <input type="number" class="form-control" id="cpf" name="cpf" value="<?php echo $_SESSION['cpf']; ?>">

    <label for="usuario">Usuário</label>
    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $_SESSION['usuario']; ?>">
    
    <label for="email">Endereço de email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">

    <label for="categoria">Categoria</label>
    <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $_SESSION['categoria']; ?>">
    
  </div>
  <div class="form-group">
    <label for="senha">Senha</label>
    <input type="password" class="form-control" name="senha" id="senha" value="<?php echo $_SESSION['senha']; ?>">
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>