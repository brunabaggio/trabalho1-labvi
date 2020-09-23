<?php
    require_once('conexao.php');

    $numquarto = '';
    $idcliente = '';
    $dtentrada = '';
    $dtsaida = '';
    $valorreserva = '';
    $statusreserva = '';
    $id = '';

    if (isset($_GET['id']) && $_GET['id'] != "") {
        $sql = "select * from reservas where id = " . $_GET['id'];
        $resultado = mysqli_query($conexao, $sql);
        if ($resultado) {
            $dados = mysqli_fetch_array($resultado);
            $numquarto = $dados['numquarto'];
            $idcliente = $dados['idcliente'];
            $dtentrada = $dados['dtentrada'];
            $dtsaida = $dados['dtsaida'];
            $valorreserva = $dados['valorreserva'];
            $statusreserva = $dados['statusreserva'];
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
      <form class="formulario" method="post" action="reservas.php" align=left>
        <p>Fazer reserva</p>

        <input type="hidden" name="id" value="<?= $id; ?>">

        <div class="field">
          <label for="numquarto">Número do Quarto:</label>
          <select name="numquarto" id="numquarto">
            <?php
            $sql = "select id, porta, valordiaria, status from quartos ";
            $resultado = mysqli_query($conexao, $sql);
            while ($dados = mysqli_fetch_array($resultado)) {
              if ($dados['status'] == 'livre' || $dados['status'] == 'Livre') {
                $num_porta = $dados['porta'];
                echo "<option value=" . $dados['id'] . ">" . $num_porta . "</option>";
              ?>
          </select>
        </div>

        <div class="field">
          <label for="idcliente">Nome:</label>
          <select name="idcliente" id="idcliente">
            <?php
            $sql = "select id, nome from clientes ";
            $resultado = mysqli_query($conexao, $sql);
            while ($dados = mysqli_fetch_array($resultado)){
              $nome = $dados['nome'];
              echo "<option value=" . $dados['id'] . ">" . $nome . "</option>";
            }
            ?>
          </select>
        </div>

        <div class="field">
          <label for="dtentrada">Data de Entrada:</label>
          <input type="date" id="dtentrada" name="dtentrada" value="<?= $dtentrada; ?>" placeholder="Entrada*" required>
        </div>
        <div class="field">
          <label for="dtsaida">Data de Saída:</label>
          <input type="date" id="dtsaida" name="dtsaida" value="<?= $dtsaida; ?>" placeholder="Saída*" required>
        </div>
        <div class="field">
          <label for="statusreserva">Status da Reserva:</label>
          <input type="text" id="statusreserva" name="statusreserva" value="<?= $statusreserva; ?>" placeholder="Status da reserva*" required>
        </div>
        <input type="submit" name="reservas" value="Enviar">
      </form>

    </div>
    
  </body>
</html>