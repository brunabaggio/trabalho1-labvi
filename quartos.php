<?php

require_once('conexao.php');

if (isset($_POST['porta']) && $_POST['porta'] != "") {

	$id = $_POST['id'];
	$porta = $_POST['porta'];
	$tipo = $_POST['tipo'];
	$valordiaria = $_POST['valordiaria'];
	$status = $_POST['status'];

	if ($id == "") {
		$sql = "insert into quartos (porta, tipo, valordiaria, status)
                values ('$porta', '$tipo', '$valordiaria', '$status')";
	} else {
		$sql = "update quartos set porta = '$porta', tipo = '$tipo', valordiaria = '$valordiaria', status = '$status'
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
	<title>REcanto do Sossego</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
	<h2 align=center>Quartos</h2>

	<table border=1 width=80% align=center>
		<tr>
			<td><label for="porta">Numero do Quarto:</label></td>
			<td><label for="tipo">Tipo do Quarto:</label></td>
			<td><label for="valordiaria">Valor da Diária:</label></td>
			<td><label for="status">Status:</label></td>
		</tr>


		<?php
            $sql = "select id, porta, tipo, valordiaria, status from quartos ";
            $resultado = mysqli_query($conexao, $sql);

            while ($dados = mysqli_fetch_array($resultado)) {
                echo '<tr><td>' . $dados['porta'] . '</td>
                    <td>' . $dados['tipo'] . '</td>
                    <td>' . $dados['valordiaria'] . '</td>        
                    <td>' . $dados['status'] . '</td>
                    <td>
                        <a href="remover_quartos.php?id=' . $dados['id'] . '">Excluir</a>
                        <a href="form_quartos.php?id=' . $dados['id'] . '">Editar</a>
                    </td></tr>';
            }
            mysqli_close($conexao);
		?>

	</table>
</body>

</html>