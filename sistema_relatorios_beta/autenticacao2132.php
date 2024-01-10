<?php

@session_start();

require_once './conexao_banco.php';

function set_session_data($dadosauth){
    $_SESSION['idColaborador'] = $dadosauth['id'];
    $_SESSION['tipoColaborador'] = $dadosauth['tipo'];
};

// usuario tem uma sessão ativa
if(isset($_SESSION['idColaborador'])){

    if(isset($isLogin))header("Location: index.php");
    return;

}
//usuario logado sem sessão ativa
elseif(isset($_COOKIE['idCookie'])){

    $cmdLogin = "SELECT *
                    FROM Colaborador 
                    WHERE id = ".$_COOKIE['idCookie'].";";
    $resultlogin = mysqli_query($link, $cmdLogin);
    $dadosauth = mysqli_fetch_array($resultlogin);

    if (isset($dadosauth['id'])) {
        set_session_data($dadosauth);
    }else{
        setcookie("idCookie", '', -1);
        header("Location: login.php");
    }

}
//usuario esta tentando logar
elseif(isset($_POST['userLogin']) && isset($_POST['senhaLogin'])){

    $userLogin = $_POST['userLogin'];
    $senhaLogin = $_POST['senhaLogin'];

    $cmdLogin = "SELECT *
                    FROM Colaborador 
    WHERE usuario = '$userLogin' AND
          senha = '$senhaLogin'";
    $resultlogin = mysqli_query($link, $cmdLogin);
    $dadosauth = mysqli_fetch_array($resultlogin);

    if ($dadosauth['id']) {

        $iscookieset = setcookie("idCookie", $dadosauth['id'], (time() + (365 * 24 * 3600)));
        set_session_data($dadosauth);
        echo 1;
    }
    die;
}else{
    if(!isset($isLogin))header("Location: login.php");
}
?>
