<?php

    require_once('conexao.php');

    $porta = '';
    $tipo = '';
    $valordiaria = '';
    $status = '';
    $id = '';

    if (isset($_GET['id']) && $_GET['id'] != "") {
        $sql = "select * from quartos where id = " . $_GET['id'];
        $resultado = mysqli_query($conexao, $sql);
        
        if ($resultado) {
            $dados = mysqli_fetch_array($resultado);
            $porta = $dados['porta'];
            $tipo = $dados['tipo'];
            $valordiaria = $dados['valordiaria'];
            $status = $dados['status'];
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
      <form class="formulario" method="post" action="quartos.php" align=left>
        <p>Selecionar quarto</p>

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="field">
          <label for="porta">Número da Porta:</label>
          <input type="text" id="porta" name="porta" value="<?php echo $porta; ?>" placeholder="Porta*" required>
        </div>

        <div class="field">
          <label for="tipo">Tipo do Quarto:</label>
          <input type="text" id="tipo" name="tipo" value="<?php echo $tipo; ?>" placeholder="Tipo do quarto*">
        </div>

        <div class="field">
          <label for="valordiaria">Valor da Diária:</label>
          <input type="text" id="valordiaria" name="valordiaria" value="<?php echo $valordiaria; ?>" placeholder="Valor da diária*" required>
        </div>
        <div class="field">
          <label for="status">Status Quarto:</label>
          <input type="text" id="status" name="status" value="<?php echo $status; ?>" placeholder="Status do quarto*">
        </div>

        <input type="submit" name="quartos" value="Enviar">
      </form>
    </div>
  </body>
</html>