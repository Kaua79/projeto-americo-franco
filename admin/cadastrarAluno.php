<?php require ('conexao.php'); ?>
<?php
    //Recebe os dados do Usuário
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];
    $telefone = $_POST["telefone"];
    $ra = $_POST["ra"];

    //Conecta com o Banco
    $objDB = new db();
    $link = $objDB->conectaMySQL();

    //Verificar se já existe um aluno com esses dados

    $consulta = "SELECT * FROM alunos WHERE cpf = '$cpf' OR ra = '$ra'";

    $selecao = mysqli_query($link,$consulta);

    if (mysqli_num_rows($selecao) > 0) {
        echo '<script>alert("Já Existe um Aluno Cadastrado com esse RA ou CPF");</script>';
        echo '<meta http-equiv="refresh" content="0";url="">';
        return false;
    }

    //Caso Não Haja, realizar o cadastro
    else {
        $query =  "INSERT INTO alunos(nome,cpf,telefone,endereco,ra) VALUES ('$nome','$cpf','$endereco','$telefone','$ra')";
        $cadastro = mysqli_query($link,$query);

        if ($cadastro) {
            echo '<script>alert("Aluno Cadastrado com Sucesso");</script>'; 
            echo "<meta http-equiv='refresh' content='0;url=../index.php'>";
        }

        else {
            echo '<script>alert("Ocorreu um Problema , Tente Novamente Mais Tarde");</script>'; 
            echo "<meta http-equiv='refresh' content='0;url=../index.php'>";
        }
    }

?>