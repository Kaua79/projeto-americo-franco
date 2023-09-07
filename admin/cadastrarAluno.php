<?php require ('conexao.php'); ?>
<?php
    //Recebe os dados do Usuário
    $nome = $_POST["nome"];
    $sala = $_POST["sala"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];
    $telefone = $_POST["telefone"];
    $ra = $_POST["ra"];

    //Conecta com o Banco
    $objDB = new db();
    $link = $objDB->conectaMySQL();

    //Verificar se já existe um aluno com esses dados
    $consulta = "SELECT * FROM aluno WHERE cpf = '$cpf' OR ra = '$ra'";
    $selecao = mysqli_query($link,$consulta);

    if (mysqli_num_rows($selecao) > 0) {
        echo '<script>alert("Já Existe um Aluno Cadastrado com esse RA ou CPF");</script>';
        echo '<script type="text/javascript">location.replace("../index.html");</script>';
        return false;
    }
    //Caso Não Haja, realizar o cadastro
    $query = "INSERT INTO aluno(nome,sala,cpf,telefone,endereco,ra) VALUES ('$nome','$sala','$cpf','$endereco','$telefone','$ra')";
    $cadastro = mysqli_query($link,$query);

        if ($cadastro) {
            echo '<script>alert("Aluno Cadastrado com Sucesso");</script>'; 
            echo '<script type="text/javascript">location.replace("../index.html");</script>';
        }

        else {
            echo '<script>alert("Ocorreu um Problema , Tente Novamente Mais Tarde");</script>'; 
            echo '<script type="text/javascript">location.replace("../index.html");</script>';
        }
?>
<?php
    //recebe os dados das imagens  
    $arquivo = $_POST ['arquivo'] ['name'];

    //pasta onde o arquivo vai ficar salvo
    $_UP['pasta'] = 'foto/imagens.jpg'; 

    //tamanho máximo do arquivo em Bytes
    $_UP['tamanho'] = 1024*1024*100; //5mb

    //array com as extensões permitidas
    $_UP['extensoes'] = array('png','jpg','jpeg');

    //renomear
    $_UP['renomear'] = false;


    //array com os tipos de erros de upload em php
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo é maior que o permitido pelo php';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

    //Verificar se houve algum erro com o upload. Se sim exibir a mensagem de erro
    if($_FILES['arquivo']['error'] != 0){
        die("Não foi possível fazer o upload , erro :". $_UP['erros'][$_FILES['arquivo']['error']]);
        exit;
    }

    //Faz a verificação da extensão do arquivo
    $extensao = strtolower(end(explode('.',$_FILES['arquivo']['name'])));
    if(array_search($extensao, $_UP['entensao']) === false ){
        echo '<script>alert("A imagem não foi cadastrada, extensão invalida");</script>'; 
        echo '<script type="text/javascript">location.replace("../index.html");</script>';
    }

    //faz a verificação do tamanho do arquivo
    else if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
        echo '<script>alert("arquivo muito grande");</script>'; 
        echo '<script type="text/javascript">location.replace("../index.html");</script>';
    }

    //o arquivo passou por todas as verificações ,hora de tentar mover para a pasta foto
    else{
        //Primeiro verificar se deve trocar o nome do arquivo
        if($_UP['renomear'] == true){
            //Cria um nome baseado no UNIX TIMESTAMP atual e com extensao em jpg
            $nome_final = time() . '.jpg';
        }else{
            //mantém o nome original do arquivo
            $nome_final = $_FILES['arquivo']['nome'];
        }
            //verificar se é possivel mover o arquivo para a pasta 
        if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)){
            //upload realizado com sucesso , exibe a imagem 
            $query = mysqli_query($conexao, "INSERT INTO usuario(
                 nome_imagem ) VALUES ('$nome_final')");
            echo '<script>alert("Imagem cadastrada com sucesso");</script>'; 
            echo '<script type="text/javascript">location.replace("../index.html");</script>';
        }else{
            //Upload não realizado com sucesso, exibe a imagem 
            echo '<script>alert("a imagem não foi cadastrada com sucesso");</script>'; 
            echo '<script type="text/javascript">location.replace("../index.html");</script>';
        }
    }

?>