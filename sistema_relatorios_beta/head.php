<?php 
date_default_timezone_set('America/Sao_Paulo');
require_once './autenticacao2132.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistema FVP</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
  <link rel="stylesheet" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject
      icone aba -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="container-scroller">
    <!-- menu -->
    <?php if (!isset($isLogin)) {
      require_once "menu.php";
    ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
          <?php
        } else { ?>
            <div class="container-fluid page-body-wrapper full-page-wrapper">
              <div class="content-wrapper d-flex align-items-center auth px-0">
              <?php } ?>


              <!-- partial -->
              <?php

              //require_once './autenticacao.php';


              // @session_start();
              // extract($_COOKIE);
              // extract($_POST);

              // if(!$idCookie && !$isLogin) {
              //     header("Location: login.php");
              // }
              // if($idCookie && $isLogin) {
              //     header("Location: /");
              // }

              // $_SESSION["ID"] = uniqid('', true);

              // verificação login com identação
              //$query = "SELECT id FROM Users WHERE email = " . $_POST["email"] . " AND password = " . $_POST["password"] . ";"

              //if(!$idCookie && strpos($_SERVER['REQUEST_URI'], '/login.php') == 1) {
              // header('Location: login.php');
              //  echo $_SERVER['REQUEST_URI'];
              //  echo !strpos($_SERVER['REQUEST_URI'], '/login.php');
              //  die();
              //}

              //require_once './conexao_banco.php';


              //$queryadm = "SELECT administradorPessoa, tituloPessoa
              //       from Pessoa where idPessoa = '$idPessoaSession'";
              //$resultadm = mysqli_query($link, $cmdadm);
              //$dadosadm = mysqli_fetch_array($resultadm);
              //$administradorPessoa = $dadosadm['administradorPessoa'];
              //$nomePessoa = $dadosadm['tituloPessoa'];
              //$nomePessoa = explode(" ", $nomePessoa);
              //$nome = $nomePessoa[0];
              //
              //$cmdParamentro = "SELECT
              //        idParametro,
              //        liberarSemEstoque,
              //        nomeCliente,
              //        cnpjCliente,
              //        numeroMaximoUsuario,
              //        numeroMaximoProduto,
              //        ncaixas,
              //        comandaCaixa
              //        FROM Parametro ";
              //$resultParamentro = mysqli_query($link, $cmdParamentro);
              //$dadosParamentro = mysqli_fetch_array($resultParamentro);
              //$nomeCliente = $dadosParamentro['nomeCliente'];
              //
              //$numeroMaximoUsuario = $dadosParamentro['numeroMaximoUsuario'];
              //$numeroMaximoProduto = $dadosParamentro['numeroMaximoProduto'];
              //$liberarSemEstoque = $dadosParamentro['liberarSemEstoque'];
              //$comandaCaixa = $dadosParamentro['comandaCaixa'];
              //$ncaixas = $dadosParamentro['ncaixas'];
              //
              //
              //$cmdConfiguracao = "SELECT
              //        menuConfiguracao
              //        FROM Configuracao 
              //        where idPessoa = '$idPessoaSession'";
              //$resultConfiguracao = mysqli_query($link, $cmdConfiguracao);
              //$dadosConfiguracao = mysqli_fetch_array($resultConfiguracao);
              //$menuConfiguracao = $dadosConfiguracao['menuConfiguracao'];
              ?>