<?php

require_once './head.php';

?>
<script src="tipopeso/tipopeso.js"></script>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h2 class="card-title" style="font-size:30px;">Tipo Peso</h2>
        <div class="add-items d-flex mb-0">
          <a href="./tipopesonovo.php">
            <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
            <button type="button" class="btn btn-primary">Novo Tipo peso</button>
          </a>
        </div>
      </div>
      <p class="card-description">
        Tipos de<code>Peso</code>
      </p>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th style="width: 10%;text-align: center">Id</th>
              <th style="width: 60%;text-align: center">Titulo</th>
              <th style="width: 15%;text-align: center">Status</th>
              <th style="width: 15%;text-align: center"></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cmd = "SELECT * FROM TipoPeso ORDER BY titulo ";
            $result = mysqli_query($link, $cmd);
            while ($dados = mysqli_fetch_array($result)) {
            ?>
              <tr>
                <td style="text-align: center; cursor: pointer" onclick="$('#idtp').val(<?= $dados['id']; ?>);
                                          $('#formTipoPeso').submit();">
                  <?= $dados['id']; ?>
                </td>
                <td style="text-align: center; cursor: pointer" onclick="$('#idtp').val(<?= $dados['id']; ?>);
                                          $('#formTipoPeso').submit();">
                  <?= $dados['titulo']; ?>
                </td>
                <td style="text-align: center; cursor: pointer" onclick="$('#idtp').val(<?= $dados['id']; ?>);
                                          $('#formTipoPeso').submit();">
                  <?php
                  if ($dados['status'] == 1) {
                    echo "<span class='badge badge-success'>Ativado</span>";
                  } else if ($dados['status'] == 0) {
                    echo "<span class='badge badge-warning'>Inativo</span>";
                  } else if ($dados['status'] == 2) {
                    echo "<span class='badge badge-info'>Fixo</span>";
                  } else {
                    echo "-";
                  }
                  ?>
                </td>
                <td>
                  <button type="button" onclick="$('#idtp').val(<?= $dados['id']; ?>); $('#formTipoPeso').submit();" class="btn btn-outline-warning btn-fw">Alterar</button>
                  <?php
                  if ($dados['status'] != 2) {
                  ?>
                    <button type="button" onclick="excluirTipoPeso(<?= $dados['id']; ?>)" class="btn btn-outline-danger btn-fw">Excluir</button>
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<form action="tipopesoeditar.php" method="POST" id="formTipoPeso">
  <input type="hidden" value="" id="idtp" name="idtp">
</form>
<!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
<?php require_once "footer.php"; ?>