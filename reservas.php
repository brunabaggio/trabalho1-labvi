<?php
    require_once('conexao.php');

    if (isset($_POST['numquarto']) && $_POST['numquarto'] != "") {
        $numquarto = $_POST['numquarto'];
        $sql = " select valordiaria from quartos where id = " . $id .  "";
        $resultado = mysqli_query($conexao, $sql);
        $dados = mysqli_fetch_array($resultado);
        $valordiaria = $dados['valordiaria'];
    }

    if (isset($_POST['idcliente']) && $_POST['idcliente'] != "") {
        $id = $_POST['id'];
        $idcliente = $_POST['idcliente'];
        $dtentrada = $_POST['dtentrada'];
        $dtsaida = $_POST['dtsaida'];
        $tempoestadia = strtotime($dtsaida) - strtotime($dtentrada);
        $dias = floor($tempoestadia / (60 * 60 * 24));

        $valorreserva = $dias * $valordiaria;
        $statusreserva = $_POST['statusreserva'];
        $datahorastatus = date('Y/m/d H:i');

        if ($id == "") {
            $sql = "insert into reservas (numquarto, idcliente, dtentrada, dtsaida, valorreserva, statusreserva, datahorastatus )
                    values ('$numquarto', '$idcliente', '$dtentrada', '$dtsaida', '$valorreserva', '$statusreserva', '$datahorastatus')
                ";
        } else {
            $sql = "update reservas set numquarto = 'numquarto', idcliente = '$idcliente', dtentrada = '$dtentrada', dtsaida = '$dtsaida', valorreserva = '$valorreserva', statusreserva = '$statusreserva', datahorastatus = '$datahorastatus'
                where id = " . $id;
        }

        $resultado = mysqli_query($conexao, $sql);

        if ($resultado && $id == "") {
            $_GET['msg'] = 'Dados inseridos com sucesso';
            $_POST = null;
        } elseif ($resultado && $id != "") {
            $_GET['msg'] = 'Dados alterados com sucesso';
            $_POST = null;
        } elseif (!$resultado) {
            $_GET['msg'] = 'Falha ao inserir a mensagem';
        }
    }

    if (isset($_GET['msg']) && $_GET['msg'] != "") {
        echo $_GET['msg'];
    }
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Recanto do Sossego</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
	<h2 align=center>Reservas:</h2>

	<table border=1 width=80% align=center>
		<tr>
			<td><label for="numquarto">Número do quarto:</label></td>
			<td><label for="nome">Nome do cliente:</label></td>
			<td><label for="dtentrada">Data de Entrada:</label></td>
			<td><label for="dtsaida">Data de Saída:</label></td>
			<td><label for="valorreserva">Valor da Reserva:</label></td>
			<td><label for="statusreserva">Status da Reserva:</label></td>
			<td><label for="datahorastatus">Data/Hora Status da Reserva:</label></td>
		</tr>

		<?php
		$sql = "select r.*, q.porta, c.nome from reservas as r left join quartos as q on r.id = q.id left join clientes as c on r.id = c.id";
		$resultado = mysqli_query($conexao, $sql);

		while ($dados = mysqli_fetch_array($resultado)) {
			echo '<tr><td>' . $dados['porta'] . '</td>
				  <td>' . $dados['nome'] . '</td>
				  <td>' . $dados['dtentrada'] . '</td>        
					<td>' . $dados['dtsaida'] . '</td>
					<td>' . $dados['valorreserva'] . '</td>
					<td>' . $dados['statusreserva'] . '</td>
					<td>' . $dados['datahorastatus'] . '</td>
				  <td>
					<a href="form_reservas.php?id=' . $dados['id'] . '">Alterar</a>
				  </td></tr>';
		}
		mysqli_close($conexao);
		?>
	</table>
</body>

</html>