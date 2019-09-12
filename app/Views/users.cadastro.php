<h1>Cadastro</h1>
 
 
 
<form action="cadastrar" method="post">
  <div class="form-group">
    <label for="nome">Nome Completo</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome">


    <label for="cpf">CPF</label>
    <input type="number" class="form-control" id="cpf" name="cpf" placeholder="Seu CPF">

    <label for="usuario">Usuário</label>
    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Seu Usuário">
    
    <label for="email">Endereço de email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Seu email">

    <label for="categoria">Categoria</label>
    <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Sua categoria">
    
  </div>
  <div class="form-group">
    <label for="senha">Senha</label>
    <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha">
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>