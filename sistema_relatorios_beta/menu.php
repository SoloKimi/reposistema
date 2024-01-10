<?php
@session_start();
require_once './conexao_banco.php';

//verificar se o usuario é adm e definir o menu
$idUserMenu = $_SESSION['idColaborador'];

$cmdvermenu = "SELECT * FROM Colaborador WHERE id = '$idUserMenu'";
$resultvermenu = mysqli_query($link, $cmdvermenu);
$dadosvermenu = mysqli_fetch_array($resultvermenu);

$nomeUser = $dadosvermenu['titulo'];
$emailUser = $dadosvermenu['email'];

$hoje = date("d/m/y");


//verificar se há relatorios para se responder
$cmdnotif = "SELECT * FROM RelatorioRespostas WHERE Colaborador_id = '$idUserMenu' AND data is null";
$resultnotif = mysqli_query($link, $cmdnotif);
$row_cntnot = mysqli_num_rows($resultnotif);

if ($dadosvermenu['tipo'] == '1') {
  //menu adiministrador

?>
  <!-- partial:partials/_navbar.html -->
  <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
      <div class="me-3">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
      </div>
      <div>
        <a class="navbar-brand brand-logo" href="index.php">
          <img src="./logo_sistema2.jpeg" height="50" width="50" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.php">
          <img src="./logo_sistema2.jpeg" height="50" width="50" alt="logo" />
        </a>
      </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
      <ul class="navbar-nav">
        <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
          <h1 class="welcome-text">Seja bem vindo <span class="text-black fw-bold"><?= $nomeUser ?></span></h1>
          <h3 class="welcome-sub-text">Sistema Interno FVP</h3>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item d-none d-lg-block">
          <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
            <span class="input-group-addon input-group-prepend border-right">
              <span class="icon-calendar input-group-text calendar-icon"></span>
            </span>
            <input type="text" readonly value="<?= date('d/m/Y') ?>" class="form-control">
          </div>
        </li>
        <li class="nav-item dropdown d-none d-lg-block user-dropdown">
          <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="./user-icon.png" height="50" width="50" class="img-xs rounded-circle" alt="Profile image"><i></i> </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <div class="dropdown-header text-center">
              <img src="./user-icon.png" height="50" width="50" class="img-md rounded-circle" alt="Profile image"><i></i>
              <p class="mb-1 mt-3 font-weight-semibold"><?= $nomeUser ?></p>
              <p class="fw-light text-muted mb-0"><?= $emailUser ?></p>
            </div>
            <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2" type="button" onclick="deslogarUsuario()"></i>Sign Out</a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->
    <div class="theme-setting-wrapper">
      <div id="settings-trigger"><i class="ti-settings"></i></div>
      <div id="theme-settings" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options selected" id="sidebar-light-theme">
          <div class="img-ss rounded-circle bg-light border me-3"></div>Light
        </div>
        <div class="sidebar-bg-options" id="sidebar-dark-theme">
          <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
        </div>
        <p class="settings-heading mt-2">HEADER SKINS</p>
        <div class="color-tiles mx-0 px-4">
          <div class="tiles success"></div>
          <div class="tiles warning"></div>
          <div class="tiles danger"></div>
          <div class="tiles info"></div>
          <div class="tiles dark"></div>
          <div class="tiles default"></div>
        </div>
      </div>
    </div>
    <!-- partial -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Início</span>
          </a>
        </li>
        <li class="nav-item nav-category">Produtos</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
            <i class="menu-icon mdi mdi-archive"></i>
            <span class="menu-title">Menu</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="produto.php">Tabela produtos</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">Formulários</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#form-elements1" aria-expanded="false" aria-controls="form-elements">
            <i class="menu-icon mdi mdi-card-text-outline"></i>
            <span class="menu-title">Questionários</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-elements1">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="relatorioperguntas.php">Criar Formulário</a></li>
              <li class="nav-item"><a class="nav-link" href="relatoriorespostas.php">Responder Formulário <?php echo '('.$row_cntnot.')'; ?></a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">Tabelas e regitros</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#form-elements2" aria-expanded="false" aria-controls="form-elements">
            <i class="menu-icon mdi mdi-animation"></i>
            <span class="menu-title">Tabs</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-elements2">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="revenda.php">Distribuidora</a></li>
              <li class="nav-item"><a class="nav-link" href="colaborador.php">Colaborador</a></li>
              <li class="nav-item"><a class="nav-link" href="compra.php">Compra</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">Extras</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#form-elements3" aria-expanded="false" aria-controls="form-elements">
            <i class="menu-icon mdi mdi-android-studio"></i>
            <span class="menu-title">Tabelas</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-elements3">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="tipopeso.php">Tipo Peso</a></li>
              <li class="nav-item"><a class="nav-link" href="embalagem.php">Embalagem</a></li>
              <li class="nav-item"><a class="nav-link" href="categoria.php">Categoria</a></li>
              <li class="nav-item"><a class="nav-link" href="familia1.php">Familia 1</a></li>
              <li class="nav-item"><a class="nav-link" href="familia2.php">Familia 2</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
  <?php
} elseif ($dadosvermenu['tipo'] == '0') {
  ?>
     <!-- partial:partials/_navbar.html -->
  <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
      <div class="me-3">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
      </div>
      <div>
        <a class="navbar-brand brand-logo" href="index.php">
          <img src="./logo_sistema2.jpeg" height="50" width="50" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.php">
          <img src="./logo_sistema2.jpeg" height="50" width="50" alt="logo" />
        </a>
      </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
      <ul class="navbar-nav">
        <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
          <h1 class="welcome-text">Seja bem vindo <span class="text-black fw-bold"><?= $nomeUser ?></span></h1>
          <h3 class="welcome-sub-text">Sistema Interno FVP</h3>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item d-none d-lg-block">
          <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
            <span class="input-group-addon input-group-prepend border-right">
              <span class="icon-calendar input-group-text calendar-icon"><?php $hoje ?></span>
            </span>
            <input type="text" class="form-control">
          </div>
        </li>
        <li class="nav-item dropdown d-none d-lg-block user-dropdown">
          <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="./user-icon.png" height="50" width="50" class="img-xs rounded-circle" alt="Profile image"><i></i> </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <div class="dropdown-header text-center">
              <img src="./user-icon.png" height="50" width="50" class="img-md rounded-circle" alt="Profile image"><i></i>
              <p class="mb-1 mt-3 font-weight-semibold"><?= $nomeUser ?></p>
              <p class="fw-light text-muted mb-0"><?= $emailUser ?></p>
            </div>
            <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2" type="button" onclick="deslogarUsuario()"></i>Sign Out</a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->
    <div class="theme-setting-wrapper">
      <div id="settings-trigger"><i class="ti-settings"></i></div>
      <div id="theme-settings" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options selected" id="sidebar-light-theme">
          <div class="img-ss rounded-circle bg-light border me-3"></div>Light
        </div>
        <div class="sidebar-bg-options" id="sidebar-dark-theme">
          <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
        </div>
        <p class="settings-heading mt-2">HEADER SKINS</p>
        <div class="color-tiles mx-0 px-4">
          <div class="tiles success"></div>
          <div class="tiles warning"></div>
          <div class="tiles danger"></div>
          <div class="tiles info"></div>
          <div class="tiles dark"></div>
          <div class="tiles default"></div>
        </div>
      </div>
    </div>
    <!-- partial -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Início</span>
          </a>
        </li>
        <li class="nav-item nav-category">Tabelas e regitros</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#form-elements2" aria-expanded="false" aria-controls="form-elements">
            <i class="menu-icon mdi mdi-animation"></i>
            <span class="menu-title">Tabs</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-elements2">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="compra.php">Compra</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item nav-category">Formulários</li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#form-elements1" aria-expanded="false" aria-controls="form-elements">
            <i class="menu-icon mdi mdi-card-text-outline"></i>
            <span class="menu-title">Questionários</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-elements1">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="relatoriorespostas.php">Responder Formulários <?php echo '('.$row_cntnot.')'; ?></a></li>
            </ul>
          </div>
        </li>
      </ul>
    </nav>
  <?php
}
  ?>