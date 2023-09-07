<?php require('conexao.php') ?>

<?php 
$arquivo = $_FILES ['arquivo'] ['name'];

//pasta onde o arquivo vai ficar salvo
$_UP['pasta'] = 'foto/'; 

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
    echo "
    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/projeto-americo-franco/index.html'>
    <script type=\"text/javascript\">
        alert(\"A imagem não foi cadastrada , extensão invalida.\");
    </script>
    ";
}

//faz a verificação do tamanho do arquivo
else if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
    echo "
    <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/projeto-americo-franco/index.html'>
    <script type=\"text/javascript\">
        alert(\"Arquivo muito grande.\");
    </script>
    ";
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
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/projeto-americo-franco/index.html'>
        <script type=\"text/javascript\">
            alert(\"Imagem cadastrada com sucesso.\");
        </script>
        ";
    }else{
        //Upload não realizado com sucesso, exibe a imagem 
        echo"
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/projeto-americo-franco/index.html'>
        <script type=\"text/javascript\">
            alert(\"Imagem não foi cadastrada com sucesso.\");
        </script>
        ";
    }
}

?>

<html>
<form method="POST" action="admin/cadastrarAluno.php" enctype="multipart/form-data">
        Imagem do Aluno <input name="arquivo" type="file">
        <input type="submit" value="Enviar">

    </form>
</html>
