<?php
//CONEXÃO COM O BANCO DE DADOS;
//NOME DO NOSSO SERVIDOR;
$servername="localhost";
//NOME ESCOLHIDO NO MYADMIN;
$username="root";
//ESSE CAMPO ESTA VAZIO PQ NAO HÁ SENHA;
$password="";
//NOME DO NOSSO BANCO DE DADOS;
$db_name="sistemalogin";


$connect = mysqli_connect($servername,$username,$password,$db_name);
    if(mysqli_connect_error()){
        echo "Falha na conexão".mysqli_connect_error();
    }

?>