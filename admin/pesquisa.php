<?php
    
    $host = "localhost";

    $usuario = "root";

    $senha = "";
    
    $database = "americofranco";


    //Criar a conexao
    $conexao = mysqli_connect($host, $usuario, $senha, $database);
    
    $pesquisar = $_POST['pesquisar'];
    $result_pesquisa = "SELECT * FROM alunos WHERE nome LIKE '%$pesquisar%' LIMIT 5";
    $resultado_pesquisa = mysqli_query($conexao, $result_pesquisa);
    
    while($rows_tabela = mysqli_fetch_array($resultado_pesquisa)){
        echo "Aluno : ".$rows_tabela['nome']."<br>";
    }
?>