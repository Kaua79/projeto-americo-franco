<?php require('conexao.php');?>

<?php
    $objDB = new db();
    $link = $objDB->conectaMySQL();
    
    $query = "SELECT * FROM aluno";
    $listaAlunos = mysqli_query($link,$query);

    if (mysqli_num_rows($listaAlunos) == 0) {
        echo "Nenhum Aluno Cadastrado"; 
    }

    while ($lista = mysqli_fetch_array($listaAlunos)) {
        echo "Aluno : ".$lista['nome']."<br>";
        echo "Sala : ".$lista['sala']."<br>";
        echo "CPF : ".$lista['cpf']."<br>";
        echo "Endereço : ".$lista['endereco']."<br>";
        echo "Telefone : ".$lista['telefone']."<br>";
        echo "RA : ".$lista['ra']."<br>";
        echo "Ação : <a href='verAluno.php?id=" . $lista['id'] . "'> Visualizar Informações </a>";
        echo "<hr/>";

    }
?>