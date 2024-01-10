<?php

require_once './head.php';

$id = $_COOKIE['idCookie'];

$cmdhead = "SELECT *
                    FROM Colaborador 
                    WHERE id = '$id'";
$resulthead = mysqli_query($link, $cmdhead);
$dadoshead = mysqli_fetch_array($resulthead);

?>
<div class="row">
  <div class="col-sm-12">
    <div class="col-12 grid-margin stretch-card">
      <div class="card card-rounded">
      </div>
    </div>
    <div class="col-lg-12 d-flex flex-column">
      <div class="row flex-grow">
        <div class="col-12 grid-margin stretch-card">
          <div class="card card-rounded">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title card-title-dash"></h4>
                    <h2 class="card-title card-title-dash">Hoje <?= date('d/m/Y') ?></h2>
                    <div class="add-items d-flex mb-0">
                      <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
                      <!-- <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<?php
require_once 'footer.php';
?>