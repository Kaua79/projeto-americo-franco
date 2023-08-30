<?php

    class db{
        private $host = "localhost";

        private $usuario = "root";

        private $senha = "";

        private $database ="americofranco";

        public function conectaMySQL(){
            $conexao = mysqli_connect($this->host,$this->usuario,$this->senha,$this->database);

            mysqli_set_charset(
                $conexao, 'UTF8'
            );
            return $conexao;
        }
    }

?>