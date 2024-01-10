<?php
$isLogin = true;
require_once './head.php';
?>

    <div class="row w-100 mx-0">
      <div class="col-lg-4 mx-auto">
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
          <div class="brand-logo">
            <center>
              <img src="./logo_sistema2.jpeg" alt="logo">
            </center>
          </div>
          <h4>Logue para iniciar</h4>
          <form class="pt-3">
            <div class="form-group">
              <input type="text" class="form-control form-control-lg" id="userLogin" placeholder="Usuario">
            </div>
            <div class="form-group">
              <input type="password" class="form-control form-control-lg" id="senhaLogin" placeholder="Senha">
            </div>
            <div class="mt-3">
              <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" onclick="loginUsuario()" onkeydown="if (event.keyCode === 13) loginUsuario()">Logar</a>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php require_once 'footer.php'; 
//onkeydown="if (event.key === 'Enter') document.getElementById('meuBotao').click()"
?>
