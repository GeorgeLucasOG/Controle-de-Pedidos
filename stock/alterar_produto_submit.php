<?php

	include 'banco-produto.php';

	session_start();

	if(empty($_SESSION['nome'])) {
	    echo "<script language=javascript>alert( 'Acesso Bloqueado!' );</script>";
	    echo "<script language=javascript>window.location.replace('../../index.html');</script>";
	}
	else
	{
            $id = isset($_POST['id'])?$_POST['id']:"-1";
			$nome = isset($_POST['nome'])?$_POST['nome']:"[Invalido]";
            $preco = isset($_POST['preco'])?$_POST['preco']:"[Invalido]";
            $quantidade = isset($_POST['qtd'])?$_POST['qtd']:"[Invalido]";
            $unidade = isset($_POST['unidade'])?$_POST['unidade']:"[Invalido]";

			$nome = trim(strtolower($nome));

            //entre '' os nomes das colunas na tabelas do banco
            $dados = array('id' => $id, 'nome' => $nome, 'preco' => $preco, 'quantidade' => $quantidade, 'medida' => $unidade);
            
            $status = alterar_produto($dados);

            if($status)
            {
                echo "<script language=javascript>alert( 'Atualização Realizado com Sucesso!' );</script>";
                echo "<script language=javascript>window.location.replace('../../stock/alterar_produto.php');</script>";
            }

	}

?>