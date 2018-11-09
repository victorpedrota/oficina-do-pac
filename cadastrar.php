<?php
$nome = $_POST['nome'];
$celular = $_POST['celular'];
$telefone = $_POST['telefone'];
$cnpj = $_POST['cnpj'];
$estado = $_POST['uf'];
$cidade = $_POST['cidade'];
$rua = $_POST['rua'];
$login = $_POST['login'];
$bairro = $_POST['bairro'];
$c_senha = $_POST['c_senha'];
$complemento = $_POST['complemento'];
$senha = $_POST['senha'];
$cep = $_POST['cep'];
$numero = $_POST['numero'];
require("connect.php");

function validar_cnpj($cnpj)
{
    $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
    // Valida tamanho
    if (strlen($cnpj) != 14)
        return false;
    // Valida primeiro dígito verificador
    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
    {
        $soma += $cnpj{$i} * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
        return false;
    // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }
    function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }
    $cnpjn = soNumero($cnpj);
    $celularn = soNumero($celular);
    $telefonen = soNumero($telefone);
    $cepn = soNumero($cep);
    
    if (validar_cnpj($cnpj) ==false) {
     echo 1;
}
else if($senha != $c_senha ){
    echo 2;
}

else
{
    $sql_pesquisa ="select * from `login` where `login` = '$login'" ;
    $resultado = mysqli_query($conn,$sql_pesquisa); 
    $numero = mysqli_num_rows($resultado);
    $vetor_login = mysqli_fetch_array($resultado);
    $sql ="select * from `oficina` where  `cnpj` = '$cnpjn'" ;
    $resultado_sql = mysqli_query($conn,$sql); 
    $numero_cliente = mysqli_num_rows($resultado_sql);
    if($numero == 0 && $numero_cliente == 0){

        $sql_login = "INSERT INTO `login`(`login`, `senha`, `privilegio`) VALUES ('$login','$senha',2)";
        $resultado_login = mysqli_query($conn, $sql_login);
        

            $sql_cod ="select * from `login` where `login` = '$login'" ;
            $resultado_cod = mysqli_query($conn,$sql_cod);
            $vetor_cod = mysqli_fetch_array($resultado_cod);
            $cod_login = $vetor_cod['cod_login'];
            $sql_cliente = "INSERT INTO `oficina`(`cod_login`,`nome`,`cnpj`,`rua`,`estado`,`cep`,`cidade`,`telefone`,`celular`,`bairro`,`complemento`,`numero`) VALUES ($cod_login,'$nome',$cnpjn,'$rua','$estado',$cepn,'$cidade',$telefonen,$celularn,'$bairro','$complemento',$numero)";
            $insere = mysqli_query($conn,$sql_cliente);

            echo 0;
    } 

        else{
           echo "Erro"; }}
      ?>