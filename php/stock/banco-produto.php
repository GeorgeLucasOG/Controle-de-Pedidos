<?php

@include '../banco-acesso.php';

//$acessodb = 'php/stock/banco-acesso.php';
//$produtodb = 'php/stock/banco-produto.php';
//include ($acessodb);
//include ($acessodb);

/**
 * Funções de Acesso ao BD Relacionadas aos Ingredientes
 */
function cadastro_ingrediente($dados) 				
{

	try{
        $PDO = conectar();
        $sql = "INSERT INTO ingrediente (nome, quantidade, unidade) VALUES ( :nome, :quantidade, :unidade)";
        $exec = $PDO->prepare($sql)->execute($dados);

        if($exec)
            return true;
        else
            return false;

	   }catch(PDOException $i){
	       echo $i->getMessage();
	       return false;
	   }
}

function verifica_existe_ingrediente($nome)					
{
	$PDO = conectar();

	if($PDO)
	{
		$sql = "select * from ingrediente WHERE nome LIKE '".$nome."'";
		$result = $PDO->query( $sql );
		$rows = $result->fetchAll( PDO::FETCH_ASSOC );
		if(count($rows) == 0)
			return false;
		else
			return true;
	}
	else
	{
		return false;
	}
}

function remover_ingrediente($id)
{
	try{
		$PDO = conectar();
		$sql = "DELETE FROM ingrediente WHERE id = :id";
		$exec = $PDO->prepare($sql);
		$exec->bindParam( ':id', $id );
		$exec->execute();

   }catch(PDOException $i){
       echo $i->getMessage();
   }
}

function alterar_ingrediente($dados)
{
    try{

		$PDO = conectar();
		$sql = "UPDATE ingrediente SET nome=:nome, quantidade=:quantidade, unidade=:unidade WHERE id=:id";

		$exec = $PDO->prepare($sql)->execute($dados);

		if($exec)
			return true;
		else
			return false;
	
   }catch(PDOException $i){
       echo $i->getMessage();
       return false;
   }

}

function listar_tabela_ingrediente()
{
	try{
		$PDO = conectar();
		$sql = "SELECT id, nome, quantidade, unidade FROM ingrediente ORDER BY nome";
	
		$result = $PDO->query( $sql );
		$rows = $result->fetchAll( PDO::FETCH_ASSOC );
		return $rows;

   }catch(PDOException $i){
       echo "Erro: ".$i->getMessage();
       return NULL;
   }
}


/**
 * Funções de Acesso ao BD Relacionadas aos Pedidos
 */

function cadastrar_pedidos($dados) 				
{

	try{
        $PDO = conectar();
        $sql = "INSERT INTO estoque (dataHora, id_cliente, id_estoque) VALUES ( :dataHora, :id_cliente, :id_estoque)";
        $exec = $PDO->prepare($sql)->execute($dados);

        if($exec)
            return true;
        else
            return false;

	   }catch(PDOException $i){
	       echo $i->getMessage();
	       return false;
	   }
}

/**
 * Funções de Acesso ao BD Relacionadas aos Produtos
 */

function cadastrar_produto($dados) 				
{

	try{
        $PDO = conectar();
        $sql = "INSERT INTO estoque (nome, preco, quantidade, medida) VALUES ( :nome, :preco, :qtd, :medida)";
        $exec = $PDO->prepare($sql)->execute($dados);

        if($exec)
            return true;
        else
            return false;

	   }catch(PDOException $i){
	       echo $i->getMessage();
	       return false;
	   }
}

function verifica_existe_produto($nome)					
{
	$PDO = conectar();

	if($PDO)
	{
		$sql = "select * from estoque WHERE nome LIKE '".$nome."'";
		$result = $PDO->query( $sql );
		$rows = $result->fetchAll( PDO::FETCH_ASSOC );
		if(count($rows) == 0)
			return false;
		else
			return true;
	}
	else
	{
		return false;
	}
}

function remover_produto($id)
{
	try{
		$PDO = conectar();
		$sql = "DELETE FROM estoque WHERE id = :id";
		$exec = $PDO->prepare($sql);
		$exec->bindParam( ':id', $id );
		$exec->execute();

   }catch(PDOException $i){
       echo $i->getMessage();
   }
}

function alterar_produto($dados)
{
    try{

		$PDO = conectar();
		//entre '' os nomes das colunas na tabelas do banco
		$sql = "UPDATE estoque SET nome=:nome, preco=:preco, quantidade=:quantidade, medida=:medida WHERE id=:id";

		$exec = $PDO->prepare($sql)->execute($dados);

		if($exec)
			return true;
		else
			return false;
	
   }catch(PDOException $i){
       echo $i->getMessage();
       return false;
   }

}

function listar_tabela_produto()
{
	try{
		$PDO = conectar();
		$sql = "SELECT * FROM estoque ORDER BY id";
	
		$result = $PDO->query( $sql );
		$rows = $result->fetchAll( PDO::FETCH_ASSOC );
		return $rows;

   }catch(PDOException $i){
       echo "Erro: ".$i->getMessage();
       return NULL;
   }
}

function imprime_produto_nome($nome)
{
	try{

		$PDO = conectar();

		if($PDO)
		{
			$sql = "SELECT id, nome, preco, quantidade, medida FROM estoque WHERE nome LIKE '%".$nome."%' ORDER BY nome";
			$result = $PDO->query( $sql );
			$rows = $result->fetchAll( PDO::FETCH_ASSOC );
			return $rows;
		}
		else
		{
			echo "Erro ao conectar ao banco de dados!<br/>";
			return NULL;
		}
		

   }catch(PDOException $i){
       echo $i->getMessage();
       return NULL;
   }
}
 
?>