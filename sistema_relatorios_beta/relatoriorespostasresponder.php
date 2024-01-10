<?php

require_once './head.php';

$idrp = $_POST['idrp'];

if (!$idrp) {
    header('Location: relatoriorespostas.php');
}

$cmd = "SELECT *
        FROM RelatorioRespostas
        WHERE id = '$idrp'";
$result = mysqli_query($link, $cmd);
$dados = mysqli_fetch_array($result);

$perguntas = json_decode($dados['jsonperguntas'], true);
?>
<script src="relatoriorespostas/relatoriorespostas.js"></script>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Responder Relatório</h4>
            <p class="card-description">
                Perguntas
            </p>
            <form action="processar_respostas.php" method="post">
                <?php foreach ($perguntas as $pergunta) : ?>
                    <label for="resposta<?= $pergunta->ordem ?>">
                        <?= $pergunta->questaopergunta ?>
                    </label>
                    <input type="text" name="respostas[<?= $pergunta->ordem ?>]" id="resposta<?= $pergunta->ordem ?>" required>
                    <br>
                <?php endforeach; ?>
                <button type="button" id="buttonalterarrelatoriorespostas" onclick="responderPerguntas(<?= $idrp; ?>)" class="btn btn-primary me-2">Confirmar</button>
            </form>
        </div>
    </div>
</div>
<?php include './footer.php'; ?>



<?php
// Carregue o JSON com as perguntas
// $jsonString = '{"perguntas": [{"id": 1, "texto": "Qual é a sua pergunta 1?"}, {"id": 2, "texto": "Qual é a sua pergunta 2?"}, {"id": 3, "texto": "Qual é a sua pergunta 3?"}]}';
// $perguntas = json_decode($jsonString)->perguntas;
?>