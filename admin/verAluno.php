<?php require ('conexao.php')?>

<?php

$id = $_GET['id'];

//Conecta com o Banco de Dados
$objDB = new db();
$link = $objDB->conectaMySQL();

//Busca os Dados no Banco conforme o Id Passado pela URL

$query = "SELECT * FROM aluno WHERE id = '$id'";
$consulta = mysqli_query($link,$query);
$aluno = mysqli_fetch_assoc($consulta);

//exibe os dados

echo "Nome : ".$aluno['nome']."<br/>";
echo "Sala : ".$aluno['sala']."<br/>";
echo "CPF : ".$aluno['cpf']."<br/>";
echo "RA : ".$aluno['ra']."<br/>";
echo "Endereço : ".$aluno['endereco']."<br/>";
echo "Telefone : ".$aluno['telefone']."<br/>";
echo "Ação : <a href='corrigeAluno.php?id=". $aluno['id']. "'> Atualizar Informações </a>";


?>