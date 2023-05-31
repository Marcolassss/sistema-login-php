<?php
//Conexão
require_once'db_connect.php';
//sessão
session_start();
//DADOS DO USUÁRIO
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$resultado= mysqli_query($connect,$sql);
$dados = mysqli_fetch_array($resultado);
mysqli_close($connect);
//VERIFICAÇÃO
//SE NAO EXISTIR A SESSAO LOGADO:
if (!isset($_SESSION['logado'])){
    #REDIRECIONE PARA O INDEX.PHP, POIS NAO FOI EFETUADO O LOGIN PELO USUARIOO;
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina restrita</title>

</head>
<body>
    <?php echo "<h1>Olá, ". $dados['nome']."</h1>";?>
    <a href="logout.php">Sair</a>
</body>
</html>