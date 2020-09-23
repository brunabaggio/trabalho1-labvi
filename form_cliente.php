<?php

  require_once('conexao.php');

  $nome = '';
  $documento = '';
  $datanascimento = '';
  $cidade = '';
  $estado = '';
  $id = '';

  if (isset($_GET['id']) && $_GET['id'] != "") {
    $sql = "select * from clientes where id = " . $_GET['id'];
    $resultado = mysqli_query($conexao, $sql);
    if ($resultado) {
      $dados = mysqli_fetch_array($resultado);
      $nome = $dados['nome'];
      $documento = $dados['documento'];
      $datanascimento = $dados['datanascimento'];
      $cidade = $dados['cidade'];
      $estado = $dados['estado'];
      $id = $dados['id'];
    }
  }

  ?>


  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <title>Formulário</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="estilo.css">
  </head>

  <body>
    <div width=60% align=center>
      <form class="formulario" method="post" action="clientes.php" align=left>
        <p>  Informações do Cliente</p>
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="field">
          <label for="nome">Nome do Cliente:</label>
          <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" placeholder="Digite o nome completo*" required>
        </div>

        <div class="field">
          <label for="documento">Documento:</label>
          <input type="text" id="documento" name="documento" value="<?php echo $documento; ?>" placeholder="Digite o numero do documento CPF/RG*">
        </div>

        <div class="field">
          <label for="datanascimento">Data de Nascimento:</label>
          <input type="date" id="datanascimento" name="datanascimento" value="<?php echo $datnascimento; ?>" placeholder="Digite a data de nascimento*" required>
        </div>
        <div class="field">
          <label for="cidade">Cidade:</label>
          <input type="text" id="cidade" name="cidade" value="<?php echo $cidade; ?>" placeholder="Digite a vidade*">
        </div>
        <div class="field">
          <label for="estado">Estado:</label>
          <input type="text" id="estado" name="estado" value="<?php echo $estado; ?>" placeholder="Digite o estado*">
        </div>

        <input type="submit" class="btn"  name="clientes" value="Enviar">
      </form>
    </div>
  </body>

</html>