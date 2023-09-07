<?php require('conexao.php');?>

<?php
    $pesquisa = $_POST["pesquisa"];

    //Conecta com o Banco
    $objDB = new db();
    $link = $objDB->conectaMySQL();

    //Realiza a Pesquisa   
    $query = "SELECT * FROM aluno WHERE nome LIKE '$pesquisa' OR ra LIKE '$pesquisa' OR sala LIKE '$pesquisa'";
    
    $resultadoPesquisa = mysqli_query($link,$query);

    if (mysqli_num_rows($resultadoPesquisa) == 0) {
        echo "Nenhum Aluno Cadastrado"; 
    }

    while ($rowsTabela = mysqli_fetch_array($resultadoPesquisa)) {
        echo "Aluno : ".$rowsTabela['nome']."<br>";
        echo "Sala : ".$rowsTabela['sala']."<br>";
        echo "CPF : ".$rowsTabela['cpf']."<br>";
        echo "Endereço : ".$rowsTabela['endereco']."<br>";
        echo "Telefone : ".$rowsTabela['telefone']."<br>";
        echo "RA : ".$rowsTabela['ra']."<br>";
        echo "Ação : <a href='verAluno.php?id=" . $rowsTabela['id'] . "'> Visualizar Informações </a>";
        echo "<hr/>";

    }
?>