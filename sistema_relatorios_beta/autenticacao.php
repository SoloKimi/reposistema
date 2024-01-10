<?php

@session_start();

require_once './conexao_banco.php';

// Esses dois links têm camin
// 	https://www.php.net/manual/en/features.session.security.management.php
// 	https://www.php.net/manual/en/session.security.ini.php
// 

function set_session_data($dados){
    $_SESSION['idColaborador'] = $dados['id'];
    $_SESSION['tipoColaborador'] = $dados['tipo'];
};

function get_user_data($link, $id=null, $user=null, $pass=null){
    $query = "SELECT * FROM Colaborador WHERE " . ($id != null ? "id = $id;" : "user = '$user' AND senha = '$pass';");
    $result = mysqli_query($link, $query);
    if(!$result) return false;
    return mysqli_fetch_array($result);
}

function is_cookie_valid($cookie, $value = null){
    return isset($cookie) && $cookie != "" && ($value != null ? $cookie == $value : false);
}

// usuario tem uma sessão ativa
if(isset($_SESSION['idColaborador'])){
    if(!is_cookie_valid($_COOKIE['idCookie'], $_SESSION['idColaborador']))
        setcookie('idCookie', strval($_SESSION['idColaborador']), time() + (365 * 24 * 3600), '/', 'sistemafvp.com.br');

    if(isset($isLogin))header("Location: index.php");

    return;
}

//usuario logado sem sessão ativa
elseif(is_cookie_valid($_COOKIE['idCookie'])){

    $cmdLogin = "SELECT *
                    FROM Colaborador 
                    WHERE id = ".$_COOKIE['idCookie'].";";
    $result = mysqli_query($link, $cmdLogin);
    $dados = mysqli_fetch_array($result);

    $dados = get_user_data($link, id: $_COOKIE['idCookie']);

    if (isset($dados['id'])) {
        set_session_data($dados);
        if(isset($isLogin))
            header("Location: index.php");
    }else{
        setcookie("idCookie", '', -1, '/', 'sistemafvp.com.br');
        header("Location: login.php");
    }
    echo "cookie";

}
//usuario esta tentando logar
elseif(isset($_POST['userLogin']) && isset($_POST['senhaLogin'])){

    $userLogin = $_POST['userLogin'];
    $senhaLogin = $_POST['senhaLogin'];

    $dados = get_user_data($link, user: $userLogin, pass: $senhaLogin);

    if (isset($dados['id'])) {
        $iscookieset = setcookie("idCookie", $dados['id'], time() + (365 * 24 * 3600), '/', 'sistemafvp.com.br');
        set_session_data($dados);
    }
    die;
}else{
    if(!isset($isLogin))header("Location: login.php");
}
