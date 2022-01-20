<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Imagens e Detalhes Produto</title>
	</head>
	<body>
		<?php

			function convertedata($data){
				$data_vetor = explode('-', $data);
				$novadata = implode('/', array_reverse ($data_vetor));
				return $novadata;
			}

			include_once('conexao.php');
			// recuperando a informação da URL
			// verifica se parâmetro está correto e dento da normalidade 
			if(isset($_GET['id']) && is_numeric(base64_decode($_GET['id']))){
					$id = base64_decode($_GET['id']);
			} else {
				header('Location: index.php');
			}
			// realizando a pesquisa com o id recebido
			$query = mysqli_query($conexao,"select * from tabelaimg where id = $id");

			if (!$query) {
				die('Query Inválida: ' . @mysqli_error($conexao));  
			}

			$dados=mysqli_fetch_array($query);
			
			echo "<table boreder='1px'><tr><td width='250px'>";
			if (empty($dados['imagem'])){
					$imagem = 'SemImagem.png';
				}else{
					$imagem = $dados['imagem'];
				}
			echo "<img src='imagens/$imagem' >";
			echo "</td><td width='400px'>";
			echo "<b>Data: </b>".convertedata($dados['data'])."<br><br>";	
			echo "<b>Id: </b>".$dados['id']."<br>";
			echo "<b>Codigo: </b>".$dados['codigo']."<br>";
			echo "<b>Produto: </b>".$dados['produto']."<br>";	
			echo "<b>Descrição: </b>".$dados['descricao']."<br>";	
			echo "<b>Valor: </b> R$ ".$dados['valor']."<br>";
			echo "</td></tr></table>";
			
			mysqli_close($conexao);
		?>
		<br>
		<a href="javascript:window.history.go(-1)">Voltar</a>

	</body>
</html>