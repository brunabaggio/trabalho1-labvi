<?php
	require_once('conexao.php');
	
	$idclient = $_GET['idclient'];
	
	if($id != ""){
		
		$sql = "delete from clientes where idclient = ".$idclient;
		$resultado = mysqli_query($conexao, $sql);
		if($resultado){
			$msg = "Dados excluidos com sucesso!";
		}
		echo "<script>window.location.href='clientes.php?msg=$msg';</script>";
		
	}
	
?>