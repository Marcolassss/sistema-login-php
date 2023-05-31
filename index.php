<!DOCTYPE html>
<?php
//Conexão
require_once'db_connect.php';
//sessão
session_start();
//Página de Login
//BOTAO ENVIAR;
if(isset($_POST['btn-entrar'])){
    $erros = array();
    //mysqliScape é utilizado para filtrar as strings que vao ser passadas no Login;
    $login = mysqli_escape_string($connect,$_POST['login']);
    $senha = mysqli_escape_string($connect,$_POST['senha']);
    //se login ou senha estiver vazio, faça:
    if(empty($login) or empty($senha)){
        //exibe mensagem de que os campos precisam ser preenchidos.
        $erros[] = "<li>O campo Login/Senha precisa ser preenchido.</li>";
    }else{
        $sql = "SELECT login FROM usuarios WHERE login = '$login' ";
        $resultado = mysqli_query($connect,$sql);
            if(mysqli_num_rows($resultado)>0){
                //o resultado da consulta do sql vai ser atribuido a variavel resultado;
                $senha = md5($senha);
                $sql =  "SELECT * FROM usuarios WHERE login= '$login' AND senha = '$senha'";
                $resultado = mysqli_query($connect, $sql);
                //se foi consultado e os dados conferem com os que estao no banco de dados sera igual a 1
                //pois, o login e senha passado pelo usuario estao corretos
                if(mysqli_num_rows($resultado)==1){
                    $dados = mysqli_fetch_array($resultado);
                    mysqli_close($connect);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];
                    header('location: home.php');
                }else{
                    $erros[]= "<li>Usuario e senha nao conferem</li>";
                }
            }else{
                $erros[]="<li>Usuário não encontrado</li>";
            }
    }
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleindex2.css">
    <title>Login</title>
</head>
<body>
<div class="card">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <div class="conteudo">
    <h1>Login</h1>
    <hr>
    <?php
    //se $erros nao estiver vazio significa que contem erros, logo, exibimos na tela;
    if(!empty($erros)){
        //para cada erro vai ser atribuido $erro
        foreach($erros as $erro){
            echo $erro;
        }
    }  
?>

        <!--SUPER GLOBAL SENDO UTILIZADA PARA ESCREVER INDEX.PHP-->
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    Login<br>
     <input type="text" name="login">
    <br>
    Senha </br>
    <input type="password" name="senha">
    <br>
    <button type="submit" name="btn-entrar">Entrar</button>
    </form>
    </div>
</div>

</body>
</html>
