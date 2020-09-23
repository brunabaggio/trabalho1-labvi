<?php

	require_once('conexao.php');

	if (isset($_POST['nome']) && $_POST['nome'] != "") {

		$idcliente = $_POST['idcliente'];
		$nome = $_POST['nome'];
		$documento = $_POST['documento'];
		$datanascimento = $_POST['datanascimento'];
		$cidade = $_POST['cidade'];
		$estado = $_POST['estado'];

		if ($idcliente == "") {
			$sql = "insert into clientes (nome, documento, datanascimento, cidade, estado)
					values ('$nomecliente', '$documento', '$datanascimento', '$cidade', '$estado')";
		} else {
			$sql = "update clientes set nome = '$nomecliente', documento = '$documento', datanascimento = '$datanascimento', cidade = '$cidade', estado = '$estado' 
				where id = " . $idcliente;
		}

		$resultado = mysqli_query($conexao, $sql);

		if ($resultado && $idcliente == "") {
			$_GET['msg'] = 'Dados inseridos com sucesso';
			$_POST = null;
		} elseif ($resultado && $idcliente != "") {
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
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
	<h2 align=center>Clientes</h2>

	<table border=1 width=80% align=center>
	<thead class=".thead-dark">
		<tr>
			<td><label for="nome">Nome do Cliente:</label></td>
			<td><label for="documento">Documento:</label></td>
			<td><label for="datanascimento">Data de Nascimento:</label></td>
			<td><label for="cidade">Cidade:</label></td>
			<td><label for="estado">Estado:</label></td>
		</tr>


		<?php
		$sql = "select idcliente, nome, documento, datanascimento, cidade, estado from clientes";
		$resultado = mysqli_query($conexao, $sql);

		while ($dados = mysqli_fetch_array($resultado)) {
			echo '<tr><td>' . $dados['nome'] . '</td>
				  <td>' . $dados['documento'] . '</td>
				  <td>' . $dados['datanascimento'] . '</td>        
          <td>' . $dados['cidade'] . '</td>
          <td>' . $dados['estado'] . '</td>
				  <td>
					<a href="remover_clientes.php?id=' . $dados['idcliente'] . '">Excluir</a>
					<a href="form_cliente.php?id=' . $dados['idcliente'] . '">Editar</a>
				  </td></tr>';
		}

		mysqli_close($conexao);

		?>

	</table>
</body>

</html>