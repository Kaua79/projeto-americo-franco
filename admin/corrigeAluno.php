<?php require('conexao.php')?>

<?php 
//recebe os parâmetros passados pela url
$id = $_GET['id'];

//conecta o Banco de Dados
$objDB = new db();
$link = $objDB->conectaMySQL();

$query = "SELECT * FROM aluno WHERE id = '$id'";
$consulta = mysqli_query($link,$query);

while ($aluno = mysqli_fetch_assoc($consulta)){
    echo "<form action='updateAluno.php' method='post'>";
    echo "Nome Completo : <input type='text' name='nome' value='".$aluno['nome']."'><br/>";
    echo "CPF : <input type='text' name='cpf' value='".$aluno['cpf']."'><br/>";
    echo "Sala : <input type='text' name='sala' value='".$aluno['sala']."'><br/>";
    echo "RA : <input type='text' name='ra' value='".$aluno['ra']."'><br/>";
    echo "Telefone : <input type='text' name='telefone' value='".$aluno['telefone']."'><br/>";
    echo "Edereço : <input type='text' name='endereco' value='".$aluno['endereco']."'><br/>";
    echo "<input type='hidden' name='id' value='".$aluno['id']."'><br/>";
    echo "<input type='submit' value='Atualizar Informações'><br/>";
    echo "</form>";
}

?>