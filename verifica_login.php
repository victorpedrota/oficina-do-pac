
<?php

$login = $_POST['c_login'];
$senha = $_POST['c_senha'];

require('connect.php');

$sql_pesquisa ="select * from `login` where `login` = '$login' && `senha` = '$senha'";
$resultado = mysqli_query($conn,$sql_pesquisa); 
$numero = mysqli_num_rows($resultado);
$vetor_login = mysqli_fetch_array($resultado);
$cod_login = $vetor_login['cod_login'];


if($numero != 1)
{
    echo "<div class='alert alert-danger' role='alert'>
    Usuario ou senha incorretos
    </div>";
}
else
{

    session_start();
    $_SESSION["system_control"] = 1;

    $_SESSION["cod_login"] = $vetor_login['cod_login'];
    $_SESSION["login"] = $vetor_login[ 'login'];
    $status = $_SESSION["system_control"];
    $_SESSION["privilegio"] = $vetor_login['privilegio'];
    if($status == 1)
    {                                              

     if($vetor_login['privilegio'] == 0){
         $cliente ="select * from `cliente` where `cod_login` = $cod_login";
         $resultado_cliente = mysqli_query($conn,$cliente);
         $vetor_cliente = mysqli_fetch_array($resultado_cliente);
         $_SESSION["cod_cliente"] = $vetor_cliente['cod_cliente'];
         $cliente ="select * from `login` where `cod_login` = $cod_login";
         $resultado_cliente = mysqli_query($conn,$cliente);
         $vetor_cliente = mysqli_fetch_array($resultado_cliente);


         $_SESSION["imagem"] = $vetor_cliente['imagem'];
         echo "<script>window.location.href = 'login.php';</script>";
         ?>

         <?php
     }
     else if ($vetor_login['privilegio'] == 1) {
        $cliente ="SELECT * from `mecanico` WHERE `cod_login` = $cod_login";
        $resultado_cliente = mysqli_query($conn,$cliente);
        $vetor = mysqli_fetch_array($resultado_cliente);
        $_SESSION["cod_oficina"] = $vetor['cod_oficina'];
        $_SESSION["cod_mecanico"] = $vetor['cod_mecanico'];
        $cliente ="select * from `login` where `cod_login` = $cod_login";
        $resultado_cliente = mysqli_query($conn,$cliente);
        $vetor_cliente = mysqli_fetch_array($resultado_cliente);
        $_SESSION["imagem"] = $vetor_cliente['imagem'];

        ?>

        <script language='JavaScript'>
            document.location.href="perfil_mecanico.php";
        </script>
        <?php
    }
    else if ($vetor_login['privilegio'] == 2) {
        $cliente ="SELECT * from `oficina` WHERE `cod_login` = $cod_login";
        $resultado_cliente = mysqli_query($conn,$cliente);
        $vetor = mysqli_fetch_array($resultado_cliente);
        $_SESSION["nome"] = $vetor['nome'];
        $cliente ="select * from `login` where `cod_login` = $cod_login";
        $resultado_cliente = mysqli_query($conn,$cliente);
        $vetor_cliente = mysqli_fetch_array($resultado_cliente);
        $_SESSION["imagem"] = $vetor_cliente['imagem'];
        $cliente ="SELECT * from `oficina` WHERE `cod_login` = $cod_login";
        $resultado_cliente = mysqli_query($conn,$cliente);
        $vetor = mysqli_fetch_array($resultado_cliente);
        $_SESSION["cod_oficina"] = $vetor['cod_oficina'];

        ?>
        <script language='JavaScript'>
            document.location.href="perfil_oficina.php";
        </script>
        <?php
    }
    else{
        echo "erro";
    }

}
else
{

    ?>
    <script language='JavaScript'>
        document.location.href="nao_logado.php";
    </script>             
    <?php                
}               
}

?>   