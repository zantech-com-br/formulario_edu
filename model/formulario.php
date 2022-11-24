<?php
session_start();
require_once('../config.php');
require_once('../dao/daoMysql.php');

//Etapas para tratamento do carregamento de um arquivo

if(isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0){ //etapa 1 - verificado se arquivo enviado existe (difrente de null) e se informar algum erro ( 0 = sem erro);
    
    if($_FILES['foto']['type'] == 'image/jpg' || $_FILES['foto']['type'] == 'image/jpeg' || $_FILES['foto']['type'] == 'image/png' || $_FILES['foto']['type'] == 'image/gif' || $_FILES['foto']['type'] == 'image/svg'){ //verificado os mimitypes se são os formatos que quero
        
        //coletado informações para compor a estrutura de copia e cola (copiar cliente e colocar na pasta dop servidor)
        $localTemporarioImg = $_FILES['foto']['tmp_name'];
        $arquivoNoome = $_FILES['foto']['name'];

        $novoNome = uniqid(time().rand(1,9999).time()).'.jpg'; //gerando nome aleatorio
        $destino = '../midia/avatar/'.$novoNome; //criado destino para novo nome e formato do arquivo

        if(move_uploaded_file($localTemporarioImg, $destino)){
            echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
            echo '<img src ="http://localhost/exerc_eduardo/midia/avatar/'.$novoNome.'"/>';
        }else{
            $_SESSION['aviso'] = 'Erro no enviou da imagem, favor tentar novamente!!!';
            $_SESSION['avisoType'] = 'alert';
            header('location: ../index.php');
        }
    }
    
}else {
    $_SESSION['aviso'] = 'Erro no enviou da imagem, favor tentar novamente!!!';
    $_SESSION['avisoType'] = 'alert';
    header('location: ../index.php');
}


$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');
$dataNascimento = filter_input(INPUT_POST, 'date');
$cor = filter_input(INPUT_POST, 'cor');
$sexo = filter_input(INPUT_POST, 'sexo');
$interesseOptHtml = filter_input(INPUT_POST, 'html');
$interesseOptCss = filter_input(INPUT_POST, 'css');
$nivel = filter_input(INPUT_POST, 'nivel', FILTER_SANITIZE_NUMBER_INT);
$regiao = filter_input(INPUT_POST, 'regiao');
$msg = filter_input(INPUT_POST, 'msg');

$conjutoDados = [];

if($nome != '' && $idade != '' && $email != '' && $senha != ''  && $sexo != '' && $regiao != '' && $msg != ''){
    $conjutoDados += ["nome" => $nome];
    $conjutoDados += ["idade" => $idade];
    $conjutoDados += ["email" => $email];
    $conjutoDados += ["senha" => password_hash($senha,PASSWORD_DEFAULT)];
    $conjutoDados += ["sexo" => $sexo];
    $conjutoDados += ["regiao" => $regiao];
    $conjutoDados += ["msg" => $msg];
    $conjutoDados += ["nivel" => $nivel];
    $conjutoDados += ["cor" => $cor];
    $conjutoDados += ["foto" => $novoNome];
    $conjutoDados += ['interesse' => []];
    
    //varificando data
    $desformeDate = explode('-', $dataNascimento);

    if(count($desformeDate) == 3){
        $tranformDate = strtotime($desformeDate[0].$desformeDate[1].$desformeDate[2]);
        
        if(checkdate(intval($desformeDate[1]), intval($desformeDate[2]), intval($desformeDate[0]))){
            $conjutoDados += ['date' => $dataNascimento];
        }else {
            $_SESSION['aviso'] = 'Data no formato invalido!!!';
            $_SESSION['avisoType'] = 'alert';
            header('location: ../index.php');
        }

    }else {
        $_SESSION['aviso'] = 'Data no formato invalido!!!';
        $_SESSION['avisoType'] = 'alert';
        header('location: ../index.php');
    }

    if($interesseOptHtml != ''){
        array_push($conjutoDados['interesse'], $interesseOptHtml);
    }
    
    if($interesseOptCss != ''){
        array_push($conjutoDados['interesse'], $interesseOptCss);
    }

}else {
    $_SESSION['aviso'] = 'Campos Obrigatorio sem preechimento!!!';
    $_SESSION['avisoType'] = 'alert';
    header('location: ../index.php');
}

$enviarDados = new daoMysql($con);
$status = $enviarDados->cadastrarForm($conjutoDados);


if($status){
    $_SESSION['aviso'] = 'Dados enviado com sucesso...';
    $_SESSION['avisoType'] = 'ok';
    header('location: ../index.php');
}else{
    $_SESSION['aviso'] = 'Erro ao cadastrar, tente de novo...';
    $_SESSION['avisoType'] = 'alert';
    header('location: ../index.php');
}


?>