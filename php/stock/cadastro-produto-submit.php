<?php

	include 'banco-produto.php';

	session_start();

	if(empty($_SESSION['nome'])) {
	    echo "<script language=javascript>alert( 'Acesso Bloqueado!' );</script>";
	    echo "<script language=javascript>window.location.replace('../../index.html');</script>";
	}
	else
	{
			$nome = isset($_POST['nome'])?$_POST['nome']:"[Invalido]";
            $preco = isset($_POST['preco'])?$_POST['preco']:"[Invalido]";
			$qtd = isset($_POST['qtd'])?$_POST['qtd']:"[Invalido]";
			$unidade = isset($_POST['medida'])?$_POST['medida']:"[Invalido]";

			$nome = trim(strtolower($nome));

            $dados = array('nome' => $nome, 'preco' => $preco, 'qtd' => $qtd, 'medida' => $unidade);
			
			if(!verifica_existe_produto($nome))
			{
				$status = cadastrar_produto($dados);

				if($status)
				{
					echo "<script language=javascript>alert( 'Cadastro Realizado com Sucesso!' );</script>";
					echo "<script language=javascript>window.location.replace('../../stock/cadastrar_produto.php');</script>";
				}

			}
			else
			{
				echo "<script language=javascript>alert( 'Erro ao realizar cadastro! Nome já Cadastrado!!!' );</script>";
					echo "<script language=javascript>window.location.replace('../../stock/cadastrar_produto.php');</script>";
			}

	}

?>
