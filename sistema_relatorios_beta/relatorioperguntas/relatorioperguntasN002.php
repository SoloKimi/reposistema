<?php

require_once '../conexao_banco.php';

$idrp = $_POST['id'];
$ordem = $_POST['ordem'];

$cmd = "SELECT jsonperguntas
        FROM RelatorioPerguntas
        WHERE id = '$idrp'";
$result = mysqli_query($link, $cmd);
$dados = mysqli_fetch_array($result);

$jsonBanco = json_decode($dados['jsonperguntas']);
foreach ($jsonBanco as $pergunta) {
    $ordemaux = $pergunta->ordem;
    if ($ordemaux == $ordem) {
        $questaopergunta = $pergunta->questaopergunta;
        $tipopergunta = $pergunta->tipopergunta;
        $zero = $pergunta->zero;
    }
}

?>
<script src="relatorioperguntas/relatorioperguntas.js"></script>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="title" id="defaultModalLabel">Perguntas</h4>
        </div>
        <div class="modal-body">

            <form class="forms-sample">
                <div class="form-group">

                    <label for="tipopergunta">Tipo de pergunta*</label>
                    <select class="form-control show-tick selectpicker" id="tipopergunta">
                        <option value="">[Selecione]</option>
                        <option value="dissertativa">Dissertativa</option>
                        <option value="data">Data</option>
                        <option value="numerointeiro">Numero inteiro</option>
                        <option value="numerodecimal">Numero com decimal</option>
                        <!-- <option value="calculo">Calculo</option> -->
                        <option value="porcentagem">Porcentagem</option>
                    </select>

                    <div id="divprincipal" style="display: none">

                        <label for="titulopergunta" id="titulolabel"></label>
                        <textarea id="titulopergunta" value="<?= $questaopergunta ?>" class="form-control" obrigatorio="1" rows="3" style="height: auto !important"></textarea>


                        <div id="divzero" style="display: none">
                            <label for="zero">Numero pode ser zero?*</label>
                            <select class="form-control show-tick selectpicker" id="zero">
                                <option value="">[Selecione]</option>
                                <option value="0" <?php if($zero == '0'){ ?> selected <?php } ?>>Não</option>
                                <option value="1" <?php if($zero == '1'){ ?> selected <?php } ?>>Sim</option>
                            </select>
                        </div>

                        <button type="button" id="buttoninserirrelatorioperguntas" onclick="alterarPergunta(<?= $idrp ?>, <?= $ordem ?>)" class="btn btn-primary me-2">Confirmar</button>
                        <button type="button" class="btn btn-light" onclick="fecharmodalPerguntas()">Cancelar</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#tipopergunta').on('change', function() {
            const tipopergunta = $(this).val();
            if (tipopergunta === '') {
                $('#divprincipal').hide();
            } else {
                $('#divprincipal').show();
                switch (tipopergunta) {
                    case 'dissertativa':
                        tipoperguntalabel = 'DISSERTATIVA*';
                        $('#divzero').hide();
                        console.log('pergunta dissertativa');
                        break;
                    case 'data':
                        tipoperguntalabel = 'uma DATA*';
                        $('#divzero').hide();
                        console.log('pergunta data');
                        break;
                    case 'numerointeiro':
                        tipoperguntalabel = 'um NÚMERO INTEIRO*';
                        $('#divzero').show();
                        console.log('pergunta numero int');
                        break;
                    case 'numerodecimal':
                        tipoperguntalabel = 'um NÚMERO DECIMAL*';
                        $('#divzero').show();
                        console.log('pergunta numero decimal');
                        break;
                    case 'porcentagem':
                        tipoperguntalabel = 'uma PORCENTAGEM*';
                        $('#divzero').show();
                        console.log('pergunta porcentagem');
                        break;
                    default:
                }
                $('#titulolabel').text("Insira a pergunta cuja resposta seja " + tipoperguntalabel);
            }
        });

        // Define o valor selecionado no Select
        $('#tipopergunta').val('<?= $tipopergunta ?>').change();

        // Ajusta o conteúdo do Textarea
        $('#titulopergunta').val('<?= $questaopergunta ?>');

        // Verifica e exibe o Checkbox
        if ('<?= $zero ?>' === '1') {
            $('#zero').prop('checked', true);
        }
    });
</script>

<form action="relatorioperguntaseditar.php" method="POST" id="formRelatorioPerguntas">
    <input type="hidden" value="" id="idrp" name="idrp">
</form>